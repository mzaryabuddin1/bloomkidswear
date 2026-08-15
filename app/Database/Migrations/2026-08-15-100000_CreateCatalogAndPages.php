<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCatalogAndPages extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('categories') && ! $this->db->fieldExists('link_url', 'categories')) {
            $this->forge->addColumn('categories', [
                'link_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'image'],
                'show_on_home' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'after' => 'link_url'],
            ]);
        }

        if ($this->db->tableExists('products') && ! $this->db->fieldExists('link_url', 'products')) {
            $this->forge->addColumn('products', [
                'image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'slug'],
                'link_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'description'],
                'is_recommended' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0, 'after' => 'is_featured'],
            ]);
        }

        if ($this->db->tableExists('sliders') && ! $this->db->fieldExists('button_text', 'sliders')) {
            $this->forge->addColumn('sliders', [
                'button_text' => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true, 'after' => 'image'],
            ]);
        }

        if (! $this->db->tableExists('cms_pages')) {
            $this->forge->addField([
                'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'title' => ['type' => 'VARCHAR', 'constraint' => 191],
                'slug' => ['type' => 'VARCHAR', 'constraint' => 160],
                'content' => ['type' => 'TEXT', 'null' => true],
                'status' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'active'],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addUniqueKey('slug');
            $this->forge->createTable('cms_pages');
        }
    }

    public function down()
    {
        $this->forge->dropTable('cms_pages', true);
    }
}
