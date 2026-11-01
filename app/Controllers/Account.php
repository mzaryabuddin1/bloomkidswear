<?php

namespace App\Controllers;

use App\Libraries\OtpService;
use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\WishlistModel;

class Account extends BaseController
{
    // ---------------------------------------------------------------
    // Auth (AJAX / JSON)
    // ---------------------------------------------------------------

    public function login()
    {
        if (! $this->validate(['email' => 'required|valid_email', 'password' => 'required'])) {
            return $this->json(false, implode(' ', $this->validator->getErrors()), 422);
        }

        $customer = (new CustomerModel())
            ->where('email', strtolower(trim((string) $this->request->getPost('email'))))
            ->where('type', 'registered')
            ->first();

        $password = (string) $this->request->getPost('password');

        if (! $customer || empty($customer['password']) || ! password_verify($password, $customer['password'])) {
            return $this->json(false, 'Invalid email or password.', 401);
        }

        if (($customer['status'] ?? 'active') !== 'active') {
            return $this->json(false, 'This account is inactive.', 403);
        }

        $this->loginCustomer($customer);

        return $this->json(true, 'Logged in.', 200, ['reload' => true]);
    }

    /** Step 1 of registration: validate, store pending data, email an OTP. */
    public function signupStart()
    {
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name'  => 'permit_empty|max_length[50]',
            'email'      => 'required|valid_email',
            'phone'      => 'permit_empty|max_length[30]',
            'password'   => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return $this->json(false, implode(' ', $this->validator->getErrors()), 422);
        }

        $email    = strtolower(trim((string) $this->request->getPost('email')));
        $existing = (new CustomerModel())->where('email', $email)->first();

        if ($existing && ! empty($existing['password'])) {
            return $this->json(false, 'An account with this email already exists. Please sign in.', 409);
        }

        $payload = [
            'name'     => trim($this->request->getPost('first_name') . ' ' . $this->request->getPost('last_name')),
            'phone'    => trim((string) $this->request->getPost('phone')),
            'password' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'address'  => trim((string) $this->request->getPost('address')),
            'city'     => trim((string) $this->request->getPost('city')),
            'country'  => trim((string) $this->request->getPost('country')),
            'zip_code' => trim((string) $this->request->getPost('zip_code')),
        ];

        $result = (new OtpService())->issue($email, 'signup', $payload);

