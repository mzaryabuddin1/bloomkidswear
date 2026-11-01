<?php

namespace App\Libraries;

use App\Models\OtpModel;

/**
 * Issues, emails and verifies one-time codes (signup + password reset).
 */
class OtpService
{
    public const TTL_MINUTES    = 10;
    public const RESEND_SECONDS = 60;
    public const MAX_ATTEMPTS   = 5;

    private OtpModel $model;

    public function __construct()
    {
        $this->model = new OtpModel();
    }

    /**
     * @return array{ok:bool,message:string}
     */
    public function issue(string $email, string $purpose, ?array $payload = null): array
    {
        $email = strtolower(trim($email));

        $last = $this->model->where('email', $email)->where('purpose', $purpose)->orderBy('id', 'DESC')->first();
        if ($last && strtotime($last['created_at']) > time() - self::RESEND_SECONDS) {
            $wait = self::RESEND_SECONDS - (time() - strtotime($last['created_at']));

            return ['ok' => false, 'message' => "Please wait {$wait} seconds before requesting another code."];
        }

        $this->model->where('email', $email)->where('purpose', $purpose)->delete();

        $code = (string) random_int(100000, 999999);
        $this->model->insert([
            'email'      => $email,
            'purpose'    => $purpose,
            'code_hash'  => password_hash($code, PASSWORD_DEFAULT),
            'payload'    => $payload ? json_encode($payload) : null,
            'attempts'   => 0,
            'expires_at' => date('Y-m-d H:i:s', time() + self::TTL_MINUTES * 60),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if (! $this->send($email, $code, $purpose)) {
            $this->model->where('email', $email)->where('purpose', $purpose)->delete();

            return ['ok' => false, 'message' => 'We could not send the email right now. Please try again shortly.'];
        }

        return ['ok' => true, 'message' => 'We sent a 6-digit code to ' . $email . '.'];
    }

    /**
     * @return array{ok:bool,message:string,payload:?array}
     */
    public function verify(string $email, string $purpose, string $code): array
    {
        $email = strtolower(trim($email));
        $row   = $this->model->where('email', $email)->where('purpose', $purpose)->orderBy('id', 'DESC')->first();

        if (! $row || strtotime($row['expires_at']) < time()) {
            return ['ok' => false, 'message' => 'This code has expired. Please request a new one.', 'payload' => null];
        }

        if ((int) $row['attempts'] >= self::MAX_ATTEMPTS) {
            return ['ok' => false, 'message' => 'Too many attempts. Please request a new code.', 'payload' => null];
        }

        if (! password_verify(trim($code), $row['code_hash'])) {
            $this->model->update($row['id'], ['attempts' => (int) $row['attempts'] + 1]);

            return ['ok' => false, 'message' => 'That code is not correct.', 'payload' => null];
        }

        $this->model->delete($row['id']);

        return ['ok' => true, 'message' => 'Verified.', 'payload' => $row['payload'] ? json_decode($row['payload'], true) : null];
    }

    private function send(string $email, string $code, string $purpose): bool
    {
        $isReset = $purpose === 'reset';
        $subject = $isReset ? 'Reset your Bloom Kidswear password' : 'Verify your Bloom Kidswear account';
        $intro   = $isReset
            ? 'Use this code to reset your password.'
            : 'Welcome to Bloom Kidswear! Use this code to finish creating your account.';

        $mail = service('email');
        $mail->setTo($email);
        $mail->setSubject($subject);
        $mail->setMessage(view('emails/otp', ['code' => $code, 'intro' => $intro, 'minutes' => self::TTL_MINUTES]));

        if (! $mail->send(false)) {
            log_message('error', 'OTP email failed: ' . $mail->printDebugger(['headers']));

            return false;
        }

        return true;
    }
}
