<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminNotifications extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('admin_notifications')) {
            return;
        }
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'type'       => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'order'],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 191],
            'body'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'link'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'order_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'is_read'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['is_read', 'created_at']);
        $this->forge->createTable('admin_notifications');
    }

    public function down()
    {
        $this->forge->dropTable('admin_notifications', true);
    }
}
