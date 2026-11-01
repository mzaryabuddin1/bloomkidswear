<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * `categories` and `products` were originally created by hand, so a fresh
 * database (e.g. the live server) had no migration that builds them and
 * CreateShopCatalog failed. This creates them when missing (a no-op where they
 * already exist) and seeds the four top-level kidswear categories.
 */
class CreateCatalogTables extends Migration
{
    public function up()
    {
        $this->db->query(<<<'SQL'
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `show_on_home` tinyint(1) DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
SQL);

        $this->db->query(<<<'SQL'
CREATE TABLE IF NOT EXISTS `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `link_url` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sale_price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `badge` varchar(50) DEFAULT NULL,
  `rating_count` int NOT NULL DEFAULT '0',
  `rating_avg` decimal(3,2) NOT NULL DEFAULT '0.00',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_recommended` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `age_group` varchar(30) DEFAULT NULL,
  `colors` varchar(255) DEFAULT NULL,
  `sizes` varchar(255) DEFAULT NULL,
  `material` varchar(150) DEFAULT NULL,
  `hover_image` varchar(255) DEFAULT NULL,
  `sold_count` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
SQL);

        $now  = date('Y-m-d H:i:s');
        $tops = [
            ['Boys Clothing', 'boys-clothing', 1, 'assets/frontend/images/product-img/fashion/hoodie-b-01.webp'],
            ['Girls Clothing', 'girls-clothing', 2, 'assets/frontend/images/product-img/fashion/fashion-a-red-01.webp'],
            ['Baby Wear', 'baby-wear', 3, 'assets/frontend/images/product-img/fashion/hoodie-b-02.webp'],
            ['Seasonal Collection', 'seasonal-collection', 5, 'assets/frontend/images/product-img/fashion/hoodie-b-03.webp'],
        ];
        foreach ($tops as [$name, $slug, $order, $image]) {
            if ($this->db->table('categories')->where('slug', $slug)->countAllResults() === 0) {
                $this->db->table('categories')->insert([
                    'name' => $name, 'slug' => $slug, 'sort_order' => $order, 'image' => $image, 'link_url' => '/shop/' . $slug,
                    'show_on_home' => 1, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now,
                ]);
            }
        }
    }

    public function down()
    {
        // Intentionally left empty: never drop catalogue data.
    }
}
