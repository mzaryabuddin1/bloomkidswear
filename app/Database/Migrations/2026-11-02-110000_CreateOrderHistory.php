<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderHistory extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('order_history')) {
            return;
        }
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'admin_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'admin_name'   => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'action'       => ['type' => 'VARCHAR', 'constraint' => 20],
            'summary'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'changes_json' => ['type' => 'LONGTEXT', 'null' => true],
            'before_json'  => ['type' => 'LONGTEXT', 'null' => true],
            'after_json'   => ['type' => 'LONGTEXT', 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('order_id');
        $this->forge->createTable('order_history');
    }

    public function down()
    {
        $this->forge->dropTable('order_history', true);
    }
}
