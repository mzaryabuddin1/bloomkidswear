<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Extends the existing `categories` / `products` tables with the fields the
 * shop page filters on (age group, colours, sizes, rating, sales).
 */
class CreateShopCatalog extends Migration
{
    public function up()
    {
        $this->forge->dropTable('product_categories', true);

        $add = [
            'age_group'   => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'colors'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sizes'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'material'    => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'hover_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sold_count'  => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ];

        foreach ($add as $name => $definition) {
            if (! $this->db->fieldExists($name, 'products')) {
                $this->forge->addColumn('products', [$name => $definition]);
            }
        }
    }

    public function down()
    {
        $this->forge->dropColumn('products', ['age_group', 'colors', 'sizes', 'material', 'hover_image', 'sold_count']);
    }
}
