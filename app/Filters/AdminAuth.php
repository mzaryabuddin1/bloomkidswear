<?php

namespace App\Filters;

use App\Models\AdminModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $adminId = session()->get('admin_id');

        if (! $adminId) {
            return redirect()->to(site_url('admin/login'));
        }

        $admin = (new AdminModel())->find((int) $adminId);

        if (! $admin || ($admin['status'] ?? 'active') !== 'active') {
            session()->destroy();

            return redirect()->to(site_url('admin/login'));
        }

        $db = db_connect();
        $permissions = [];

        if (! empty($admin['role_id'])) {
            $rows = $db->table('role_permissions rp')
                ->select('permissions.key')
                ->join('permissions', 'permissions.id = rp.permission_id')
                ->where('rp.role_id', $admin['role_id'])
                ->get()
                ->getResultArray();

            $permissions = array_column($rows, 'key');
        }

        $role = $db->table('roles')->where('id', $admin['role_id'] ?? 0)->get()->getRowArray();

        if (($role['slug'] ?? '') === 'super-admin') {
            $permissions = ['*'];
        }

        session()->set([
            'admin_name'        => $admin['name'],
            'admin_email'       => $admin['email'],
            'admin_role_id'     => $admin['role_id'] ?? null,
            'admin_role_name'   => $role['name'] ?? 'Staff',
            'admin_permissions' => $permissions,
        ]);

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
