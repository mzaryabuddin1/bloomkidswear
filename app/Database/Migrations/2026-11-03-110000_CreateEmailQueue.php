<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmailQueue extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('email_queue')) {
            return;
        }
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'to_email'   => ['type' => 'VARCHAR', 'constraint' => 191],
            'bcc'        => ['type' => 'VARCHAR', 'constraint' => 191, 'null' => true],
            'subject'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'body'       => ['type' => 'LONGTEXT'],
            'status'     => ['type' => 'VARCHAR', 'constraint' => 10, 'default' => 'pending'],
            'attempts'   => ['type' => 'TINYINT', 'constraint' => 3, 'unsigned' => true, 'default' => 0],
            'last_error' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'sent_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['status', 'id']);
        $this->forge->createTable('email_queue');
    }

    public function down()
    {
        $this->forge->dropTable('email_queue', true);
    }
}
