<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $model = new CustomerModel();
        $q = trim((string) $this->request->getGet('q'));
        if ($q !== '') {
            $model->groupStart()->like('name', $q)->orLike('email', $q)->orLike('phone', $q)->groupEnd();
        }
        $customers = $model->orderBy('id', 'DESC')->findAll();

        return view('admin/customers/index', [
            'title'      => 'Customers',
            'adminName'  => session()->get('admin_name'),
            'adminEmail' => session()->get('admin_email'),
            'activeNav'  => 'customers',
            'customers'  => $customers,
            'q'          => $q,
        ]);
    }

    public function create()
    {
        return view('admin/customers/form', [
            'title'      => 'Add Customer',
            'adminName'  => session()->get('admin_name'),
            'adminEmail' => session()->get('admin_email'),
            'activeNav'  => 'add-customer',
            'customer'   => null,
        ]);
    }

    public function store()
    {
        return $this->saveCustomer();
    }

    public function edit(int $id)
    {
        $customer = (new CustomerModel())->find($id);
        if (! $customer) {
            return redirect()->to(site_url('admin/customers'))->with('error', 'Customer not found.');
        }

        return view('admin/customers/form', [
            'title'      => 'Edit Customer',
            'adminName'  => session()->get('admin_name'),
            'adminEmail' => session()->get('admin_email'),
            'activeNav'  => 'customers',
            'customer'   => $customer,
        ]);
    }

    public function update(int $id)
    {
        return $this->saveCustomer($id);
    }

    public function delete(int $id)
    {
        (new CustomerModel())->delete($id);

        return redirect()->to(site_url('admin/customers'))->with('success', 'Customer deleted.');
    }

    private function saveCustomer(?int $id = null)
    {
        $rules = [
            'name'  => 'required|min_length[2]',
            'email' => 'required|valid_email',
            'type'  => 'required|in_list[guest,registered]',
        ];

        $type = (string) $this->request->getPost('type');
        if ($type === 'registered' && ! $id) {
            $rules['password'] = 'required|min_length[6]';
        } elseif ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $model = new CustomerModel();
        $email = (string) $this->request->getPost('email');
        $existing = $model->where('email', $email)->first();
        if ($existing && (int) $existing['id'] !== (int) $id) {
            return redirect()->back()->withInput()->with('error', 'That email is already in use.');
        }

        $data = [
            'name'    => (string) $this->request->getPost('name'),
            'email'   => $email,
            'phone'   => (string) $this->request->getPost('phone'),
            'address' => (string) $this->request->getPost('address'),
            'type'    => $type,
            'status'  => $this->request->getPost('status') === 'inactive' ? 'inactive' : 'active',
        ];

        $password = (string) $this->request->getPost('password');
        if ($type === 'guest') {
            $data['password'] = null;
        } elseif ($password !== '') {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to(site_url('admin/customers'))->with('success', 'Customer saved.');
    }
}
