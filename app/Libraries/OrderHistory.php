<?php

namespace App\Libraries;

/**
 * Audit trail for orders. Every create / edit / status change stores:
 *  - a readable list of changes (field, old value, new value)
 *  - the complete order + items BEFORE and AFTER the change,
 * so nothing an admin overwrites is ever lost.
 */
class OrderHistory
{
    public const LABELS = [
        'name' => 'Customer name', 'email' => 'Email', 'phone' => 'Phone', 'address' => 'Address', 'city' => 'City',
        'province' => 'Province', 'postal_code' => 'Postal code', 'notes' => 'Order notes', 'payment_method' => 'Payment method',
        'payment_status' => 'Payment status', 'status' => 'Order status', 'shipping' => 'Delivery charge', 'subtotal' => 'Subtotal',
        'total' => 'Grand total', 'carrier' => 'Courier', 'tracking_number' => 'Tracking number', 'created_at' => 'Order date',
    ];

    private const METHODS = ['cod' => 'Cash on delivery', 'card' => 'Card', 'bank' => 'Bank transfer'];
    private const MONEY   = ['shipping', 'subtotal', 'total'];

    /** Full state of an order: its columns plus its item lines. */
    public static function snapshot(int $orderId): ?array
    {
        $db    = db_connect();
        $order = $db->table('orders')->where('id', $orderId)->get()->getRowArray();
        if (! $order) {
            return null;
        }
        $order['items'] = array_map(static fn ($i) => [
            'product_id' => $i['product_id'], 'name' => $i['name'], 'sku' => $i['sku'], 'size' => $i['size'], 'color' => $i['color'],
            'qty' => (int) $i['qty'], 'unit_price' => (float) $i['unit_price'], 'line_total' => (float) $i['line_total'],
        ], $db->table('order_items')->where('order_id', $orderId)->orderBy('id')->get()->getResultArray());

        return $order;
    }

    public static function record(int $orderId, string $action, string $summary, ?array $before, ?array $after, ?string $actor = null): void
    {
        $changes = $before && $after ? self::diff($before, $after) : [];
        db_connect()->table('order_history')->insert([
            'order_id'     => $orderId,
            'admin_id'     => $actor ? null : (session('admin_id') ?: null),
            'admin_name'   => $actor ?: (session('admin_name') ?: 'Admin'),
            'action'       => $action,
            'summary'      => mb_substr($summary, 0, 255),
            'changes_json' => json_encode($changes, JSON_UNESCAPED_UNICODE),
            'before_json'  => $before ? json_encode($before, JSON_UNESCAPED_UNICODE) : null,
            'after_json'   => $after ? json_encode($after, JSON_UNESCAPED_UNICODE) : null,
            'created_at'   => date('Y-m-d H:i:s'),
        ]);
    }

    /** @return list<array{label:string,old:?string,new:?string}> */
    public static function diff(array $before, array $after): array
    {
        $out = [];
        foreach (self::LABELS as $field => $label) {
            $a = self::show($field, $before[$field] ?? null);
            $b = self::show($field, $after[$field] ?? null);
            if ($a !== $b) {
                $out[] = ['label' => $label, 'old' => $a, 'new' => $b];
            }
        }

        $key = static fn (array $i) => ($i['product_id'] ?? 'x') . ':' . ($i['size'] ?? '') . ':' . $i['name'];
        $old = [];
        foreach ($before['items'] ?? [] as $i) {
            $old[$key($i)] = $i;
        }
        $new = [];
        foreach ($after['items'] ?? [] as $i) {
            $new[$key($i)] = $i;
        }
        $fmt = static fn (array $i) => $i['qty'] . ' × ' . Cart::money($i['unit_price']);
        foreach ($new as $k => $i) {
            $name = $i['name'] . ($i['size'] ? ' (' . $i['size'] . ')' : '');
            if (! isset($old[$k])) {
                $out[] = ['label' => 'Item added', 'old' => null, 'new' => $name . ' — ' . $fmt($i)];
            } elseif ($fmt($old[$k]) !== $fmt($i)) {
                $out[] = ['label' => 'Item changed', 'old' => $name . ' — ' . $fmt($old[$k]), 'new' => $name . ' — ' . $fmt($i)];
            }
        }
        foreach ($old as $k => $i) {
            if (! isset($new[$k])) {
                $out[] = ['label' => 'Item removed', 'old' => $i['name'] . ($i['size'] ? ' (' . $i['size'] . ')' : '') . ' — ' . $fmt($i), 'new' => null];
            }
        }

        return $out;
    }

    private static function show(string $field, $v): ?string
    {
        if ($v === null || $v === '') {
            return null;
        }
        if ($field === 'payment_method') {
            return self::METHODS[$v] ?? (string) $v;
        }
        if (in_array($field, self::MONEY, true)) {
            return Cart::money($v);
        }
        if ($field === 'created_at') {
            return date('d M Y', strtotime((string) $v));
        }
        if ($field === 'status' || $field === 'payment_status') {
            return ucfirst((string) $v);
        }

        return trim((string) $v);
    }
}
