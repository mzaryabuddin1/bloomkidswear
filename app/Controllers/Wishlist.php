<?php

namespace App\Controllers;

use App\Models\WishlistModel;

/**
 * Server side of the wishlist. Guests keep their list in localStorage;
 * once signed in the browser syncs it here and it is saved on the account.
 */
class Wishlist extends BaseController
{
    public function index(): string
    {
        return view('storefront/wishlist', ['pageTitle' => 'My Wishlist | Bloom Kidswear']);
    }

    public function items()
    {
        return $this->respond(true);
    }

    public function toggle()
    {
        $item = $this->cleanItem($this->request->getPost());
        if (! $item) {
            return $this->respond(false, 'Invalid item.', 422);
        }

        $model = new WishlistModel();
        $row   = $model->where('customer_id', session('customer_id'))->where('item_key', $item['item_key'])->first();

        if ($row) {
            $model->delete($row['id']);
        } else {
            $model->insert($item + ['customer_id' => session('customer_id'), 'created_at' => date('Y-m-d H:i:s')]);
        }

        return $this->respond(true, $row ? 'Removed from wishlist.' : 'Added to wishlist.');
    }

    public function remove()
    {
        (new WishlistModel())
            ->where('customer_id', session('customer_id'))
            ->where('item_key', (string) $this->request->getPost('key'))
            ->delete();

        return $this->respond(true);
    }

    /** Merge the guest (localStorage) list into the signed in customer's list. */
    public function sync()
    {
        $items = json_decode((string) $this->request->getPost('items'), true);
        $model = new WishlistModel();

        foreach (is_array($items) ? array_slice($items, 0, 100) : [] as $raw) {
            $item = $this->cleanItem(is_array($raw) ? $raw : []);
            if (! $item) {
                continue;
            }
            $exists = $model->where('customer_id', session('customer_id'))->where('item_key', $item['item_key'])->first();
            if (! $exists) {
                $model->insert($item + ['customer_id' => session('customer_id'), 'created_at' => date('Y-m-d H:i:s')]);
            }
        }

        return $this->respond(true);
    }

    private function cleanItem(array $data): ?array
    {
        $key  = trim((string) ($data['key'] ?? ''));
        $name = trim((string) ($data['name'] ?? ''));

        if ($key === '' || $name === '') {
            return null;
        }

        $safeUrl = static function ($value) {
            $value = trim((string) $value);

            return preg_match('#^(https?://|/|[A-Za-z0-9_\-./]+\.html?$)#', $value) ? mb_substr($value, 0, 500) : null;
        };

        return [
            'item_key' => mb_substr($key, 0, 191),
            'name'     => mb_substr($name, 0, 255),
            'image'    => $safeUrl($data['image'] ?? ''),
            'url'      => $safeUrl($data['url'] ?? ''),
            'price'    => mb_substr(trim((string) ($data['price'] ?? '')), 0, 50) ?: null,
        ];
    }

    private function respond(bool $success, string $message = '', int $status = 200)
    {
        $items = (new WishlistModel())
            ->where('customer_id', session('customer_id'))
            ->orderBy('id', 'DESC')
            ->findAll();

        return $this->response->setStatusCode($status)->setJSON([
            'success'   => $success,
            'message'   => $message,
            'items'     => array_map(static fn ($r) => [
                'key' => $r['item_key'], 'name' => $r['name'], 'image' => $r['image'], 'url' => $r['url'], 'price' => $r['price'],
            ], $items),
            'csrfToken' => csrf_token(),
            'csrfHash'  => csrf_hash(),
        ]);
    }
}
