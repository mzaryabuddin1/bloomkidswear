<?php

namespace App\Libraries;

/**
 * Session-backed shopping cart (works for guests and signed-in customers).
 * The session only stores product id, size and quantity: names, prices and
 * stock are always re-read from the database so they cannot be tampered with.
 */
class Cart
{
    public const FREE_SHIPPING_OVER = 10000;
    public const FLAT_SHIPPING      = 250;
    public const MAX_QTY            = 10;

    private \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->session = session();
    }

    /** Returns an error/notice message, or null when added cleanly. */
    public function add(int $productId, string $size, int $qty = 1): ?string
    {
        $product = $this->product($productId);
        if (! $product) {
            return 'This product is no longer available.';
        }
        $sizes = array_filter(explode(',', (string) $product['sizes']), 'strlen');
        if ($sizes && ! in_array($size, $sizes, true)) {
            return 'Please select a size.';
        }
        if ((int) $product['stock'] < 1) {
            return 'Sorry, this item is out of stock.';
        }

        $key   = $productId . ':' . $size;
        $items = $this->raw();
        $new   = ($items[$key]['qty'] ?? 0) + max(1, $qty);
        $limit = min(self::MAX_QTY, (int) $product['stock']);
        $items[$key] = ['id' => $productId, 'size' => $size, 'qty' => min($new, $limit)];
        $this->save($items);

        return $new > $limit ? "Only {$limit} available for this item." : null;
    }

    public function setQty(string $key, int $qty): void
    {
        $items = $this->raw();
        if (! isset($items[$key])) {
            return;
        }
        if ($qty < 1) {
            unset($items[$key]);
        } else {
            $product = $this->product($items[$key]['id']);
            $limit   = $product ? min(self::MAX_QTY, (int) $product['stock']) : 1;
            $items[$key]['qty'] = min($qty, max(1, $limit));
        }
        $this->save($items);
    }

    public function remove(string $key): void
    {
        $items = $this->raw();
        unset($items[$key]);
        $this->save($items);
    }

    public function clear(): void
    {
        $this->session->remove('cart');
    }

    /** Full priced summary used by the sidebar, cart page and checkout. */
    public function summary(): array
    {
        $raw = $this->raw();
        $out = ['items' => [], 'count' => 0, 'subtotal' => 0, 'shipping' => 0, 'total' => 0];
        if (! $raw) {
            return $out + ['freeOver' => self::FREE_SHIPPING_OVER, 'remaining' => self::FREE_SHIPPING_OVER, 'progress' => 0];
        }

        $ids  = array_values(array_unique(array_column($raw, 'id')));
        $rows = [];
        foreach (db_connect()->table('products')->whereIn('id', $ids)->where('is_active', 1)->get()->getResultArray() as $r) {
            $rows[(int) $r['id']] = $r;
        }

        $clean = [];
        foreach ($raw as $key => $line) {
            $p = $rows[$line['id']] ?? null;
            if (! $p || (int) $p['stock'] < 1) {
                continue; // vanished or sold out since it was added
            }
            $qty   = min($line['qty'], (int) $p['stock'], self::MAX_QTY);
            $price = (int) round($p['sale_price'] !== null && (float) $p['sale_price'] < (float) $p['price'] ? $p['sale_price'] : $p['price']);
            $clean[$key] = ['id' => $line['id'], 'size' => $line['size'], 'qty' => $qty];

            $out['items'][] = [
                'key'       => $key,
                'id'        => (int) $p['id'],
                'name'      => $p['name'],
                'sku'       => $p['sku'],
                'image'     => base_url($p['image']),
                'image_rel' => $p['image'],
                'url'       => site_url('shop?q=' . rawurlencode($p['name'])),
                'size'      => $line['size'],
                'color'     => $p['colors'],
                'price'     => $price,
                'qty'       => $qty,
                'max'       => min(self::MAX_QTY, (int) $p['stock']),
                'line'      => $price * $qty,
            ];
            $out['count']    += $qty;
            $out['subtotal'] += $price * $qty;
        }
        if ($clean !== $raw) {
            $this->save($clean);
        }

        $out['shipping']  = $out['subtotal'] === 0 || $out['subtotal'] >= self::FREE_SHIPPING_OVER ? 0 : self::FLAT_SHIPPING;
        $out['total']     = $out['subtotal'] + $out['shipping'];
        $out['freeOver']  = self::FREE_SHIPPING_OVER;
        $out['remaining'] = max(0, self::FREE_SHIPPING_OVER - $out['subtotal']);
        $out['progress']  = min(100, (int) round($out['subtotal'] / self::FREE_SHIPPING_OVER * 100));

        return $out;
    }

    public static function money($v): string
    {
        return 'PKR ' . number_format((float) $v);
    }

    private function product(int $id): ?array
    {
        return db_connect()->table('products')->where('id', $id)->where('is_active', 1)->get()->getRowArray();
    }

    private function raw(): array
    {
        $items = $this->session->get('cart');

        return is_array($items) ? $items : [];
    }

    private function save(array $items): void
    {
        $this->session->set('cart', $items);
    }
}
