<?php
$active = $active ?? 'info';
$link = static fn (string $key, string $href, string $icon, string $label, ?int $badge = null) =>
    '<a href="' . $href . '"' . ($active === $key ? ' class="active"' : '') . '><span><i class="fa-regular ' . $icon . ' mr--4"></i>' . $label . '</span>'
    . ($badge ? '<span class="badge bg-primary rounded-pill ms-auto">' . $badge . '</span>' : '') . '</a>';
?>
<aside class="rbt-profile-sidebar sticky-top">
    <div class="rbt-user-profile">
        <figure class="rbt-user-profile-img">
            <?php if (! empty($customer['avatar'])): ?>
                <img src="<?= esc($customer['avatar'], 'attr') ?>" alt="Profile Image" referrerpolicy="no-referrer">
            <?php else: ?>
                <img src="<?= base_url('assets/frontend/images/favicon.png') ?>" alt="Profile Image">
            <?php endif; ?>
        </figure>
        <div class="pl--12">
            <h2 class="h6 mb-1"><?= esc($customer['name']) ?></h2>
            <span class="d-flex align-items-center rbt-gap--4">
                <i class="fa-regular fa-gift text-warning me-2"></i>
                <a href="<?= site_url('account') ?>"><?= (int) ($customer['loyalty_points'] ?? 0) ?> loyalty points</a>
            </span>
        </div>
    </div>
    <hr class="mb--8 mt--20">
    <div class="rbt-sidebar-widgets">
        <div class="rbt-sidebar-single-widget">
            <nav class="rbt-sidebar-nav-list list-group">
                <?= $link('orders', site_url('account/orders'), 'fa-cart-shopping-fast', 'Orders', (int) ($orderCount ?? 0)) ?>
                <?= $link('wishlist', site_url('wishlist'), 'fa-heart', 'Wishlist', (int) ($wishlistCount ?? 0)) ?>
                <?= $link('track', site_url('track-order'), 'fa-location-dot', 'Track order') ?>
            </nav>
        </div>
        <div class="rbt-sidebar-single-widget">
            <h2 class="rbt-title h6">Manage account</h2>
            <nav class="rbt-sidebar-nav-list list-group">
                <?= $link('info', site_url('account'), 'fa-user-vneck', 'Personal info') ?>
            </nav>
        </div>
        <hr>
        <nav class="rbt-sidebar-nav-list list-group">
            <a href="<?= site_url('account/logout') ?>"><span><i class="fa-regular fa-right-from-bracket mr--4"></i>Log out</span></a>
        </nav>
    </div>
</aside>
