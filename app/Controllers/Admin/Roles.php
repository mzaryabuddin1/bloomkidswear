<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PermissionModel;
use App\Models\RoleModel;

class Roles extends BaseController
{
    public function index()
    {
        $roles = (new RoleModel())->orderBy('id', 'ASC')->findAll();
        $db = db_connect();

        foreach ($roles as &$role) {
            $role['user_count'] = $db->table('admins')->where('role_id', $role['id'])->countAllResults();
            $role['permission_count'] = $db->table('role_permissions')->where('role_id', $role['id'])->countAllResults();
        }

        return view('admin/roles/index', [
            'title'      => 'Roles',
            'adminName'  => session()->get('admin_name'),
            'adminEmail' => session()->get('admin_email'),
            'activeNav'  => 'roles',
            'roles'      => $roles,
        ]);
    }

    public function create()
    {
        return view('admin/roles/form', [
            'title'       => 'Create Role',
            'adminName'   => session()->get('admin_name'),
            'adminEmail'  => session()->get('admin_email'),
            'activeNav'   => 'create-role',
            'role'        => null,
            'permissions' => (new PermissionModel())->orderBy('group_name', 'ASC')->findAll(),
            'assigned'    => [],
        ]);
    }

    public function store()
    {
        return $this->saveRole();
    }

    public function edit(int $id)
    {
        $role = (new RoleModel())->find($id);
        if (! $role) {
            return redirect()->to(site_url('admin/roles'))->with('error', 'Role not found.');
        }
        if (is_super_admin_role($role)) {
            return redirect()->to(site_url('admin/roles'))->with('error', 'Super Admin is locked. Its privileges cannot be changed.');
        }

        $assigned = db_connect()->table('role_permissions')->where('role_id', $id)->get()->getResultArray();

        return view('admin/roles/form', [
            'title'       => 'Edit Role',
            'adminName'   => session()->get('admin_name'),
            'adminEmail'  => session()->get('admin_email'),
            'activeNav'   => 'roles',
            'role'        => $role,
            'permissions' => (new PermissionModel())->orderBy('group_name', 'ASC')->findAll(),
            'assigned'    => array_column($assigned, 'permission_id'),
        ]);
    }

    public function update(int $id)
    {
        return $this->saveRole($id);
    }

    public function delete(int $id)
    {
        $role = (new RoleModel())->find($id);
        if (! $role) {
            return redirect()->to(site_url('admin/roles'))->with('error', 'Role not found.');
        }
        if (! empty($role['is_system']) || is_super_admin_role($role)) {
            return redirect()->to(site_url('admin/roles'))->with('error', 'System roles cannot be deleted.');
        }

        (new RoleModel())->delete($id);

        return redirect()->to(site_url('admin/roles'))->with('success', 'Role deleted.');
    }

    private function saveRole(?int $id = null)
    {
        $name = trim((string) $this->request->getPost('name'));
        if ($name === '') {
            return redirect()->back()->withInput()->with('error', 'Role name is required.');
        }

        $model = new RoleModel();
        $slug = url_title($name, '-', true);
        if ($slug === super_admin_role_slug()) {
            return redirect()->back()->withInput()->with('error', 'That role name is reserved.');
        }

        $data = [
            'name'        => $name,
            'description' => (string) $this->request->getPost('description'),
            'status'      => $this->request->getPost('status') === 'draft' ? 'draft' : 'active',
        ];

        if ($id) {
            $existing = $model->find($id);
            if (! $existing) {
                return redirect()->to(site_url('admin/roles'))->with('error', 'Role not found.');
            }
            if (is_super_admin_role($existing)) {
                return redirect()->to(site_url('admin/roles'))->with('error', 'Super Admin is locked. Its privileges cannot be changed.');
            }
            if (empty($existing['is_system'])) {
                $data['slug'] = $slug;
            }
            $model->update($id, $data);
            $roleId = $id;
        } else {
            $data['slug'] = $slug;
            $data['is_system'] = 0;
            $model->insert($data);
            $roleId = (int) $model->getInsertID();
        }

        $permissionIds = (array) $this->request->getPost('permissions');
        $db = db_connect();
        $db->table('role_permissions')->where('role_id', $roleId)->delete();
        foreach ($permissionIds as $permissionId) {
            $db->table('role_permissions')->insert([
                'role_id'       => $roleId,
                'permission_id' => (int) $permissionId,
            ]);
        }

        return redirect()->to(site_url('admin/roles'))->with('success', 'Role saved.');
    }
}
