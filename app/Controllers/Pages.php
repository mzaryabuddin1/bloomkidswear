<?php

namespace App\Controllers;

/** Static content pages (About, FAQ's and the policy pages in the "More" menu). */
class Pages extends BaseController
{
    private const PAGES = [
        'about-us'                 => ['About Us', 'about'],
        'faqs'                     => ['FAQ\'s', 'faqs'],
        'terms-and-conditions'     => ['Terms and Conditions', 'terms'],
        'privacy-policy'           => ['Privacy Policy', 'privacy'],
        'delivery-policy'          => ['Delivery Policy', 'delivery'],
        'refund-and-return-policy' => ['Refund and Return Policy', 'refund'],
        'exchange-policy'          => ['Exchange Policy', 'exchange'],
    ];

    public function show(string $slug): string
    {
        if (! isset(self::PAGES[$slug])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        [$title, $body] = self::PAGES[$slug];

        return view('storefront/page', [
            'pageTitle' => $title . ' | Bloom Kidswear',
            'title'     => $title,
            'body'      => 'storefront/pages/' . $body,
        ]);
    }
}
