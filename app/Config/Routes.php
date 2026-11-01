<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::landing');

// Customer auth (JSON)
$routes->post('account/login', 'Account::login');
$routes->post('account/signup/start', 'Account::signupStart');
$routes->post('account/signup/verify', 'Account::signupVerify');
$routes->post('account/otp/resend', 'Account::otpResend');
$routes->post('account/forgot', 'Account::forgot');
$routes->post('account/reset', 'Account::reset');
$routes->get('account/logout', 'Account::logout');
$routes->get('account/google', 'Account::google');
$routes->get('account/google/callback', 'Account::googleCallback');

// Customer account pages
$routes->group('account', ['filter' => 'customerAuth'], static function ($routes) {
    $routes->get('/', 'Account::index');
    $routes->get('orders', 'Account::orders');
    $routes->post('update/basic', 'Account::updateBasic');
    $routes->post('update/contact', 'Account::updateContact');
    $routes->post('update/address', 'Account::updateAddress');
    $routes->post('update/password', 'Account::updatePassword');
    $routes->post('delete', 'Account::deleteAccount');
});

// Wishlist
$routes->get('wishlist', 'Wishlist::index');
$routes->group('wishlist', ['filter' => 'customerAuth'], static function ($routes) {
    $routes->get('items', 'Wishlist::items');
    $routes->post('toggle', 'Wishlist::toggle');
    $routes->post('remove', 'Wishlist::remove');
    $routes->post('sync', 'Wishlist::sync');
});

// Shop
$routes->get('shop', 'Shop::index');
$routes->get('shop/category/(:segment)', 'Shop::index/$1');

// Cart & checkout
$routes->get('cart', 'Cart::index');
$routes->get('cart/data', 'Cart::data');
$routes->post('cart/add', 'Cart::add');
$routes->post('cart/update', 'Cart::update');
$routes->post('cart/remove', 'Cart::remove');
$routes->get('checkout', 'Checkout::index');
$routes->post('checkout', 'Checkout::place');
$routes->get('checkout/thank-you/(:segment)', 'Checkout::thankYou/$1');

// Order tracking
$routes->get('track-order', 'TrackOrder::index');
$routes->post('track-order', 'TrackOrder::lookup');

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

        $routes->get('products', 'Admin\Products::index', ['filter' => 'permission:products.view']);
        $routes->get('products/create', 'Admin\Products::create', ['filter' => 'permission:products.manage']);
        $routes->post('products', 'Admin\Products::store', ['filter' => 'permission:products.manage']);
        $routes->get('products/(:num)/edit', 'Admin\Products::edit/$1', ['filter' => 'permission:products.manage']);
        $routes->post('products/(:num)', 'Admin\Products::update/$1', ['filter' => 'permission:products.manage']);
        $routes->post('products/(:num)/toggle', 'Admin\Products::toggle/$1', ['filter' => 'permission:products.manage']);
        $routes->post('products/(:num)/delete', 'Admin\Products::delete/$1', ['filter' => 'permission:products.manage']);

        $routes->get('categories', 'Admin\Categories::index', ['filter' => 'permission:categories.view']);
        $routes->get('categories/create', 'Admin\Categories::create', ['filter' => 'permission:categories.manage']);
        $routes->post('categories', 'Admin\Categories::store', ['filter' => 'permission:categories.manage']);
        $routes->get('categories/(:num)/edit', 'Admin\Categories::edit/$1', ['filter' => 'permission:categories.manage']);
        $routes->post('categories/(:num)', 'Admin\Categories::update/$1', ['filter' => 'permission:categories.manage']);
        $routes->post('categories/(:num)/delete', 'Admin\Categories::delete/$1', ['filter' => 'permission:categories.manage']);

        $routes->get('orders', 'Admin\Orders::index', ['filter' => 'permission:orders.view']);
        $routes->get('orders/create', 'Admin\Orders::create', ['filter' => 'permission:orders.manage']);
        $routes->post('orders', 'Admin\Orders::store', ['filter' => 'permission:orders.manage']);
        $routes->get('orders/(:num)', 'Admin\Orders::show/$1', ['filter' => 'permission:orders.view']);
        $routes->get('orders/(:num)/edit', 'Admin\Orders::edit/$1', ['filter' => 'permission:orders.manage']);
        $routes->post('orders/(:num)', 'Admin\Orders::update/$1', ['filter' => 'permission:orders.manage']);
        $routes->post('orders/(:num)/status', 'Admin\Orders::status/$1', ['filter' => 'permission:orders.manage']);
    });
});
