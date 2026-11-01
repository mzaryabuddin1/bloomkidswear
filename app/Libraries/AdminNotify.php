<?php

namespace App\Libraries;

/** In-app notifications shown on the admin bell and the Notifications page. */
class AdminNotify
{
    public static function newOrder(int $orderId): void
    {
        try {
            $o = db_connect()->table('orders')->where('id', $orderId)->get()->getRowArray();
            if (! $o) {
                return;
            }
            $method = ['cod' => 'Cash on delivery', 'card' => 'Card', 'bank' => 'Bank transfer'][$o['payment_method']] ?? $o['payment_method'];
            self::push(
                'New order #' . $o['order_number'],
                trim(($o['name'] ?: $o['email']) . ' · ' . (int) $o['items_count'] . ' item' . ((int) $o['items_count'] === 1 ? '' : 's') . ' · ' . Cart::money($o['total']) . ' · ' . $method),
                'admin/orders/' . $orderId,
                $orderId
            );
        } catch (\Throwable $e) {
            log_message('error', 'Admin notification failed: ' . $e->getMessage());
        }
    }

    public static function push(string $title, ?string $body, ?string $link, ?int $orderId = null, string $type = 'order'): void
    {
        db_connect()->table('admin_notifications')->insert([
            'type' => $type, 'title' => mb_substr($title, 0, 191), 'body' => $body ? mb_substr($body, 0, 255) : null,
            'link' => $link, 'order_id' => $orderId, 'is_read' => 0, 'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public static function unread(): int
    {
        try {
            return db_connect()->table('admin_notifications')->where('is_read', 0)->countAllResults();
        } catch (\Throwable $e) {
            return 0; // table not migrated yet
        }
    }

    public static function latest(int $n = 6): array
    {
        try {
            return db_connect()->table('admin_notifications')->orderBy('id', 'DESC')->limit($n)->get()->getResultArray();
        } catch (\Throwable $e) {
            return [];
        }
    }

    public static function ago(string $datetime): string
    {
        $s = max(0, time() - strtotime($datetime));
        if ($s < 60) {
            return 'just now';
        }
        if ($s < 3600) {
            return floor($s / 60) . ' min ago';
        }
        if ($s < 86400) {
            return floor($s / 3600) . ' h ago';
        }

        return date('d M, H:i', strtotime($datetime));
    }
}
