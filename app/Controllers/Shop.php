<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Shop extends BaseController
{
    public const AGE_LABELS = [
        'baby'    => 'Baby (0–2 yrs)',
        'toddler' => 'Toddler (2–4 yrs)',
        'kids'    => 'Kids (5–8 yrs)',
        'tween'   => 'Tween (9–12 yrs)',
    ];

    private const PRICE_RANGES = [
        '0-2000'    => ['Under PKR 2,000', 0, 2000],
        '2000-4000' => ['PKR 2,000 – 4,000', 2000, 4000],
        '4000-6000' => ['PKR 4,000 – 6,000', 4000, 6000],
        '6000-up'   => ['PKR 6,000 & above', 6000, 9999999],
    ];

    private const SORTS = [
        'latest'     => 'Sort by latest',
        'popular'    => 'Most popular',
        'rating'     => 'Top rated',
        'price_asc'  => 'Price: low to high',
        'price_desc' => 'Price: high to low',
    ];

    private const FLAGS = [
        'featured'   => ['Featured', 'fa-truck-fast'],
        'bestseller' => ['Best Sellers', 'fa-stars'],
        'toprated'   => ['Top Rated', 'fa-badge-check'],
        'new'        => ['New Arrivals', 'fa-calendar-days'],
        'sale'       => ['On Sale', 'fa-money-bill'],
    ];

    public function index(?string $categorySlug = null): string
    {
        $get = $this->request->getGet();
        if ($categorySlug) {
            $get['category'] = $categorySlug;
        }

        $db   = db_connect();
        $tree = (new CategoryModel())->tree();
        $cats = [];
        foreach ($tree as $parent) {
            $cats[$parent['slug']] = $parent;
            foreach ($parent['children'] as $child) {
                $cats[$child['slug']] = $child + ['parent_slug' => $parent['slug']];
            }
        }

        // ---- normalise filters -------------------------------------------------
        $list = static fn ($v) => is_array($v) ? $v : array_filter(explode(',', (string) $v), 'strlen');
        $f = [
            'category' => isset($cats[$get['category'] ?? '']) ? $get['category'] : null,
            'q'        => trim((string) ($get['q'] ?? '')),
            'colors'   => array_values(array_intersect($list($get['colors'] ?? []), array_keys(\App\Libraries\PlaceholderImage::COLOR_HEX))),
            'sizes'    => array_values(array_filter(array_map('strval', $list($get['sizes'] ?? [])), static fn ($s) => preg_match('/^[A-Za-z0-9 \-]{1,12}$/', $s))),
            'age'      => isset(self::AGE_LABELS[$get['age'] ?? '']) ? $get['age'] : null,
            'price'    => isset(self::PRICE_RANGES[$get['price'] ?? '']) ? $get['price'] : null,
            'min'      => is_numeric($get['min'] ?? null) ? max(0, (float) $get['min']) : null,
            'max'      => is_numeric($get['max'] ?? null) ? max(0, (float) $get['max']) : null,
            'rating'   => in_array((int) ($get['rating'] ?? 0), [2, 3, 4], true) ? (int) $get['rating'] : null,
            'flag'     => isset(self::FLAGS[$get['flag'] ?? '']) ? $get['flag'] : null,
            'sort'     => isset(self::SORTS[$get['sort'] ?? '']) ? $get['sort'] : 'latest',
            'per'      => in_array((int) ($get['per'] ?? 0), [8, 12, 16, 24], true) ? (int) $get['per'] : 12,
        ];
        $page = max(1, (int) ($get['page'] ?? 1));

        // ---- query -------------------------------------------------------------
        // ---- query -------------------------------------------------------------
        $price = 'COALESCE(products.sale_price, products.price)';
        $b     = $this->filtered($db, $f, $cats);

        $total = (clone $b)->countAllResults();

        match ($f['sort']) {
            'popular'    => $b->orderBy('products.sold_count', 'DESC'),
            'rating'     => $b->orderBy('products.rating_avg', 'DESC')->orderBy('products.rating_count', 'DESC'),
            'price_asc'  => $b->orderBy($price, 'ASC', false),
            'price_desc' => $b->orderBy($price, 'DESC', false),
            default      => $b->orderBy('products.id', 'DESC'),
        };

        $pages    = max(1, (int) ceil($total / $f['per']));
        $page     = min($page, $pages);
        $products = $b->limit($f['per'], ($page - 1) * $f['per'])->get()->getResultArray();

        // ---- sidebar counts (whole active catalogue) ---------------------------
        $all = $db->table('products')->select('category_id, image, colors, sizes, age_group, price, sale_price, rating_avg')->where('is_active', 1)->get()->getResultArray();
        $idToSlug = array_column($cats, 'slug', 'id');
        $counts = ['cat' => [], 'color' => [], 'size' => [], 'age' => [], 'price' => []];
        $catImages = [];
        foreach ($all as $p) {
            $slug = $idToSlug[$p['category_id']] ?? null;
            if ($slug) {
                $catImages[$slug] ??= $p['image'];
                if (! empty($cats[$slug]['parent_slug'])) {
                    $catImages[$cats[$slug]['parent_slug']] ??= $p['image'];
                }
                $counts['cat'][$slug] = ($counts['cat'][$slug] ?? 0) + 1;
                if (! empty($cats[$slug]['parent_slug'])) {
                    $counts['cat'][$cats[$slug]['parent_slug']] = ($counts['cat'][$cats[$slug]['parent_slug']] ?? 0) + 1;
                }
            }
            foreach (array_filter(explode(',', (string) $p['colors'])) as $c) {
                $counts['color'][$c] = ($counts['color'][$c] ?? 0) + 1;
            }
            foreach (array_filter(explode(',', (string) $p['sizes'])) as $s) {
                $counts['size'][$s] = ($counts['size'][$s] ?? 0) + 1;
            }
            if ($p['age_group']) {
                $counts['age'][$p['age_group']] = ($counts['age'][$p['age_group']] ?? 0) + 1;
            }
            $eff = (float) ($p['sale_price'] ?? $p['price']);
            foreach (self::PRICE_RANGES as $key => [, $lo, $hi]) {
                if ($eff >= $lo && $eff < $hi) {
                    $counts['price'][$key] = ($counts['price'][$key] ?? 0) + 1;
                }
            }
        }
        ksort($counts['size']);

        // ---- helpers for the view ---------------------------------------------
        $base = site_url('shop');
        $url = static function (array $override = []) use ($f, $base): string {
            $override = array_map(static fn ($v) => is_array($v) ? implode(',', $v) : $v, $override);
            $params = array_merge([
                'category' => $f['category'], 'q' => $f['q'] ?: null, 'colors' => $f['colors'] ? implode(',', $f['colors']) : null, 'sizes' => $f['sizes'] ? implode(',', $f['sizes']) : null,
                'age' => $f['age'], 'price' => $f['price'], 'min' => $f['min'], 'max' => $f['max'], 'rating' => $f['rating'],
                'flag' => $f['flag'], 'sort' => $f['sort'] === 'latest' ? null : $f['sort'], 'per' => $f['per'] === 12 ? null : $f['per'],
            ], $override);
            $params = array_filter($params, static fn ($v) => $v !== null && $v !== '' && $v !== []);

            return $base . ($params ? '?' . str_replace(['%2C', '%20'], [',', '+'], http_build_query($params)) : '');
        };

        // active filter chips
        $chips = [];
        if ($f['category']) {
            $chips[] = [$cats[$f['category']]['name'], $url(['category' => null]), ['category' => null]];
        }
        if ($f['q'] !== '') {
            $chips[] = ['“' . $f['q'] . '”', $url(['q' => null]), ['q' => '']];
        }
        foreach ($f['colors'] as $c) {
            $chips[] = [ucfirst($c), $url(['colors' => array_values(array_diff($f['colors'], [$c]))]), ['colors' => array_values(array_diff($f['colors'], [$c]))]];
        }
        foreach ($f['sizes'] as $s) {
            $chips[] = ['Size ' . $s, $url(['sizes' => array_values(array_diff($f['sizes'], [$s]))]), ['sizes' => array_values(array_diff($f['sizes'], [$s]))]];
        }
        if ($f['age']) {
            $chips[] = [self::AGE_LABELS[$f['age']], $url(['age' => null]), ['age' => null]];
        }
        if ($f['price']) {
            $chips[] = [self::PRICE_RANGES[$f['price']][0], $url(['price' => null]), ['price' => null]];
        }
        if ($f['min'] !== null || $f['max'] !== null) {
            $chips[] = ['PKR ' . number_format($f['min'] ?? 0) . ' – ' . ($f['max'] ? 'PKR ' . number_format($f['max']) : 'any'), $url(['min' => null, 'max' => null]), ['min' => null, 'max' => null]];
        }
        if ($f['rating']) {
            $chips[] = [$f['rating'] . '★ & up', $url(['rating' => null]), ['rating' => null]];
        }
        if ($f['flag']) {
            $chips[] = [self::FLAGS[$f['flag']][0], $url(['flag' => null]), ['flag' => null]];
        }

        // nothing matched: work out which single filter to drop to get products back
        $suggestions = [];
        if (! $products) {
            foreach ($chips as [$label, , $override]) {
                $n = (clone $this->filtered($db, array_merge($f, $override), $cats))->countAllResults();
                if ($n > 0) {
                    $suggestions[] = [$label, $url($override), $n];
                }
            }
            usort($suggestions, static fn ($a, $b) => $b[2] <=> $a[2]);
        }

        $title = $f['category'] ? $cats[$f['category']]['name'] : 'Shop All Kidswear';

        return view('storefront/shop', [
            'pageTitle'   => $title . ' | Bloom Kidswear',
            'title'       => $title,
            'tree'        => $tree,
            'cats'        => $cats,
            'f'           => $f,
            'products'    => $products,
            'total'       => $total,
            'page'        => $page,
            'pages'       => $pages,
            'from'        => $total ? ($page - 1) * $f['per'] + 1 : 0,
            'to'          => min($total, $page * $f['per']),
            'counts'      => $counts,
            'catImages'   => $catImages,
            'url'         => $url,
            'suggestions' => $suggestions,
            'chips'       => $chips,
            'ageLabels'   => self::AGE_LABELS,
            'priceRanges' => self::PRICE_RANGES,
            'sorts'       => self::SORTS,
            'flags'       => self::FLAGS,
            'colorHex'    => \App\Libraries\PlaceholderImage::COLOR_HEX,
        ]);
    }

    private function filtered($db, array $f, array $cats)
    {
        $price = 'COALESCE(products.sale_price, products.price)';
        $b = $db->table('products')
            ->select('products.*, categories.name AS category_name, categories.slug AS category_slug')
            ->join('categories', 'categories.id = products.category_id')
            ->where('products.is_active', 1);

        if ($f['category']) {
            $ids = [(int) $cats[$f['category']]['id']];
            foreach ($cats[$f['category']]['children'] ?? [] as $child) {
                $ids[] = (int) $child['id'];
            }
            $b->whereIn('products.category_id', $ids);
        }
        if ($f['q'] !== '') {
            $b->groupStart()->like('products.name', $f['q'])->orLike('products.short_description', $f['q'])->orLike('categories.name', $f['q'])->groupEnd();
        }
        foreach ($f['colors'] as $c) {
            $b->where('FIND_IN_SET(' . $db->escape($c) . ', products.colors) >', 0, false);
        }
        foreach ($f['sizes'] as $s) {
            $b->where('FIND_IN_SET(' . $db->escape($s) . ', products.sizes) >', 0, false);
        }
        if ($f['age']) {
            $b->where('products.age_group', $f['age']);
        }
        if ($f['price']) {
            [, $lo, $hi] = self::PRICE_RANGES[$f['price']];
            $b->where("$price >=", $lo, false)->where("$price <", $hi, false);
        }
        if ($f['min'] !== null) {
            $b->where("$price >=", $f['min'], false);
        }
        if ($f['max'] !== null && $f['max'] > 0) {
            $b->where("$price <=", $f['max'], false);
        }
        if ($f['rating']) {
            $b->where('products.rating_avg >=', $f['rating']);
        }
        match ($f['flag']) {
            'featured'   => $b->where('products.is_featured', 1),
            'bestseller' => $b->groupStart()->where('products.badge', 'Best Seller')->orWhere('products.sold_count >=', 200)->groupEnd(),
            'toprated'   => $b->where('products.rating_avg >=', 4.8),
            'new'        => $b->where('products.badge', 'New'),
            'sale'       => $b->where('products.sale_price IS NOT NULL', null, false),
            default      => null,
        };

        return $b;
    }
}
