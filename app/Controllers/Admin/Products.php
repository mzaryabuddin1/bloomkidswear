<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\Shop;
use App\Libraries\PlaceholderImage;

class Products extends BaseController
{
    private const PER_PAGE = 15;
    private const BADGES   = ['New', 'Hot', 'Best Seller', 'Trending', 'Sale'];
    private const IMG_DIR  = 'assets/frontend/images/shop/';

    public function index()
    {
        $db    = db_connect();
        $q     = trim((string) $this->request->getGet('q'));
        $cat   = (int) $this->request->getGet('category');
        $stock = (string) $this->request->getGet('stock');
        $page  = max(1, (int) $this->request->getGet('page'));

        $b = $db->table('products')->select('products.*, categories.name AS category_name')->join('categories', 'categories.id = products.category_id', 'left');
        if ($q !== '') {
            $b->groupStart()->like('products.name', $q)->orLike('products.sku', $q)->groupEnd();
        }
        if ($cat) {
            $b->where('products.category_id', $cat);
        }
        match ($stock) {
            'out'    => $b->where('products.stock <', 1),
            'low'    => $b->where('products.stock >', 0)->where('products.stock <', 10),
            'hidden' => $b->where('products.is_active', 0),
            default  => null,
        };
        $total = (clone $b)->countAllResults();
        $rows  = $b->orderBy('products.id', 'DESC')->limit(self::PER_PAGE, ($page - 1) * self::PER_PAGE)->get()->getResultArray();

        return view('admin/products/index', $this->base('Products', 'products') + [
            'products'   => $rows,
            'total'      => $total,
            'page'       => $page,
            'pages'      => max(1, (int) ceil($total / self::PER_PAGE)),
            'q'          => $q,
            'category'   => $cat,
            'stock'      => $stock,
            'categories' => $this->categories(),
        ]);
    }

    public function create()
    {
        return view('admin/products/form', $this->base('Add Product', 'add-product') + $this->formData(null));
    }

    public function edit(int $id)
    {
        $product = db_connect()->table('products')->where('id', $id)->get()->getRowArray();
        if (! $product) {
            return redirect()->to(site_url('admin/products'))->with('error', 'Product not found.');
        }

        return view('admin/products/form', $this->base('Edit Product', 'products') + $this->formData($product));
    }

    public function store()
    {
        return $this->save(null);
    }

    public function update(int $id)
    {
        return $this->save($id);
    }

    public function toggle(int $id)
    {
        db_connect()->query('UPDATE products SET is_active = 1 - is_active WHERE id = ?', [$id]);

        return redirect()->back()->with('success', 'Visibility updated.');
    }

    public function delete(int $id)
    {
        $db = db_connect();
        $p  = $db->table('products')->where('id', $id)->get()->getRowArray();
        if ($p) {
            $db->table('products')->where('id', $id)->delete();
            foreach ([$p['image'], $p['hover_image']] as $path) {
                if ($path && str_starts_with($path, self::IMG_DIR) && is_file(FCPATH . $path) && $db->table('products')->groupStart()->where('image', $path)->orWhere('hover_image', $path)->groupEnd()->countAllResults() === 0) {
                    @unlink(FCPATH . $path);
                }
            }
        }

        return redirect()->to(site_url('admin/products'))->with('success', 'Product deleted. Past orders keep their own copy of its details.');
    }

