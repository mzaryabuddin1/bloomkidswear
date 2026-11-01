<?php

namespace App\Libraries;

/**
 * Card payment boundary. Raw card details only ever pass through charge();
 * nothing but the brand and last four digits is returned to be stored.
 *
 * This is a SANDBOX implementation: it validates the card (Luhn, expiry, CVC)
 * and approves it without contacting a bank. Before taking real money replace
 * charge() with a call to a Pakistan-supported processor (PayFast, Safepay,
 * etc.) and keep the same return shape.
 */
class PaymentGateway
{
    /** @return array{ok:bool,error?:string,brand?:string,last4?:string,ref?:string} */
    public function charge(string $number, string $expiry, string $cvc, string $holder, int $amount): array
    {
        $digits = preg_replace('/\D+/', '', $number);
        if (strlen($digits) < 13 || strlen($digits) > 19 || ! $this->luhn($digits)) {
            return ['ok' => false, 'error' => 'That card number does not look valid.'];
        }
        if (! preg_match('/^(0[1-9]|1[0-2])\s*\/\s*(\d{2})$/', trim($expiry), $m)) {
            return ['ok' => false, 'error' => 'Enter the expiry date as MM/YY.'];
        }
        $expires = \DateTime::createFromFormat('!y-m-d', $m[2] . '-' . $m[1] . '-01')->modify('last day of this month 23:59:59');
        if ($expires < new \DateTime()) {
            return ['ok' => false, 'error' => 'This card has expired.'];
        }
        if (! preg_match('/^\d{3,4}$/', $cvc)) {
            return ['ok' => false, 'error' => 'Enter the 3 or 4 digit security code.'];
        }
        if (trim($holder) === '') {
            return ['ok' => false, 'error' => 'Enter the name on the card.'];
        }

        // Sandbox: cards ending 0002 are declined so the failure path can be tested.
        if (substr($digits, -4) === '0002') {
            return ['ok' => false, 'error' => 'Your card was declined. Please try another card or pay cash on delivery.'];
        }

        return ['ok' => true, 'brand' => $this->brand($digits), 'last4' => substr($digits, -4), 'ref' => 'SBX-' . strtoupper(bin2hex(random_bytes(5)))];
    }

    private function luhn(string $d): bool
    {
        $sum = 0;
        $alt = false;
        for ($i = strlen($d) - 1; $i >= 0; $i--) {
            $n = (int) $d[$i];
            if ($alt && ($n *= 2) > 9) {
                $n -= 9;
            }
            $sum += $n;
            $alt = ! $alt;
        }

        return $sum % 10 === 0;
    }

    private function brand(string $d): string
    {
        return match (true) {
            $d[0] === '4'                               => 'Visa',
            (bool) preg_match('/^(5[1-5]|2[2-7])/', $d) => 'Mastercard',
            (bool) preg_match('/^3[47]/', $d)           => 'Amex',
            default                                     => 'Card',
        };
    }
}
