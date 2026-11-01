<?php

namespace App\Libraries;

/**
 * Branded order emails (invoice on a new order, status updates).
 * Emails are queued (see MailQueue), so checkout never waits on SMTP.
 * Never throws: a mail failure must not break checkout or an admin edit.
 * Set `orderEmails.enabled = false` in .env to switch sending off (local testing).
 */
class OrderMailer
{
    public const BCC = 'mahnoor@bloomkidswear.com';

    private const STATUS_COPY = [
        'placed'     => ['Order received', 'we have received your order and will start preparing it shortly.'],
        'processing' => ['We are preparing your order', 'your order is being packed with care.'],
        'shipped'    => ['Your order is on its way', 'your order has been handed to the courier.'],
        'delivered'  => ['Your order has been delivered', 'we hope your little one loves it! Thank you for shopping with Bloom Kidswear.'],
        'cancelled'  => ['Your order has been cancelled', 'this order was cancelled. If you have any questions, simply reply to this email.'],
    ];

    public static function sendInvoice(int $orderId): bool
    {
        [$order, $items] = self::load($orderId);
        if (! $order) {
            return false;
        }

        return self::send($order, 'Your Bloom Kidswear order #' . $order['order_number'], view('emails/order_invoice', [
            'order' => $order, 'items' => $items, 'logo' => self::logo(),
        ]), true);
    }

    public static function sendStatus(int $orderId): bool
    {
        [$order, $items] = self::load($orderId);
        if (! $order) {
            return false;
        }
        [$headline, $text] = self::STATUS_COPY[$order['status']] ?? ['Order update', 'the status of your order has changed.'];

        return self::send($order, $headline . ' - order #' . $order['order_number'], view('emails/order_status', [
            'order' => $order, 'items' => $items, 'headline' => $headline, 'text' => $text, 'logo' => self::logo(),
        ]), false);
    }

    private static function logo(): string
    {
        return base_url('assets/frontend/images/logo/bloom-logo.png');
    }

    private static function load(int $orderId): array
    {
        $db    = db_connect();
        $order = $db->table('orders')->where('id', $orderId)->get()->getRowArray();
        if (! $order) {
            return [null, []];
        }

        return [$order, $db->table('order_items')->where('order_id', $orderId)->orderBy('id')->get()->getResultArray()];
    }

    private static function send(array $order, string $subject, string $html, bool $bcc): bool
    {
        if (! filter_var($order['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        if (! filter_var(env('orderEmails.enabled', true), FILTER_VALIDATE_BOOLEAN)) {
            log_message('info', 'Order email skipped (disabled): ' . $subject . ' -> ' . $order['email']);

            return false;
        }

        try {
            MailQueue::enqueue($order['email'], $subject, $html, $bcc ? self::BCC : null);

            return true;
        } catch (\Throwable $e) {
            log_message('error', 'Order email could not be queued: ' . $e->getMessage());

            return false;
        }
    }
}
