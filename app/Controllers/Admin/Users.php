<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\RoleModel;

class Users extends BaseController
{
    public function index()
    {
        $admins = (new AdminModel())
            ->select('admins.*, roles.name as role_name')
            ->join('roles', 'roles.id = admins.role_id', 'left')
            ->orderBy('admins.id', 'DESC')
            ->findAll();

        return view('admin/users/index', [
            'title'      => 'Admin Users',
            'adminName'  => session()->get('admin_name'),
            'adminEmail' => session()->get('admin_email'),
            'activeNav'  => 'admin-users',
            'admins'     => $admins,
        ]);
    }

    public function create()
    {
        return view('admin/users/form', [
            'title'      => 'Add Admin User',
            'adminName'  => session()->get('admin_name'),
            'adminEmail' => session()->get('admin_email'),
            'activeNav'  => 'add-admin-user',
            'user'       => null,
            'roles'      => $this->assignableRoles(),
            'lockRole'   => false,
        ]);
    }

    public function store()
    {
        return $this->saveUser();
    }

    public function edit(int $id)
    {
        $user = (new AdminModel())->find($id);
        if (! $user) {
            return redirect()->to(site_url('admin/users'))->with('error', 'Admin user not found.');
        }

        if (is_protected_super_admin_user($user) && (int) session()->get('admin_id') !== (int) $user['id']) {
            return redirect()->to(site_url('admin/users'))->with('error', 'The Super Admin account cannot be edited.');
        }

        return view('admin/users/form', [
            'title'      => 'Edit Admin User',
            'adminName'  => session()->get('admin_name'),
            'adminEmail' => session()->get('admin_email'),
            'activeNav'  => 'admin-users',
            'user'       => $user,
            'roles'      => $this->assignableRoles($user),
            'lockRole'   => is_protected_super_admin_user($user),
        ]);
    }

    public function update(int $id)
    {
        return $this->saveUser($id);
    }

    public function delete(int $id)
    {
        $user = (new AdminModel())->find($id);
        if (is_protected_super_admin_user($user)) {
            return redirect()->to(site_url('admin/users'))->with('error', 'The Super Admin account cannot be deleted.');
        }
        if ((int) session()->get('admin_id') === $id) {
            return redirect()->to(site_url('admin/users'))->with('error', 'You cannot delete your own account.');
        }

        (new AdminModel())->delete($id);

        return redirect()->to(site_url('admin/users'))->with('success', 'Admin user deleted.');
    }

    private function saveUser(?int $id = null)
    {
        $rules = [
            'name'    => 'required|min_length[2]',
            'email'   => 'required|valid_email',
            'role_id' => 'required|is_natural_no_zero',
        ];

        if (! $id) {
            $rules['password'] = 'required|min_length[6]';
        } elseif ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $model = new AdminModel();
        $current = $id ? $model->find($id) : null;
        if ($id && is_protected_super_admin_user($current) && (int) session()->get('admin_id') !== (int) $id) {
            return redirect()->to(site_url('admin/users'))->with('error', 'The Super Admin account cannot be edited.');
        }

        $email = (string) $this->request->getPost('email');
        $existing = $model->where('email', $email)->first();
        if ($existing && (int) $existing['id'] !== (int) $id) {
            return redirect()->back()->withInput()->with('error', 'That email is already in use.');
        }
        if ($id && is_protected_super_admin_user($current) && strcasecmp($email, super_admin_owner_email()) !== 0) {
            return redirect()->back()->withInput()->with('error', 'The Super Admin login email cannot be changed.');
        }

        $roleId = (int) $this->request->getPost('role_id');
        $superRole = super_admin_role();
        if ($superRole && $roleId === (int) $superRole['id'] && ! is_protected_super_admin_user($current)) {
            return redirect()->back()->withInput()->with('error', 'Super Admin can only be assigned to the original Super Admin account.');
        }

        $data = [
            'name'    => (string) $this->request->getPost('name'),
            'email'   => $email,
            'phone'   => (string) $this->request->getPost('phone'),
            'role_id' => $roleId,
            'status'  => $this->request->getPost('status') === 'inactive' ? 'inactive' : 'active',
        ];

        if (is_protected_super_admin_user($current) && $superRole) {
            $data['role_id'] = (int) $superRole['id'];
            $data['status']  = 'active';
            $data['email']   = super_admin_owner_email();
        }

        $password = (string) $this->request->getPost('password');
        if ($password !== '') {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(site_url('admin/users'))->with('success', 'Admin user saved.');
    }

    /**
     * @param array<string, mixed>|null $user
     * @return list<array<string, mixed>>
     */
    private function assignableRoles(?array $user = null): array
    {
        $roles = (new RoleModel())->where('status', 'active')->findAll();

        return array_values(array_filter($roles, static function (array $role) use ($user) {
            if (! is_super_admin_role($role)) {
                return true;
            }

            return is_protected_super_admin_user($user);
        }));
    }
}
