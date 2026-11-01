<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CartCheckout extends Migration
{
    public function up()
    {
        $existing = array_map(static fn ($f) => $f->name, $this->db->getFieldData('orders'));
        $add      = [
            'name'           => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'phone'          => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'address'        => ['type' => 'TEXT', 'null' => true],
            'city'           => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'province'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'postal_code'    => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'notes'          => ['type' => 'TEXT', 'null' => true],
            'payment_method' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'cod'],
            'payment_status' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'pending'],
            'card_brand'     => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'card_last4'     => ['type' => 'VARCHAR', 'constraint' => 4, 'null' => true],
            'payment_ref'    => ['type' => 'VARCHAR', 'constraint' => 60, 'null' => true],
            'subtotal'       => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'shipping'       => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'items_count'    => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ];
        $add = array_diff_key($add, array_flip($existing));
        if ($add) {
            $this->forge->addColumn('orders', $add);
        }

        if (! $this->db->tableExists('order_items')) {
            $this->forge->addField([
                'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'order_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'product_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
                'name'       => ['type' => 'VARCHAR', 'constraint' => 191],
                'sku'        => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
                'image'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'size'       => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
                'color'      => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
                'unit_price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
                'qty'        => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
                'line_total' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addKey('order_id');
            $this->forge->createTable('order_items');
        }
    }

    public function down()
    {
        $this->forge->dropTable('order_items', true);
        $this->forge->dropColumn('orders', ['name', 'phone', 'address', 'city', 'province', 'postal_code', 'notes', 'payment_method', 'payment_status', 'card_brand', 'card_last4', 'payment_ref', 'subtotal', 'shipping', 'items_count']);
    }
}
