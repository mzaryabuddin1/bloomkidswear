<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Cart;
use App\Libraries\OrderHistory;
use App\Models\OrderModel;

class Orders extends BaseController
{
    public const STATUSES = ['placed' => 'Placed', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'];
    public const METHODS  = ['cod' => 'Cash on Delivery', 'card' => 'Credit / Debit Card', 'bank' => 'Bank Transfer'];
    public const PAYMENT_STATUSES = ['pending' => 'Pending', 'paid' => 'Paid', 'failed' => 'Failed', 'refund due' => 'Refund due', 'refunded' => 'Refunded'];
    private const PROVINCES = ['Punjab', 'Sindh', 'Khyber Pakhtunkhwa', 'Balochistan', 'Islamabad Capital Territory', 'Azad Jammu & Kashmir', 'Gilgit-Baltistan'];

    private const PER_PAGE = 15;

    public function index()
    {
        $db     = db_connect();
        $status = (string) $this->request->getGet('status');
        $pay    = (string) $this->request->getGet('payment');
        $q      = trim((string) $this->request->getGet('q'));
        $page   = max(1, (int) $this->request->getGet('page'));

        $b = $db->table('orders');
        if (isset(self::STATUSES[$status])) {
            $b->where('status', $status);
        }
        if (isset(self::METHODS[$pay])) {
            $b->where('payment_method', $pay);
        }
        if ($q !== '') {
            $b->groupStart()->like('order_number', ltrim($q, '#'))->orLike('name', $q)->orLike('email', $q)->orLike('phone', $q)->groupEnd();
        }
        $total = (clone $b)->countAllResults();
        $rows  = $b->orderBy('id', 'DESC')->limit(self::PER_PAGE, ($page - 1) * self::PER_PAGE)->get()->getResultArray();

        $counts = [];
        foreach ($db->query('SELECT status, COUNT(*) c FROM orders GROUP BY status')->getResultArray() as $r) {
            $counts[$r['status']] = (int) $r['c'];
        }
        $revenue = (float) ($db->query("SELECT COALESCE(SUM(total),0) s FROM orders WHERE status <> 'cancelled'")->getRow()->s ?? 0);

        return view('admin/orders/index', $this->base('Orders', 'orders') + [
            'orders'   => $rows,
            'total'    => $total,
            'page'     => $page,
            'pages'    => max(1, (int) ceil($total / self::PER_PAGE)),
            'status'   => $status,
            'payment'  => $pay,
            'q'        => $q,
            'counts'   => $counts,
            'revenue'  => $revenue,
            'statuses' => self::STATUSES,
            'methods'  => self::METHODS,
        ]);
    }

    public function show(int $id)
    {
        $order = (new OrderModel())->find($id);
        if (! $order) {
            return redirect()->to(site_url('admin/orders'))->with('error', 'Order not found.');
        }
        $db = db_connect();

        return view('admin/orders/show', $this->base('Order #' . $order['order_number'], 'orders') + [
            'order'    => $order,
            'items'    => $db->table('order_items')->where('order_id', $id)->get()->getResultArray(),
            'history'  => $db->table('order_history')->where('order_id', $id)->orderBy('id', 'DESC')->get()->getResultArray(),
            'statuses' => self::STATUSES,
            'methods'  => self::METHODS,
        ]);
    }

    public function create()
    {
        return view('admin/orders/form', $this->base('Add Order', 'add-order') + $this->formData(null, []));
    }

    public function edit(int $id)
    {
        $order = (new OrderModel())->find($id);
        if (! $order) {
            return redirect()->to(site_url('admin/orders'))->with('error', 'Order not found.');
        }
        if ($order['status'] === 'cancelled') {
            return redirect()->to(site_url('admin/orders/' . $id))->with('error', 'A cancelled order cannot be edited (its stock was already returned).');
        }
        $items = db_connect()->table('order_items')->where('order_id', $id)->orderBy('id')->get()->getResultArray();

        return view('admin/orders/form', $this->base('Edit Order', 'orders') + $this->formData($order, $items));
    }

    public function store()
    {
        return $this->persist(null);
    }

    public function update(int $id)
    {
        return $this->persist($id);
    }

    /** Quick status / tracking update from the order page. */
    public function status(int $id)
    {
        $db     = db_connect();
        $order  = $db->table('orders')->where('id', $id)->get()->getRowArray();
        $status = (string) $this->request->getPost('status');
        if (! $order) {
            return redirect()->to(site_url('admin/orders'))->with('error', 'Order not found.');
        }
        if (! isset(self::STATUSES[$status])) {
            return redirect()->back()->with('error', 'Choose a valid status.');
        }
        if ($order['status'] === 'cancelled' && $status !== 'cancelled') {
            return redirect()->back()->with('error', 'A cancelled order cannot be reopened (its stock was already returned).');
        }

        $before = OrderHistory::snapshot($id);
        $data   = [
            'status'          => $status,
            'tracking_number' => trim((string) $this->request->getPost('tracking_number')) ?: null,
            'carrier'         => trim((string) $this->request->getPost('carrier')) ?: null,
            'updated_at'      => date('Y-m-d H:i:s'),
        ];
        if ($status === 'delivered' && $order['payment_method'] === 'cod') {
            $data['payment_status'] = 'paid';
        }

        $db->transStart();
        if ($status === 'cancelled' && $order['status'] !== 'cancelled') {
            $this->restock($id);
            if ($order['payment_status'] === 'paid' && $order['payment_method'] !== 'cod') {
                $data['payment_status'] = 'refund due';
            }
        }
        $db->table('orders')->where('id', $id)->update($data);
        $db->transComplete();

        $after = OrderHistory::snapshot($id);
        OrderHistory::record($id, 'status', $status !== $order['status'] ? 'Status changed to ' . self::STATUSES[$status] : 'Tracking details updated', $before, $after);
        if ($status !== $order['status']) {
            \App\Libraries\OrderMailer::sendStatus($id);
        }

        return redirect()->to(site_url('admin/orders/' . $id))->with('success', 'Order updated.');
    }

    // ---------------------------------------------------------------------

    private function persist(?int $id)
    {
        $rules = [
            'name'           => 'required|min_length[2]|max_length[120]',
            'email'          => 'required|valid_email|max_length[191]',
            'phone'          => 'required|max_length[50]',
            'address'        => 'required|min_length[5]|max_length[300]',
            'city'           => 'required|max_length[100]',
            'province'       => 'required|max_length[100]',
            'postal_code'    => 'permit_empty|max_length[20]',
            'notes'          => 'permit_empty|max_length[500]',
            'payment_method' => 'required|in_list[' . implode(',', array_keys(self::METHODS)) . ']',
            'payment_status' => 'required|in_list[' . implode(',', array_keys(self::PAYMENT_STATUSES)) . ']',
            'status'         => 'required|in_list[' . implode(',', array_keys(self::STATUSES)) . ']',
            'order_date'     => 'required|valid_date[Y-m-d]',
            'shipping'       => 'required|numeric|greater_than_equal_to[0]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $db   = db_connect();
        $post = $this->request->getPost();
        $existing = $id ? $db->table('orders')->where('id', $id)->get()->getRowArray() : null;
        if ($id && ! $existing) {
            return redirect()->to(site_url('admin/orders'))->with('error', 'Order not found.');
        }
        if ($existing && $existing['status'] === 'cancelled') {
            return redirect()->to(site_url('admin/orders/' . $id))->with('error', 'A cancelled order cannot be edited.');
        }

        // ---- item lines --------------------------------------------------
        $oldItems = $id ? $db->table('order_items')->where('order_id', $id)->get()->getResultArray() : [];
        $oldById  = array_column($oldItems, null, 'id');
        $lines    = [];
        foreach ((array) ($post['lines'] ?? []) as $raw) {
            $qty   = (int) ($raw['qty'] ?? 0);
            $price = (float) ($raw['unit_price'] ?? 0);
            if ($qty < 1 || $price < 0) {
                continue;
            }
            $size = trim((string) ($raw['size'] ?? ''));
            if (! empty($raw['item_id']) && isset($oldById[(int) $raw['item_id']])) {
                $o = $oldById[(int) $raw['item_id']];
                $lines[] = ['product_id' => $o['product_id'], 'name' => $o['name'], 'sku' => $o['sku'], 'image' => $o['image'], 'color' => $o['color'], 'size' => $size !== '' ? $size : $o['size'], 'qty' => $qty, 'unit_price' => $price];
            } else {
                $p = $db->table('products')->where('id', (int) ($raw['product_id'] ?? 0))->get()->getRowArray();
                if (! $p) {
                    continue;
                }
                $sizes = array_filter(explode(',', (string) $p['sizes']), 'strlen');
                if ($sizes && ! in_array($size, $sizes, true)) {
                    return redirect()->back()->withInput()->with('error', 'Choose a size for "' . $p['name'] . '".');
                }
                $lines[] = ['product_id' => (int) $p['id'], 'name' => $p['name'], 'sku' => $p['sku'], 'image' => $p['image'], 'color' => $p['colors'], 'size' => $size, 'qty' => $qty, 'unit_price' => $price];
            }
        }
        if (! $lines) {
            return redirect()->back()->withInput()->with('error', 'Add at least one product to the order.');
        }

        $subtotal = 0;
        $count    = 0;
        foreach ($lines as &$l) {
            $l['line_total'] = round($l['unit_price'] * $l['qty'], 2);
            $subtotal       += $l['line_total'];
            $count          += $l['qty'];
        }
        unset($l);
        $shipping = round((float) $post['shipping'], 2);
        $status   = (string) $post['status'];

        // ---- stock: apply the difference between old and new quantities ----
        $delta = [];
        foreach ($oldItems as $o) {
            if ($o['product_id']) {
                $delta[(int) $o['product_id']] = ($delta[(int) $o['product_id']] ?? 0) - (int) $o['qty'];
            }
        }
        foreach ($lines as $l) {
            if ($l['product_id']) {
                $delta[(int) $l['product_id']] = ($delta[(int) $l['product_id']] ?? 0) + $l['qty'];
            }
        }

        $before = $id ? OrderHistory::snapshot($id) : null;

        $db->transStart();
        foreach ($delta as $pid => $d) {
            if ($d === 0) {
                continue;
            }
            $db->query('UPDATE products SET stock = stock - ?, sold_count = GREATEST(sold_count + ?, 0) WHERE id = ? AND stock - ? >= 0', [$d, $d, $pid, $d]);
            if ($db->affectedRows() < 1) {
                $db->transRollback();
                $name = $db->table('products')->select('name')->where('id', $pid)->get()->getRow('name');

                return redirect()->back()->withInput()->with('error', 'Not enough stock for "' . $name . '" to add that many.');
            }
        }

        $customer = $db->table('customers')->select('id')->where('email', strtolower(trim($post['email'])))->get()->getRow('id');
        $data = [
            'customer_id'    => $customer ?: ($existing['customer_id'] ?? null),
            'email'          => strtolower(trim($post['email'])),
            'status'         => $status,
            'subtotal'       => $subtotal,
            'shipping'       => $shipping,
            'total'          => $subtotal + $shipping,
            'items_count'    => $count,
            'name'           => trim($post['name']),
            'phone'          => trim($post['phone']),
            'address'        => trim($post['address']),
            'city'           => trim($post['city']),
            'province'       => trim($post['province']),
            'postal_code'    => trim((string) ($post['postal_code'] ?? '')),
            'notes'          => trim((string) ($post['notes'] ?? '')),
            'payment_method' => $post['payment_method'],
            'payment_status' => $post['payment_status'],
            'tracking_number' => trim((string) ($post['tracking_number'] ?? '')) ?: null,
            'carrier'        => trim((string) ($post['carrier'] ?? '')) ?: null,
            'created_at'     => $post['order_date'] . ' ' . ($existing ? date('H:i:s', strtotime($existing['created_at'])) : date('H:i:s')),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        if ($id) {
            $db->table('orders')->where('id', $id)->update($data);
            $db->table('order_items')->where('order_id', $id)->delete();
        } else {
            $number = 'BK' . date('ymd') . random_int(1000, 9999);
            $db->table('orders')->insert($data + ['order_number' => $number, 'card_brand' => null, 'card_last4' => null, 'payment_ref' => null]);
            $id = (int) $db->insertID();
        }
        foreach ($lines as $l) {
            $db->table('order_items')->insert(['order_id' => $id] + $l);
        }

        // Cancelling from the edit form returns the (new) quantities to stock.
        if ($status === 'cancelled') {
            $this->restock($id);
            if ($data['payment_status'] === 'paid' && $data['payment_method'] !== 'cod') {
                $db->table('orders')->where('id', $id)->update(['payment_status' => 'refund due']);
            }
        }
        $db->transComplete();

        $after = OrderHistory::snapshot($id);
        if ($before) {
            $n = count(OrderHistory::diff($before, $after));
            OrderHistory::record($id, 'updated', $n ? "Order edited ({$n} change" . ($n === 1 ? '' : 's') . ')' : 'Order saved with no changes', $before, $after);
            if (($before['status'] ?? null) !== $after['status']) {
                \App\Libraries\OrderMailer::sendStatus($id);
            }
        } else {
            OrderHistory::record($id, 'created', 'Order created by admin', null, $after);
            \App\Libraries\OrderMailer::sendInvoice($id);
        }

        return redirect()->to(site_url('admin/orders/' . $id))->with('success', $before ? 'Order updated. The previous version is kept in the history.' : 'Order created.');
    }

    private function restock(int $orderId): void
    {
        $db = db_connect();
        foreach ($db->table('order_items')->where('order_id', $orderId)->get()->getResultArray() as $item) {
            if ($item['product_id']) {
                $db->query('UPDATE products SET stock = stock + ?, sold_count = GREATEST(sold_count - ?, 0) WHERE id = ?', [$item['qty'], $item['qty'], $item['product_id']]);
            }
        }
    }

    private function formData(?array $order, array $items): array
    {
        $products = db_connect()->query('SELECT id, name, sku, image, sizes, stock, price, sale_price, is_active FROM products ORDER BY is_active DESC, name')->getResultArray();
        foreach ($products as &$p) {
            $p['effective'] = (int) round($p['sale_price'] !== null && (float) $p['sale_price'] < (float) $p['price'] ? $p['sale_price'] : $p['price']);
        }
        unset($p);

        return [
            'order'     => $order,
            'items'     => $items,
            'products'  => $products,
            'methods'   => self::METHODS,
            'payStates' => self::PAYMENT_STATUSES,
            'statuses'  => self::STATUSES,
            'provinces' => self::PROVINCES,
            'freeOver'  => Cart::FREE_SHIPPING_OVER,
            'flat'      => Cart::FLAT_SHIPPING,
        ];
    }

    private function base(string $title, string $nav): array
    {
        return [
            'title'      => $title,
            'adminName'  => session()->get('admin_name'),
            'adminEmail' => session()->get('admin_email'),
            'activeNav'  => $nav,
        ];
    }
}
