<?php

namespace App\Controllers;

use App\Libraries\Cart as CartLib;
use App\Libraries\PaymentGateway;
use App\Models\CustomerModel;
use App\Models\OrderModel;

/**
 * Checkout: delivery details + payment (cash on delivery or card), then a
 * thank-you page. Prices, stock and totals are always recomputed server-side.
 */
class Checkout extends BaseController
{
    private const PROVINCES = ['Punjab', 'Sindh', 'Khyber Pakhtunkhwa', 'Balochistan', 'Islamabad Capital Territory', 'Azad Jammu & Kashmir', 'Gilgit-Baltistan'];

    public function index()
    {
        $cart = (new CartLib())->summary();
        if (! $cart['items']) {
            return redirect()->to(site_url('cart'))->with('cartNotice', 'Your cart is empty.');
        }

        $customer = session('customer_id') ? (new CustomerModel())->find(session('customer_id')) : null;
        $old      = (session('_ci_old_input')['post'] ?? []);
        $val      = static fn (string $k, string $fallback = '') => $old[$k] ?? $fallback;

        return view('storefront/checkout', [
            'pageTitle'  => 'Checkout | Bloom Kidswear',
            'cart'       => $cart,
            'provinces'  => self::PROVINCES,
            'form'       => [
                'name'        => $val('name', (string) ($customer['name'] ?? '')),
                'email'       => $val('email', (string) ($customer['email'] ?? '')),
                'phone'       => $val('phone', (string) ($customer['phone'] ?? '')),
                'address'     => $val('address', (string) ($customer['address'] ?? '')),
                'city'        => $val('city', (string) ($customer['city'] ?? '')),
                'province'    => $val('province', (string) ($customer['state'] ?? '')),
                'postal_code' => $val('postal_code', (string) ($customer['zip_code'] ?? '')),
                'notes'       => $val('notes'),
                'payment'     => $val('payment', 'cod'),
            ],
            'error'      => session()->getFlashdata('checkoutError'),
            'errors'     => session()->getFlashdata('errors') ?: [],
        ]);
    }

