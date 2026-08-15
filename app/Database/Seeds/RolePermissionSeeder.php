<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $permissions = [
            ['key' => 'dashboard.view', 'label' => 'View dashboard', 'group_name' => 'Dashboard'],
            ['key' => 'roles.view', 'label' => 'View roles', 'group_name' => 'Roles'],
            ['key' => 'roles.manage', 'label' => 'Create and edit roles', 'group_name' => 'Roles'],
            ['key' => 'admins.view', 'label' => 'View admin users', 'group_name' => 'Admin users'],
            ['key' => 'admins.manage', 'label' => 'Create and edit admin users', 'group_name' => 'Admin users'],
            ['key' => 'customers.view', 'label' => 'View customers', 'group_name' => 'Customers'],
            ['key' => 'customers.manage', 'label' => 'Create and edit customers', 'group_name' => 'Customers'],
        ];

        foreach ($permissions as $permission) {
            $exists = $this->db->table('permissions')->where('key', $permission['key'])->countAllResults();
            if ($exists === 0) {
                $this->db->table('permissions')->insert($permission);
            }
        }

        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'Full access to the admin dashboard.',
                'status' => 'active',
                'is_system' => 1,
            ],
            [
                'name' => 'Store Manager',
                'slug' => 'store-manager',
                'description' => 'Manage customers and store operations.',
                'status' => 'active',
                'is_system' => 0,
            ],
            [
                'name' => 'Support',
                'slug' => 'support',
                'description' => 'View customers and dashboard only.',
                'status' => 'active',
                'is_system' => 0,
            ],
        ];

        foreach ($roles as $role) {
            $exists = $this->db->table('roles')->where('slug', $role['slug'])->countAllResults();
            if ($exists === 0) {
                $this->db->table('roles')->insert($role + ['created_at' => $now, 'updated_at' => $now]);
            }
        }

        $permissionRows = $this->db->table('permissions')->get()->getResultArray();
        $permissionIds = array_column($permissionRows, 'id', 'key');
        $roleRows = $this->db->table('roles')->get()->getResultArray();
        $roleIds = array_column($roleRows, 'id', 'slug');

        $map = [
            'super-admin' => array_keys($permissionIds),
            'store-manager' => ['dashboard.view', 'customers.view', 'customers.manage'],
            'support' => ['dashboard.view', 'customers.view'],
        ];

        foreach ($map as $slug => $keys) {
            $roleId = $roleIds[$slug] ?? null;
            if (! $roleId) {
                continue;
            }
            $this->db->table('role_permissions')->where('role_id', $roleId)->delete();
            foreach ($keys as $key) {
                if (! isset($permissionIds[$key])) {
                    continue;
                }
                $this->db->table('role_permissions')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permissionIds[$key],
                ]);
            }
        }

        $superId = $roleIds['super-admin'] ?? null;
        if ($superId) {
            $this->db->table('roles')->where('id', $superId)->update([
                'name'        => 'Super Admin',
                'description' => 'Full access to the admin dashboard.',
                'status'      => 'active',
                'is_system'   => 1,
                'slug'        => 'super-admin',
                'updated_at'  => $now,
            ]);

            $this->db->table('admins')
                ->where('email', 'admin@bloomkidswear.test')
                ->update(['role_id' => $superId, 'status' => 'active']);

            $this->db->table('admins')
                ->where('role_id', $superId)
                ->where('email !=', 'admin@bloomkidswear.test')
                ->update(['role_id' => $roleIds['store-manager'] ?? null]);
        }
    }
}
