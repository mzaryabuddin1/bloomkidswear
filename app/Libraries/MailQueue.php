<?php

namespace App\Libraries;

/**
 * Tiny database mail queue. Requests only insert a row (fast); the rows are
 * delivered by `php spark mail:flush` (run it from cron every minute) and, as a
 * best effort, right after the response has been sent to the visitor.
 */
class MailQueue
{
    private const MAX_ATTEMPTS = 5;

    private static bool $hooked = false;

    public static function enqueue(string $to, string $subject, string $html, ?string $bcc = null): void
    {
        db_connect()->table('email_queue')->insert([
            'to_email' => $to, 'bcc' => $bcc, 'subject' => mb_substr($subject, 0, 255), 'body' => $html,
            'status' => 'pending', 'attempts' => 0, 'created_at' => date('Y-m-d H:i:s'),
        ]);

        if (! self::$hooked && PHP_SAPI !== 'cli') {
            self::$hooked = true;
            register_shutdown_function(static function (): void {
                ignore_user_abort(true);
                if (function_exists('fastcgi_finish_request')) {
                    fastcgi_finish_request(); // visitor already has the page; deliver in the background
                }
                try {
                    self::flush(5);
                } catch (\Throwable $e) {
                    log_message('error', 'Mail queue flush failed: ' . $e->getMessage());
                }
            });
        }
    }

    /** Deliver up to $limit pending emails. Returns how many were sent. */
    public static function flush(int $limit = 20): int
    {
        $db   = db_connect();
        $rows = $db->table('email_queue')->where('status', 'pending')->where('attempts <', self::MAX_ATTEMPTS)
            ->orderBy('id')->limit($limit)->get()->getResultArray();
        $sent = 0;

        foreach ($rows as $row) {
            // Claim the row so a concurrent worker does not send it twice.
            $db->table('email_queue')->where('id', $row['id'])->where('status', 'pending')->where('attempts', $row['attempts'])
                ->update(['attempts' => $row['attempts'] + 1]);
            if ($db->affectedRows() < 1) {
                continue;
            }

            $error = null;
            try {
                $mail = service('email');
                $mail->clear();
                $mail->setTo($row['to_email']);
                if ($row['bcc']) {
                    $mail->setBCC($row['bcc']);
                }
                $mail->setSubject($row['subject']);
                $mail->setMessage($row['body']);
                if (! $mail->send(false)) {
                    $error = trim(strip_tags($mail->printDebugger(['headers'])));
                }
            } catch (\Throwable $e) {
                $error = $e->getMessage();
            }

            if ($error === null) {
                $db->table('email_queue')->where('id', $row['id'])->update(['status' => 'sent', 'sent_at' => date('Y-m-d H:i:s'), 'last_error' => null]);
                $sent++;
            } else {
                $failed = $row['attempts'] + 1 >= self::MAX_ATTEMPTS;
                $db->table('email_queue')->where('id', $row['id'])->update(['status' => $failed ? 'failed' : 'pending', 'last_error' => mb_substr($error, 0, 255)]);
                log_message('error', 'Queued email #' . $row['id'] . ' failed: ' . mb_substr($error, 0, 200));
            }
        }

        return $sent;
    }
}
