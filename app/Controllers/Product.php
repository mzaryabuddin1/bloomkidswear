<?php

namespace App\Controllers;

class Product extends BaseController
{
    public function show(string $slug): string
    {
        $db = db_connect();
        $p  = $db->table('products')
            ->select('products.*, categories.name AS category_name, categories.slug AS category_slug')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->where('products.slug', $slug)->where('products.is_active', 1)
            ->get()->getRowArray();
        if (! $p) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $related = $db->table('products')
            ->select('products.*, categories.name AS category_name')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->where('products.is_active', 1)->where('products.id !=', $p['id'])
            ->where('products.category_id', $p['category_id'])
            ->orderBy('sold_count', 'DESC')->limit(4)->get()->getResultArray();

        return view('storefront/product', [
            'pageTitle' => $p['name'],
            'p'         => $p,
            'related'   => $related,
            'ageLabels' => Shop::AGE_LABELS,
        ]);
    }
}