    private function save(?int $id)
    {
        $rules = [
            'name'              => 'required|min_length[3]|max_length[191]',
            'category_id'       => 'required|is_natural_no_zero',
            'price'             => 'required|numeric|greater_than[0]',
            'sale_price'        => 'permit_empty|numeric|greater_than[0]',
            'stock'             => 'required|is_natural',
            'color'             => 'required|in_list[' . implode(',', array_keys(PlaceholderImage::COLOR_HEX)) . ']',
            'age_group'         => 'permit_empty|in_list[' . implode(',', array_keys(Shop::AGE_LABELS)) . ']',
            'badge'             => 'permit_empty|in_list[' . implode(',', self::BADGES) . ']',
            'sizes'             => 'required|max_length[255]',
            'short_description' => 'permit_empty|max_length[300]',
            'image'             => 'permit_empty|is_image[image]|max_size[image,3072]|ext_in[image,png,jpg,jpeg,webp]',
            'hover_image'       => 'permit_empty|is_image[hover_image]|max_size[hover_image,3072]|ext_in[hover_image,png,jpg,jpeg,webp]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $db   = db_connect();
        $post = $this->request->getPost();
        $sale = ($post['sale_price'] ?? '') !== '' ? (float) $post['sale_price'] : null;
        if ($sale !== null && $sale >= (float) $post['price']) {
            return redirect()->back()->withInput()->with('error', 'The sale price must be lower than the regular price.');
        }
        $sizes = implode(',', array_filter(array_map('trim', explode(',', (string) $post['sizes'])), 'strlen'));

        $existing = $id ? $db->table('products')->where('id', $id)->get()->getRowArray() : null;
        if ($id && ! $existing) {
            return redirect()->to(site_url('admin/products'))->with('error', 'Product not found.');
        }

        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $post['name']), '-')) ?: 'product';
        $base = $slug;
        for ($n = 2; $db->table('products')->where('slug', $slug)->where('id !=', (int) $id)->countAllResults() > 0; $n++) {
            $slug = $base . '-' . $n;
        }

        $catName = (string) ($db->table('categories')->select('name')->where('id', (int) $post['category_id'])->get()->getRow('name') ?? 'Bloom Kids Wear');
        $image   = $existing['image'] ?? null;
        $hover   = $existing['hover_image'] ?? null;

        if ($up = $this->upload('image', $slug)) {
            $image = $up;
        } elseif (! $image) {
            $image = self::IMG_DIR . $slug . '.png';
            PlaceholderImage::make(FCPATH . $image, $post['name'], $catName, [$post['color']], (int) ($id ?? time()), false);
        }
        if ($up = $this->upload('hover_image', $slug . '-hover')) {
            $hover = $up;
        } elseif (! $hover) {
            $hover = self::IMG_DIR . $slug . '-hover.png';
            PlaceholderImage::make(FCPATH . $hover, $post['name'], 'Bloom Kids Wear', [$post['color']], (int) ($id ?? time()), true);
        }

        $data = [
            'category_id'       => (int) $post['category_id'],
            'name'              => trim($post['name']),
            'slug'              => $slug,
            'short_description' => trim((string) ($post['short_description'] ?? '')),
            'description'       => trim((string) ($post['description'] ?? '')),
            'price'             => (float) $post['price'],
            'sale_price'        => $sale,
            'stock'             => (int) $post['stock'],
            'badge'             => ($post['badge'] ?? '') ?: null,
            'age_group'         => ($post['age_group'] ?? '') ?: null,
            'colors'            => $post['color'],
            'sizes'             => $sizes,
            'material'          => trim((string) ($post['material'] ?? '')) ?: null,
            'image'             => $image,
            'hover_image'       => $hover,
            'is_featured'       => isset($post['is_featured']) ? 1 : 0,
            'is_active'         => isset($post['is_active']) ? 1 : 0,
            'updated_at'        => date('Y-m-d H:i:s'),
        ];

        if ($id) {
            $db->table('products')->where('id', $id)->update($data);
        } else {
            $next = (int) ($db->query('SELECT COALESCE(MAX(id),0)+1 AS n FROM products')->getRow()->n ?? 1);
            $data += [
                'sku'            => trim((string) ($post['sku'] ?? '')) ?: 'BK-' . str_pad((string) (1000 + $next), 4, '0', STR_PAD_LEFT),
                'rating_avg'     => 0,
                'rating_count'   => 0,
                'sold_count'     => 0,
                'is_recommended' => 0,
                'sort_order'     => $next,
                'created_at'     => date('Y-m-d H:i:s'),
            ];
            $db->table('products')->insert($data);
        }
        if ($id && trim((string) ($post['sku'] ?? '')) !== '') {
            $db->table('products')->where('id', $id)->update(['sku' => trim($post['sku'])]);
        }

        return redirect()->to(site_url('admin/products'))->with('success', 'Product saved.');
    }

    private function upload(string $field, string $stem): ?string
    {
        $file = $this->request->getFile($field);
        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }
        $name = $stem . '-' . substr(bin2hex(random_bytes(3)), 0, 6) . '.' . $file->guessExtension();
        $file->move(FCPATH . self::IMG_DIR, $name);

        return self::IMG_DIR . $name;
    }

    private function categories(): array
    {
        $rows = db_connect()->table('categories')->orderBy('sort_order')->orderBy('name')->get()->getResultArray();
        $out  = [];
        foreach ($rows as $r) {
            if (! $r['parent_id']) {
                $out[(int) $r['id']] = ['name' => $r['name'], 'children' => []];
            }
        }
        foreach ($rows as $r) {
            if ($r['parent_id'] && isset($out[(int) $r['parent_id']])) {
                $out[(int) $r['parent_id']]['children'][(int) $r['id']] = $r['name'];
            }
        }

        return $out;
    }

    private function formData(?array $product): array
    {
        return [
            'product'    => $product,
            'categories' => $this->categories(),
            'colors'     => array_keys(PlaceholderImage::COLOR_HEX),
            'ages'       => Shop::AGE_LABELS,
            'badges'     => self::BADGES,
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
