<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('admin/dashboard', [
            'activeNav'  => 'dashboard',
            'adminName'  => session()->get('admin_name') ?? 'Admin',
            'adminEmail' => session()->get('admin_email') ?? '',
        ]);
    }
}