        return $this->json($result['ok'], $result['message'], $result['ok'] ? 200 : 429, ['step' => 'otp', 'email' => $email]);
    }

    /** Step 2 of registration: verify OTP, create the account, sign in. */
    public function signupVerify()
    {
        if (! $this->validate(['email' => 'required|valid_email', 'code' => 'required|exact_length[6]|numeric'])) {
            return $this->json(false, 'Please enter the 6-digit code.', 422);
        }

        $email  = strtolower(trim((string) $this->request->getPost('email')));
        $result = (new OtpService())->verify($email, 'signup', (string) $this->request->getPost('code'));

        if (! $result['ok']) {
            return $this->json(false, $result['message'], 422);
        }

        $data  = $result['payload'] ?? [];
        $model = new CustomerModel();
        $row   = $model->where('email', $email)->first();

        $values = [
            'name'              => $data['name'] ?? $email,
            'email'             => $email,
            'phone'             => $data['phone'] ?? null,
            'password'          => $data['password'] ?? null,
            'address'           => $data['address'] ?? null,
            'city'              => $data['city'] ?? null,
            'country'           => $data['country'] ?? null,
            'zip_code'          => $data['zip_code'] ?? null,
            'type'              => 'registered',
            'status'            => 'active',
            'signup_method'     => 'email',
            'email_verified_at' => date('Y-m-d H:i:s'),
        ];

        if ($row) {
            $model->update($row['id'], $values);
            $id = (int) $row['id'];
        } else {
            $model->insert($values);
            $id = (int) $model->getInsertID();
        }

        $this->loginCustomer($model->find($id));

        return $this->json(true, 'Welcome to Bloom Kidswear!', 200, ['reload' => true]);
    }

    public function otpResend()
    {
        $purpose = $this->request->getPost('purpose') === 'reset' ? 'reset' : 'signup';
        $email   = strtolower(trim((string) $this->request->getPost('email')));

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->json(false, 'Please enter a valid email.', 422);
        }

        $otp = new OtpService();

        if ($purpose === 'signup') {
            // Re-issue with the payload stored from the first request.
            $pending = (new \App\Models\OtpModel())->where('email', $email)->where('purpose', 'signup')->orderBy('id', 'DESC')->first();
            if (! $pending) {
                return $this->json(false, 'Your sign up session has expired. Please start again.', 422, ['step' => 'signup']);
            }
            $result = $otp->issue($email, 'signup', $pending['payload'] ? json_decode($pending['payload'], true) : null);
        } else {
            $result = $otp->issue($email, 'reset');
        }

        return $this->json($result['ok'], $result['message'], $result['ok'] ? 200 : 429);
    }

    public function forgot()
    {
        if (! $this->validate(['email' => 'required|valid_email'])) {
            return $this->json(false, 'Please enter a valid email.', 422);
        }

        $email    = strtolower(trim((string) $this->request->getPost('email')));
        $customer = (new CustomerModel())->where('email', $email)->where('type', 'registered')->first();

        // Do not reveal whether the account exists.
        if ($customer && ($customer['status'] ?? 'active') === 'active') {
            $result = (new OtpService())->issue($email, 'reset');
            if (! $result['ok']) {
                return $this->json(false, $result['message'], 429);
            }
        }

        return $this->json(true, 'If an account exists for ' . $email . ', we sent a 6-digit code to it.', 200, ['step' => 'reset', 'email' => $email]);
    }

    public function reset()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'code'     => 'required|exact_length[6]|numeric',
            'password' => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return $this->json(false, implode(' ', $this->validator->getErrors()), 422);
        }

        $email  = strtolower(trim((string) $this->request->getPost('email')));
        $result = (new OtpService())->verify($email, 'reset', (string) $this->request->getPost('code'));

        if (! $result['ok']) {
            return $this->json(false, $result['message'], 422);
        }

        $model    = new CustomerModel();
        $customer = $model->where('email', $email)->where('type', 'registered')->first();

        if (! $customer) {
            return $this->json(false, 'Account not found.', 404);
        }

        $model->update($customer['id'], [
            'password'          => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'email_verified_at' => $customer['email_verified_at'] ?: date('Y-m-d H:i:s'),
        ]);

        return $this->json(true, 'Password updated. You can now sign in.', 200, ['step' => 'signin']);
    }

    public function logout()
    {
        session()->remove(['customer_id', 'customer_name', 'customer_email']);

        return redirect()->to(site_url('home'));
    }

    // ---------------------------------------------------------------
    // Google sign-in (OAuth 2.0 authorization code flow)
    // ---------------------------------------------------------------

    public function google()
    {
        $clientId = (string) env('google.clientId');
        if ($clientId === '') {
            return redirect()->to(site_url('home'))->with('auth_error', 'Google sign-in is not configured yet.');
        }

        $state = bin2hex(random_bytes(16));
        session()->set('google_oauth_state', $state);

        $query = http_build_query([
            'client_id'     => $clientId,
            'redirect_uri'  => site_url('account/google/callback'),
            'response_type' => 'code',
            'scope'         => 'openid email profile',
            'state'         => $state,
            'prompt'        => 'select_account',
        ]);

        return redirect()->to('https://accounts.google.com/o/oauth2/v2/auth?' . $query);
    }

    public function googleCallback()
    {
        $fail = static fn (string $msg) => redirect()->to(site_url('home'))->with('auth_error', $msg);

        $state = (string) session()->get('google_oauth_state');
        session()->remove('google_oauth_state');

        if ($this->request->getGet('error') || ! $this->request->getGet('code')) {
            return $fail('Google sign-in was cancelled.');
        }

        if ($state === '' || ! hash_equals($state, (string) $this->request->getGet('state'))) {
            return $fail('Google sign-in could not be verified. Please try again.');
        }

        try {
            $client = service('curlrequest', ['timeout' => 15, 'http_errors' => false]);

            $token = json_decode($client->post('https://oauth2.googleapis.com/token', ['form_params' => [
                'code'          => $this->request->getGet('code'),
                'client_id'     => env('google.clientId'),
                'client_secret' => env('google.clientSecret'),
                'redirect_uri'  => site_url('account/google/callback'),
                'grant_type'    => 'authorization_code',
            ]])->getBody(), true);

            if (empty($token['access_token'])) {
                return $fail('Google sign-in failed. Please try again.');
            }

            $profile = json_decode($client->get('https://openidconnect.googleapis.com/v1/userinfo', [
                'headers' => ['Authorization' => 'Bearer ' . $token['access_token']],
            ])->getBody(), true);
        } catch (\Throwable $e) {
            log_message('error', 'Google login failed: ' . $e->getMessage());

            return $fail('Google sign-in failed. Please try again.');
        }

        if (empty($profile['email']) || empty($profile['email_verified'])) {
            return $fail('Your Google account email is not verified.');
        }

        $email = strtolower($profile['email']);
        $model = new CustomerModel();
        $row   = $model->where('google_id', $profile['sub'])->first() ?: $model->where('email', $email)->first();

        if ($row && ($row['status'] ?? 'active') !== 'active') {
            return $fail('This account is inactive.');
        }

        if ($row) {
            $model->update($row['id'], array_filter([
                'google_id'         => $profile['sub'],
                'avatar'            => $row['avatar'] ?: ($profile['picture'] ?? null),
                'type'              => 'registered',
                'email_verified_at' => $row['email_verified_at'] ?: date('Y-m-d H:i:s'),
            ]));
            $id = (int) $row['id'];
        } else {
            $model->insert([
                'name'              => $profile['name'] ?? $email,
                'email'             => $email,
                'google_id'         => $profile['sub'],
                'avatar'            => $profile['picture'] ?? null,
                'type'              => 'registered',
                'status'            => 'active',
                'signup_method'     => 'google',
                'email_verified_at' => date('Y-m-d H:i:s'),
            ]);
            $id = (int) $model->getInsertID();
        }

        $this->loginCustomer($model->find($id));

        return redirect()->to(site_url('home'));
    }

    // ---------------------------------------------------------------
    // Account pages (login required)
    // ---------------------------------------------------------------

    public function index()
    {
        return view('storefront/account/info', $this->accountData('Account Information') + [
            'orderCount' => (new OrderModel())->where('customer_id', session('customer_id'))->countAllResults(),
        ]);
    }

    public function orders()
    {
        $orders = (new OrderModel())
            ->where('customer_id', session('customer_id'))
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('storefront/account/orders', $this->accountData('My Orders') + [
            'orders'     => $orders,
            'orderCount' => count($orders),
        ]);
    }

    public function updateBasic()
    {
        if (! $this->validate([
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name'  => 'permit_empty|max_length[50]',
            'birth_date' => 'permit_empty|valid_date[Y-m-d]',
        ])) {
            return $this->back(implode(' ', $this->validator->getErrors()), false);
        }

        $name = trim($this->request->getPost('first_name') . ' ' . $this->request->getPost('last_name'));
        (new CustomerModel())->update(session('customer_id'), [
            'name'       => $name,
            'birth_date' => $this->request->getPost('birth_date') ?: null,
        ]);
        session()->set('customer_name', $name);

        return $this->back('Basic information updated.');
    }

    public function updateContact()
    {
        if (! $this->validate(['phone' => 'permit_empty|max_length[30]'])) {
            return $this->back(implode(' ', $this->validator->getErrors()), false);
        }

        (new CustomerModel())->update(session('customer_id'), ['phone' => trim((string) $this->request->getPost('phone'))]);

        return $this->back('Contact information updated.');
    }

    public function updateAddress()
    {
        if (! $this->validate([
            'address'  => 'permit_empty|max_length[500]',
            'city'     => 'permit_empty|max_length[100]',
            'state'    => 'permit_empty|max_length[100]',
            'country'  => 'permit_empty|max_length[100]',
            'zip_code' => 'permit_empty|max_length[20]',
        ])) {
            return $this->back(implode(' ', $this->validator->getErrors()), false);
        }

        (new CustomerModel())->update(session('customer_id'), [
            'address'  => trim((string) $this->request->getPost('address')),
            'city'     => trim((string) $this->request->getPost('city')),
            'state'    => trim((string) $this->request->getPost('state')),
            'country'  => trim((string) $this->request->getPost('country')),
            'zip_code' => trim((string) $this->request->getPost('zip_code')),
        ]);

        return $this->back('Delivery address updated.');
    }

    public function updatePassword()
    {
        if (! $this->validate(['new_password' => 'required|min_length[8]', 'confirm_password' => 'required|matches[new_password]'])) {
            return $this->back(implode(' ', $this->validator->getErrors()), false);
        }

        $model    = new CustomerModel();
        $customer = $model->find(session('customer_id'));

        if (! empty($customer['password']) && ! password_verify((string) $this->request->getPost('current_password'), $customer['password'])) {
            return $this->back('Your current password is not correct.', false);
        }

        $model->update($customer['id'], ['password' => password_hash((string) $this->request->getPost('new_password'), PASSWORD_DEFAULT)]);

        return $this->back('Password updated.');
    }

    public function deleteAccount()
    {
        (new CustomerModel())->update(session('customer_id'), ['status' => 'inactive']);
        session()->remove(['customer_id', 'customer_name', 'customer_email']);

        return redirect()->to(site_url('home'));
    }

    // ---------------------------------------------------------------
    // Helpers
    // ---------------------------------------------------------------

    private function accountData(string $title): array
    {
        $customer = (new CustomerModel())->find(session('customer_id'));
        $parts    = explode(' ', (string) $customer['name'], 2);

        return [
            'pageTitle'     => $title . ' | Bloom Kidswear',
            'customer'      => $customer,
            'firstName'     => $parts[0] ?? '',
            'lastName'      => $parts[1] ?? '',
            'wishlistCount' => (new WishlistModel())->where('customer_id', $customer['id'])->countAllResults(),
        ];
    }

    private function loginCustomer(array $customer): void
    {
        session()->regenerate();
        session()->set([
            'customer_id'    => (int) $customer['id'],
            'customer_name'  => $customer['name'],
            'customer_email' => $customer['email'],
        ]);

        (new CustomerModel())->update($customer['id'], ['last_login_at' => date('Y-m-d H:i:s')]);
    }

    private function back(string $message, bool $ok = true)
    {
        return redirect()->to(site_url('account'))->with($ok ? 'success' : 'error', $message);
    }

    private function json(bool $success, string $message, int $status, array $extra = [])
    {
        return $this->response->setStatusCode($status)->setJSON($extra + [
            'success'   => $success,
            'message'   => $message,
            'csrfToken' => csrf_token(),
            'csrfHash'  => csrf_hash(),
        ]);
    }
}
