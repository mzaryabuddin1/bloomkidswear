<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->post('account/login', 'Account::login');
$routes->post('account/signup', 'Account::signup');
$routes->get('account/logout', 'Account::logout');

$routes->get('admin', static function () {
    return redirect()->to(site_url('admin/dashboard'));
});

$routes->group('admin', static function ($routes) {
    $routes->get('login', 'Admin\Auth::login', ['filter' => 'adminGuest']);
    $routes->post('login', 'Admin\Auth::attemptLogin', ['filter' => 'adminGuest']);
    $routes->get('logout', 'Admin\Auth::logout', ['filter' => 'adminAuth']);

    $routes->group('', ['filter' => 'adminAuth'], static function ($routes) {
        $routes->get('dashboard', 'Admin\Dashboard::index');

        $routes->get('roles', 'Admin\Roles::index', ['filter' => 'permission:roles.view']);
        $routes->get('roles/create', 'Admin\Roles::create', ['filter' => 'permission:roles.manage']);
        $routes->post('roles', 'Admin\Roles::store', ['filter' => 'permission:roles.manage']);
        $routes->get('roles/(:num)/edit', 'Admin\Roles::edit/$1', ['filter' => 'permission:roles.manage']);
        $routes->post('roles/(:num)', 'Admin\Roles::update/$1', ['filter' => 'permission:roles.manage']);
        $routes->post('roles/(:num)/delete', 'Admin\Roles::delete/$1', ['filter' => 'permission:roles.manage']);

        $routes->get('users', 'Admin\Users::index', ['filter' => 'permission:admins.view']);
        $routes->get('users/create', 'Admin\Users::create', ['filter' => 'permission:admins.manage']);
        $routes->post('users', 'Admin\Users::store', ['filter' => 'permission:admins.manage']);
        $routes->get('users/(:num)/edit', 'Admin\Users::edit/$1', ['filter' => 'permission:admins.manage']);
        $routes->post('users/(:num)', 'Admin\Users::update/$1', ['filter' => 'permission:admins.manage']);
        $routes->post('users/(:num)/delete', 'Admin\Users::delete/$1', ['filter' => 'permission:admins.manage']);

        $routes->get('customers', 'Admin\Customers::index', ['filter' => 'permission:customers.view']);
        $routes->get('customers/create', 'Admin\Customers::create', ['filter' => 'permission:customers.manage']);
        $routes->post('customers', 'Admin\Customers::store', ['filter' => 'permission:customers.manage']);
        $routes->get('customers/(:num)/edit', 'Admin\Customers::edit/$1', ['filter' => 'permission:customers.manage']);
        $routes->post('customers/(:num)', 'Admin\Customers::update/$1', ['filter' => 'permission:customers.manage']);
        $routes->post('customers/(:num)/delete', 'Admin\Customers::delete/$1', ['filter' => 'permission:customers.manage']);
    });
});
