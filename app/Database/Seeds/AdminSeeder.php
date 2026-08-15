<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $table = $this->db->table('admins');

        if ($table->where('email', 'admin@bloomkidswear.test')->countAllResults() > 0) {
            return;
        }

        $table->insert([
            'name'       => 'Administrator',
            'email'      => 'admin@bloomkidswear.test',
            'password'   => password_hash('Admin123!', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
