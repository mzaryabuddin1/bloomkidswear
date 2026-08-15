<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Account extends BaseController
{
    public function login()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return $this->json(false, implode(' ', $this->validator->getErrors()), 422);
        }

        $customer = (new CustomerModel())
            ->where('email', (string) $this->request->getPost('email'))
            ->where('type', 'registered')
            ->first();

        $password = (string) $this->request->getPost('password');

        if (! $customer || empty($customer['password']) || ! password_verify($password, $customer['password'])) {
            return $this->json(false, 'Invalid email or password.', 401);
        }

        if (($customer['status'] ?? 'active') !== 'active') {
            return $this->json(false, 'This account is inactive.', 403);
        }

        session()->regenerate();
        session()->set([
            'customer_id'    => $customer['id'],
            'customer_name'  => $customer['name'],
            'customer_email' => $customer['email'],
        ]);

        return $this->json(true, 'Logged in.', 200, site_url('/'));
    }

    public function signup()
    {
        $rules = [
            'name'     => 'required|min_length[2]',
            'email'    => 'required|valid_email|is_unique[customers.email]',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return $this->json(false, implode(' ', $this->validator->getErrors()), 422);
        }

        $model = new CustomerModel();
        $model->insert([
            'name'     => (string) $this->request->getPost('name'),
            'email'    => (string) $this->request->getPost('email'),
            'phone'    => (string) $this->request->getPost('phone'),
            'password' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'type'     => 'registered',
            'status'   => 'active',
        ]);

        $id = (int) $model->getInsertID();
        session()->regenerate();
        session()->set([
            'customer_id'    => $id,
            'customer_name'  => (string) $this->request->getPost('name'),
            'customer_email' => (string) $this->request->getPost('email'),
        ]);

        return $this->json(true, 'Account created.', 200, site_url('/'));
    }

    public function logout()
    {
        session()->remove(['customer_id', 'customer_name', 'customer_email']);

        return redirect()->to(site_url('/'));
    }

    private function json(bool $success, string $message, int $status, ?string $redirect = null)
    {
        return $this->response->setStatusCode($status)->setJSON([
            'success'   => $success,
            'message'   => $message,
            'redirect'  => $redirect,
            'csrfToken' => csrf_token(),
            'csrfHash'  => csrf_hash(),
        ]);
    }
}
