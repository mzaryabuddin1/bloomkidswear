<?php

namespace App\Controllers;

use App\Libraries\Cart as CartLib;

/**
 * Shopping cart: the /cart page plus the JSON endpoints used by the
 * sidebar mini-cart and the "Add To Cart" buttons.
 */
class Cart extends BaseController
{
    public function index(): string
    {
        return view('storefront/cart', ['pageTitle' => 'Shopping Cart | Bloom Kidswear', 'cart' => (new CartLib())->summary()]);
    }

    public function data()
    {
        return $this->respond();
    }

    public function add()
    {
        $id   = (int) $this->request->getPost('product_id');
        $size = trim((string) $this->request->getPost('size'));
        $qty  = max(1, min(CartLib::MAX_QTY, (int) $this->request->getPost('qty')));

        $notice = (new CartLib())->add($id, $size, $qty);
        $failed = $notice !== null && (str_starts_with($notice, 'Please') || str_starts_with($notice, 'Sorry') || str_starts_with($notice, 'This'));

        return $this->respond($failed ? $notice : null, $failed ? 422 : 200, $failed ? null : ($notice ?? 'Added to your cart.'));
    }

    public function update()
    {
        (new CartLib())->setQty((string) $this->request->getPost('key'), (int) $this->request->getPost('qty'));

        return $this->respond();
    }

    public function remove()
    {
        (new CartLib())->remove((string) $this->request->getPost('key'));

        return $this->respond();
    }

    private function respond(?string $error = null, int $status = 200, ?string $message = null)
    {
        $cart = (new CartLib())->summary();

        return $this->response->setStatusCode($status)->setJSON([
            'success'   => $error === null,
            'message'   => $error ?? $message ?? '',
            'cart'      => $cart,
            'csrfToken' => csrf_token(),
            'csrfHash'  => csrf_hash(),
        ]);
    }
}
