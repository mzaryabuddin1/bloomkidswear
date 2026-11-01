<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CustomerAuthWishlistOrders extends Migration
{
    public function up()
    {
        $this->forge->addColumn('customers', [
            'google_id'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'password'],
            'avatar'            => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'google_id'],
            'signup_method'     => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'email', 'after' => 'avatar'],
            'email_verified_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'signup_method'],
            'last_login_at'     => ['type' => 'DATETIME', 'null' => true, 'after' => 'email_verified_at'],
            'country'           => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'address'],
            'city'              => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'country'],
            'state'             => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'city'],
            'zip_code'          => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true, 'after' => 'state'],
            'birth_date'        => ['type' => 'DATE', 'null' => true, 'after' => 'zip_code'],
            'loyalty_points'    => ['type' => 'INT', 'constraint' => 11, 'default' => 0, 'after' => 'birth_date'],
        ]);

        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 191],
            'purpose'    => ['type' => 'VARCHAR', 'constraint' => 20],
            'code_hash'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'payload'    => ['type' => 'TEXT', 'null' => true],
            'attempts'   => ['type' => 'TINYINT', 'constraint' => 3, 'default' => 0],
            'expires_at' => ['type' => 'DATETIME'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['email', 'purpose']);
        $this->forge->createTable('otp_codes');

        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'customer_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'item_key'    => ['type' => 'VARCHAR', 'constraint' => 191],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'image'       => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'url'         => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'price'       => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['customer_id', 'item_key']);
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('wishlists');

        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_number' => ['type' => 'VARCHAR', 'constraint' => 30],
            'customer_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'email'        => ['type' => 'VARCHAR', 'constraint' => 191],
            'status'       => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'placed'],
            'total'        => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'tracking_number' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'carrier'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('order_number');
        $this->forge->addKey('email');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders', true);
        $this->forge->dropTable('wishlists', true);
        $this->forge->dropTable('otp_codes', true);
        $this->forge->dropColumn('customers', ['google_id', 'avatar', 'signup_method', 'email_verified_at', 'last_login_at', 'country', 'city', 'state', 'zip_code', 'birth_date', 'loyalty_points']);
    }
}
