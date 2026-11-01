<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $customers = new CustomerModel();

        $stats = [
            'total'      => $db->table('customers')->countAllResults(),
            'registered' => $db->table('customers')->where('type', 'registered')->countAllResults(),
            'verified'   => $db->table('customers')->where('email_verified_at IS NOT NULL', null, false)->countAllResults(),
            'google'     => $db->table('customers')->where('signup_method', 'google')->countAllResults(),
            'this_week'  => $db->table('customers')->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')))->countAllResults(),
            'wishlists'  => $db->table('wishlists')->countAllResults(),
            'orders'     => $db->table('orders')->countAllResults(),
        ];

        return view('admin/dashboard', [
            'activeNav'  => 'dashboard',
            'adminName'  => session()->get('admin_name') ?? 'Admin',
            'adminEmail' => session()->get('admin_email') ?? '',
            'stats'      => $stats,
            'recent'     => $customers->orderBy('id', 'DESC')->findAll(8),
        ]);
    }
}
