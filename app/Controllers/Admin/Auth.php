<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('admin/auth/login');
    }

    public function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return $this->jsonLoginResponse(false, implode(' ', $this->validator->getErrors()), 422);
        }

        $email    = (string) $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');

        $admin = (new AdminModel())->where('email', $email)->first();

        if (! $admin || ! password_verify($password, $admin['password'])) {
            return $this->jsonLoginResponse(false, 'Invalid email or password.', 401);
        }

        if (($admin['status'] ?? 'active') !== 'active') {
            return $this->jsonLoginResponse(false, 'This admin account is inactive.', 403);
        }

        session()->regenerate();
        session()->set([
            'admin_id'    => $admin['id'],
            'admin_name'  => $admin['name'],
            'admin_email' => $admin['email'],
        ]);

        return $this->jsonLoginResponse(true, 'Logged in.', 200, site_url('admin/dashboard'));
    }

    /**
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    private function jsonLoginResponse(bool $success, string $message, int $status, ?string $redirect = null)
    {
        return $this->response->setStatusCode($status)->setJSON([
            'success'   => $success,
            'message'   => $message,
            'redirect'  => $redirect,
            'csrfToken' => csrf_token(),
            'csrfHash'  => csrf_hash(),
        ]);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('admin/login'));
    }
}
