<?php

namespace App\Database\Seeds;

use App\Libraries\PlaceholderImage;
use CodeIgniter\Database\Seeder;

/**
 * Kidswear catalogue: sub-categories + sample products for the shop page.
 * Safe to re-run: rows are matched by slug and updated in place.
 *
 *   php spark db:seed ShopSeeder
 */
class ShopSeeder extends Seeder
{
    private const CLOTHES = '2-3Y,4-5Y,6-7Y,8-9Y,10-12Y';
    private const BABY    = '0-3M,3-6M,6-12M,12-18M';

    public function run()
    {
        // Retire categories/products we do not stock (shoes, caps, socks, accessories).
        $gone = $this->db->table('categories')->whereIn('slug', ['shoes-accessories', 'kids-shoes', 'kids-caps', 'kids-socks'])->get()->getResultArray();
        if ($gone) {
            $ids = array_column($gone, 'id');
            $this->db->table('products')->whereIn('category_id', $ids)->delete();
            $this->db->table('categories')->whereIn('id', $ids)->delete();
        }

        $now = date('Y-m-d H:i:s');
        $db  = $this->db;

        // Sub-categories under the existing top-level categories.
        $children = [
            'boys-clothing'         => [['boys-tshirts', 'T-Shirts & Polos'], ['boys-bottoms', 'Shorts & Pants'], ['boys-hoodies-jackets', 'Hoodies & Jackets']],
            'girls-clothing'        => [['girls-dresses', 'Dresses'], ['girls-tops', 'Tops & Tees'], ['girls-skirts-leggings', 'Skirts & Leggings']],
            'baby-wear'             => [['baby-rompers', 'Rompers & Onesies'], ['baby-sleepwear', 'Sleepwear']],
            'seasonal-collection'   => [['winter-wear', 'Winter Wear'], ['summer-collection', 'Summer Collection']],
        ];

        $catIds = [];
        foreach ($db->table('categories')->get()->getResultArray() as $row) {
            $catIds[$row['slug']] = (int) $row['id'];
        }

        foreach ($children as $parentSlug => $items) {
            if (! isset($catIds[$parentSlug])) {
                continue;
            }
            foreach ($items as $i => [$slug, $name]) {
                $data = ['parent_id' => $catIds[$parentSlug], 'name' => $name, 'slug' => $slug, 'sort_order' => $i + 1, 'is_active' => 1, 'show_on_home' => 0, 'updated_at' => $now];
                if (isset($catIds[$slug])) {
                    $db->table('categories')->where('id', $catIds[$slug])->update($data);
                } else {
                    $db->table('categories')->insert($data + ['created_at' => $now]);
                    $catIds[$slug] = (int) $db->insertID();
                }
            }
        }

        $catNames = array_column($db->table('categories')->get()->getResultArray(), 'name', 'slug');

        // name, category, price, sale, age, colours, sizes, material, badge, stock, rating, reviews, sold, featured, blurb
        $products = [
            ['Cozy Cotton Dino Tee', 'boys-tshirts', 29.99, 19.99, 'kids', 'green,blue,yellow', self::CLOTHES, '100% combed cotton', 'Hot', 48, 4.8, 64, 210, 1, 'A super-soft tee with a friendly dino print.'],
            ['Floral Ruffle Dress', 'girls-dresses', 45.00, 32.99, 'kids', 'pink,red,white', self::CLOTHES, 'Cotton blend', 'New', 36, 4.7, 41, 120, 1, 'Ruffled sleeves and a twirl-ready skirt.'],
            ['Organic Onesie Set', 'baby-rompers', 39.99, null, 'baby', 'white,yellow,pink', self::BABY, 'GOTS organic cotton', 'Best Seller', 60, 4.9, 112, 430, 1, 'Gentle organic cotton for newborn skin.'],
            ['Denim Jacket Junior', 'boys-hoodies-jackets', 55.00, 44.99, 'kids', 'blue,black', self::CLOTHES, 'Stretch denim', 'Trending', 22, 4.6, 28, 95, 0, 'Classic denim with a comfy stretch fit.'],
            ['Rainbow Knit Cardigan', 'girls-tops', 42.00, 34.99, 'kids', 'red,yellow,green,blue', self::CLOTHES, 'Soft acrylic knit', null, 28, 4.5, 33, 88, 0, 'A cheerful rainbow cardigan for layering.'],
            ['Winter Puffer Jacket', 'winter-wear', 79.99, 59.99, 'kids', 'navy,red,green', self::CLOTHES, 'Recycled polyester fill', 'Sale', 18, 4.8, 52, 140, 1, 'Warm, lightweight and water resistant.'],
            ['Butterfly Graphic Tee', 'girls-tops', 24.99, 17.99, 'kids', 'pink,white,yellow', self::CLOTHES, '100% cotton', 'New', 52, 4.4, 19, 70, 0, 'Shimmer butterfly print on a relaxed tee.'],
            ['Stripe Polo Shirt', 'boys-tshirts', 22.99, null, 'kids', 'navy,white,red', self::CLOTHES, 'Piqué cotton', null, 44, 4.5, 26, 80, 0, 'Smart-casual polo for school and weekends.'],
            ['Superhero Print Tee', 'boys-tshirts', 18.99, 14.99, 'toddler', 'red,blue', '2-3Y,4-5Y,6-7Y', '100% cotton', 'Trending', 70, 4.6, 58, 190, 0, 'Fly into the day with a bold hero graphic.'],
            ['Cargo Jogger Pants', 'boys-bottoms', 32.00, null, 'kids', 'green,gray,black', self::CLOTHES, 'Cotton twill', null, 38, 4.5, 31, 105, 0, 'Roomy pockets and a stretch waistband.'],
            ['Chino Shorts Summer', 'boys-bottoms', 24.50, 19.99, 'kids', 'blue,yellow,orange', self::CLOTHES, 'Lightweight cotton', 'Sale', 55, 4.4, 22, 76, 0, 'Breezy chino shorts for warm days.'],
            ['Fleece Zip Hoodie', 'boys-hoodies-jackets', 48.00, 38.40, 'kids', 'gray,navy,red', self::CLOTHES, 'Brushed fleece', 'Best Seller', 33, 4.8, 94, 310, 1, 'Cosy fleece hoodie with a full zip.'],
            ['Space Explorer Sweatshirt', 'boys-hoodies-jackets', 36.00, null, 'tween', 'black,blue', '8-9Y,10-12Y', 'French terry', 'New', 26, 4.3, 12, 40, 0, 'Glow-in-the-dark planets on soft terry.'],
            ['Twirl Party Dress', 'girls-dresses', 58.00, 46.40, 'kids', 'pink,white,red', self::CLOTHES, 'Tulle and satin', 'Hot', 20, 4.9, 77, 220, 1, 'Layered tulle for birthdays and celebrations.'],
            ['Polka Dot Sundress', 'girls-dresses', 34.99, null, 'toddler', 'red,white,yellow', '2-3Y,4-5Y,6-7Y', 'Cotton poplin', null, 41, 4.6, 36, 118, 0, 'A playful sundress with tie shoulders.'],
            ['Frill Sleeve Top', 'girls-tops', 21.99, null, 'kids', 'white,pink,yellow', self::CLOTHES, 'Cotton jersey', null, 60, 4.4, 17, 64, 0, 'Pretty frills on an everyday top.'],
            ['Pastel Tulle Skirt', 'girls-skirts-leggings', 27.99, 22.99, 'kids', 'pink,blue,yellow', self::CLOTHES, 'Soft tulle, cotton lining', 'New', 35, 4.7, 29, 92, 0, 'Floaty tulle skirt in sweet pastels.'],
            ['Soft Stretch Leggings 3-Pack', 'girls-skirts-leggings', 29.99, null, 'kids', 'black,gray,navy', self::CLOTHES, 'Cotton elastane', 'Best Seller', 80, 4.8, 120, 480, 0, 'Three pairs of comfy everyday leggings.'],
            ['Snuggle Bear Romper', 'baby-rompers', 26.99, null, 'baby', 'brown,white,gray', self::BABY, 'Cotton fleece', 'New', 42, 4.9, 48, 150, 1, 'Bear-ear hood romper for chilly days.'],
            ['Newborn Bodysuit 5-Pack', 'baby-rompers', 34.99, 27.99, 'baby', 'white,pink,blue,yellow', self::BABY, 'Organic cotton', 'Sale', 90, 4.8, 134, 520, 0, 'Envelope neck bodysuits, five to a pack.'],
            ['Starry Night Pyjama Set', 'baby-sleepwear', 28.99, null, 'toddler', 'navy,yellow', '6-12M,12-18M,2-3Y', 'Jersey cotton', null, 37, 4.7, 40, 133, 0, 'Two-piece pyjamas with a starry print.'],
            ['Cloud Soft Sleepsuit', 'baby-sleepwear', 24.99, 19.99, 'baby', 'white,gray,blue', self::BABY, 'Bamboo viscose', 'Trending', 46, 4.9, 66, 205, 0, 'Bamboo-soft sleepsuit with fold-over mitts.'],
            ['Knit Beanie & Scarf Set', 'winter-wear', 24.99, null, 'kids', 'gray,red,green', 'S,M', 'Acrylic knit', 'New', 34, 4.5, 18, 55, 0, 'Matching beanie and scarf to beat the cold.'],
            ['Quilted Winter Vest', 'winter-wear', 52.00, 41.60, 'kids', 'black,orange', self::CLOTHES, 'Quilted polyester', null, 19, 4.6, 23, 61, 0, 'A light quilted vest for layering.'],
            ['Beach Rashguard Set', 'summer-collection', 31.99, null, 'kids', 'blue,orange,pink', self::CLOTHES, 'UPF 50+ stretch fabric', 'New', 29, 4.7, 27, 83, 0, 'Sun-safe rashguard and shorts for beach days.'],
            ['Breezy Linen Shorts Set', 'summer-collection', 38.00, 30.40, 'kids', 'white,yellow,blue', self::CLOTHES, 'Linen blend', 'Trending', 25, 4.6, 16, 49, 0, 'Relaxed linen shirt and shorts, perfectly cool.'],
        ];

        foreach ($products as $i => [$name, $cat, $price, $sale, $age, $colors, $sizes, $material, $badge, $stock, $rating, $reviews, $sold, $featured, $blurb]) {
            $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $name), '-'));
            $img  = "assets/frontend/images/shop/{$slug}.png";
            $hov  = "assets/frontend/images/shop/{$slug}-hover.png";
            // every design is sold in exactly one colour
            $colors = trim(explode(',', $colors)[0]);
            $list   = [$colors];
            // USD sample prices -> PKR, rounded to the nearest 50
            $price = (int) (round($price * 280 / 50) * 50);
            $sale  = $sale !== null ? (int) (round($sale * 280 / 50) * 50) : null;

            PlaceholderImage::make(FCPATH . $img, $name, $catNames[$cat] ?? 'Bloom Kids Wear', $list, $i, false);
            PlaceholderImage::make(FCPATH . $hov, $name, 'Bloom Kids Wear', $list, $i, true);

            $data = [
                'category_id'       => $catIds[$cat],
                'name'              => $name,
                'slug'              => $slug,
                'sku'               => 'BK-' . str_pad((string) (1001 + $i), 4, '0', STR_PAD_LEFT),
                'short_description' => $blurb,
                'description'       => $blurb . ' Made for active kids, designed to be washed again and again.',
                'price'             => $price,
                'sale_price'        => $sale,
                'stock'             => $stock,
                'badge'             => $badge,
                'rating_avg'        => $rating,
                'rating_count'      => $reviews,
                'sold_count'        => $sold,
                'is_featured'       => $featured,
                'is_recommended'    => $featured,
                'is_active'         => 1,
                'sort_order'        => $i + 1,
                'age_group'         => $age,
                'colors'            => $colors,
                'sizes'             => $sizes,
                'material'          => $material,
                'image'             => $img,
                'hover_image'       => $hov,
                'updated_at'        => $now,
            ];

            // Match existing rows by slug first, then by name (the original 8 seeded products).
            $existing = $db->table('products')->where('slug', $slug)->get()->getRowArray();
            if ($existing) {
                $db->table('products')->where('id', $existing['id'])->update($data);
            } else {
                $db->table('products')->insert($data + ['created_at' => $now]);
            }
        }
    }
}
