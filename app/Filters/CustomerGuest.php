<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CustomerGuest implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('customer_id')) {
            return redirect()->to(site_url('/'));
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
