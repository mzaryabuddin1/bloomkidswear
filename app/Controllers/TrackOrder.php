<?php

namespace App\Controllers;

use App\Models\OrderModel;

class TrackOrder extends BaseController
{
    public function index(): string
    {
        return view('storefront/track_order', $this->data());
    }

    public function lookup(): string
    {
        $data = $this->data();

        if (! $this->validate(['order_number' => 'required|max_length[30]', 'email' => 'required|valid_email'])) {
            $data['error'] = 'Please enter your order number and the email used at checkout.';

            return view('storefront/track_order', $data);
        }

        $number = strtoupper(trim((string) $this->request->getPost('order_number')));
        $email  = strtolower(trim((string) $this->request->getPost('email')));

        $order = (new OrderModel())
            ->where('order_number', ltrim($number, '#'))
            ->where('email', $email)
            ->first();

        if (! $order) {
            $data['error'] = 'We could not find an order matching those details. Please check and try again.';
        } else {
            $data['order'] = $order;
        }

        return view('storefront/track_order', $data);
    }

    private function data(): array
    {
        return [
            'pageTitle' => 'Track Your Order | Bloom Kidswear',
            'error'     => null,
            'order'     => null,
            'email'     => session('customer_email'),
        ];
    }
}