    public function place()
    {
        $lib  = new CartLib();
        $cart = $lib->summary();
        if (! $cart['items']) {
            return redirect()->to(site_url('cart'));
        }

        $rules = [
            'name'        => 'required|min_length[3]|max_length[120]',
            'email'       => 'required|valid_email|max_length[191]',
            'phone'       => 'required|regex_match[/^\+?[0-9][0-9\s\-]{8,15}$/]',
            'address'     => 'required|min_length[8]|max_length[300]',
            'city'        => 'required|max_length[100]',
            'province'    => 'required|in_list[' . implode(',', self::PROVINCES) . ']',
            'postal_code' => 'permit_empty|max_length[20]',
            'notes'       => 'permit_empty|max_length[500]',
            'payment'     => 'required|in_list[cod,card]',
            'terms'       => 'required',
        ];
        $messages = [
            'phone'    => ['regex_match' => 'Enter a valid phone number, e.g. 0300 1234567.'],
            'terms'    => ['required' => 'Please accept the terms and conditions.'],
            'province' => ['in_list' => 'Please choose your province.'],
        ];
        if (! $this->validate($rules, $messages)) {
            return $this->backWithInput()->with('errors', $this->validator->getErrors());
        }

        $post    = $this->request->getPost();
        $payment = $post['payment'];
        $paid    = ['status' => 'pending', 'brand' => null, 'last4' => null, 'ref' => null];

        if ($payment === 'card') {
            $charge = (new PaymentGateway())->charge(
                (string) ($post['card_number'] ?? ''),
                (string) ($post['card_expiry'] ?? ''),
                (string) ($post['card_cvc'] ?? ''),
                (string) ($post['card_name'] ?? ''),
                $cart['total']
            );
            if (! $charge['ok']) {
                // never flash card data back to the form
                return $this->backWithInput()->with('checkoutError', $charge['error']);
            }
            $paid = ['status' => 'paid', 'brand' => $charge['brand'], 'last4' => $charge['last4'], 'ref' => $charge['ref']];
        }

        $db = db_connect();
        $db->transStart();

        // Reserve stock; bail out if anything sold out while the shopper was typing.
        foreach ($cart['items'] as $item) {
            $db->query('UPDATE products SET stock = stock - ?, sold_count = sold_count + ? WHERE id = ? AND stock >= ?', [$item['qty'], $item['qty'], $item['id'], $item['qty']]);
            if ($db->affectedRows() < 1) {
                $db->transRollback();

                return redirect()->to(site_url('cart'))->with('cartNotice', '“' . $item['name'] . '” just sold out or has less stock than you selected. Please review your cart.');
            }
        }

        $number = 'BK' . date('ymd') . random_int(1000, 9999);
        $orders = new OrderModel();
        $orderId = $orders->insert([
            'order_number'   => $number,
            'customer_id'    => session('customer_id') ?: null,
            'email'          => strtolower(trim($post['email'])),
            'status'         => 'placed',
            'total'          => $cart['total'],
            'subtotal'       => $cart['subtotal'],
            'shipping'       => $cart['shipping'],
            'items_count'    => $cart['count'],
            'name'           => trim($post['name']),
            'phone'          => trim($post['phone']),
            'address'        => trim($post['address']),
            'city'           => trim($post['city']),
            'province'       => $post['province'],
            'postal_code'    => trim((string) ($post['postal_code'] ?? '')),
            'notes'          => trim((string) ($post['notes'] ?? '')),
            'payment_method' => $payment,
            'payment_status' => $paid['status'],
            'card_brand'     => $paid['brand'],
            'card_last4'     => $paid['last4'],
            'payment_ref'    => $paid['ref'],
        ]);

        foreach ($cart['items'] as $item) {
            $db->table('order_items')->insert([
                'order_id'   => $orderId,
                'product_id' => $item['id'],
                'name'       => $item['name'],
                'sku'        => $item['sku'],
                'image'      => $item['image_rel'],
                'size'       => $item['size'],
                'color'      => $item['color'],
                'unit_price' => $item['price'],
                'qty'        => $item['qty'],
                'line_total' => $item['line'],
            ]);
        }

        $db->transComplete();
        if ($db->transStatus()) {
            \App\Libraries\OrderHistory::record((int) $orderId, 'created', 'Order placed on the storefront (' . ($payment === 'card' ? 'card' : 'cash on delivery') . ')', null, \App\Libraries\OrderHistory::snapshot((int) $orderId), 'Customer');
        }
        if (! $db->transStatus()) {
            return $this->backWithInput()->with('checkoutError', 'We could not place your order. Please try again.');
        }

        $lib->clear();
        session()->set('last_order', $number);

        \App\Libraries\OrderMailer::sendInvoice((int) $orderId);
        \App\Libraries\AdminNotify::newOrder((int) $orderId);

        return redirect()->to(site_url('checkout/thank-you/' . $number));
    }

    public function thankYou(string $number)
    {
        $order = (new OrderModel())->where('order_number', $number)->first();
        $owns  = $order && (session('last_order') === $number || ($order['customer_id'] && (int) $order['customer_id'] === (int) session('customer_id')));
        if (! $owns) {
            return redirect()->to(site_url('shop'));
        }

        $items = db_connect()->table('order_items')->where('order_id', $order['id'])->get()->getResultArray();

        return view('storefront/thank_you', ['pageTitle' => 'Thank You | Bloom Kidswear', 'order' => $order, 'items' => $items]);
    }

    /** Go back to the form keeping what was typed, but never card details. */
    private function backWithInput()
    {
        $post = $this->request->getPost();
        unset($post['card_number'], $post['card_expiry'], $post['card_cvc'], $post['card_name'], $post[csrf_token()]);
        session()->setFlashdata('_ci_old_input', ['get' => [], 'post' => $post]);

        return redirect()->to(site_url('checkout'));
    }
}
