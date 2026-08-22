<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Toggle to false when the full storefront homepage is ready.
     */
    private const COMING_SOON = true;

    public function index(): string
    {
        if (self::COMING_SOON) {
            return view('storefront/coming_soon');
        }

        return view('storefront/home');
    }

    public function landing(): string
    {
        return view('storefront/home');
    }
}
