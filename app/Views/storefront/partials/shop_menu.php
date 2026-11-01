<?php
// Shop dropdown (Elements-style mega menu), built from the categories table.
static $menuTree = null;
$menuTree ??= (new \App\Models\CategoryModel())->tree();

$bySlug = [];
foreach ($menuTree as $parent) {
    $bySlug[$parent['slug']] = $parent;
}
$catUrl = static fn (string $slug) => site_url('shop?category=' . urlencode($slug));

$column = static function (string $slug) use ($bySlug, $catUrl): string {
    if (! isset($bySlug[$slug])) {
        return '';
    }
    $p  = $bySlug[$slug];
    $li = '<li><a href="' . $catUrl($p['slug']) . '">All ' . esc($p['name']) . '</a></li>';
    foreach ($p['children'] as $child) {
        $li .= '<li><a href="' . $catUrl($child['slug']) . '">' . esc($child['name']) . '</a></li>';
    }

    return '<p class="rbt-short-title h5">' . esc($p['name']) . '</p><ul class="mega-menu-item">' . $li . '</ul>';
};
?>
        <li class="with-rbt-megamenu has-menu-child-item position-static">
            <a href="<?= site_url('shop') ?>">Shop <i class="fa-regular fa-chevron-down"></i></a>
            <div class="rbt-megamenu container pl_sm--0 pl_md--0 pl_lg--0">
                <div class="rbt-megamenu-wrapper">
                    <div class="row row--12 d-flex justify-content-between">
                        <div class="col-xl-9">
                            <div class="row row--12">
                                <div class="col-xl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                                    <p class="rbt-short-title h5">Shop</p>
                                    <ul class="mega-menu-item">
                                        <li><a href="<?= site_url('shop') ?>"><strong>Shop</strong></a></li>
                                        <li><a href="<?= site_url('shop?flag=new') ?>">New Arrivals</a></li>
                                        <li><a href="<?= site_url('shop?flag=bestseller') ?>">Best Sellers</a></li>
                                        <li><a href="<?= site_url('shop?flag=sale') ?>">On Sale</a></li>
                                        <?php foreach ($bySlug['seasonal-collection']['children'] ?? [] as $child): ?>
                                        <li><a href="<?= $catUrl($child['slug']) ?>"><?= esc($child['name']) ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="col-xl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1"><?= $column('boys-clothing') ?></div>
                                <div class="col-xl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1"><?= $column('girls-clothing') ?></div>
                                <div class="col-xl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1"><?= $column('baby-wear') ?></div>
                            </div>
                        </div>
                        <div class="col-xl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                            <div class="rbt-menu-offer-card rbt-bg-style-box rbt-bg-two">
                                <div class="mega-top-banner">
                                    <div class="rbt-banner-inner flex-column justify-content-center rbt-gap--8 align-items-center text-center">
                                        <div class="rbt-banner-content">
                                            <h2 class="title rbt-text-color-white">New Season Collection</h2>
                                            <p class="b3 desc rbt-text-color-gray-200">Fresh styles for little trendsetters.</p>
                                        </div>
                                        <a class="rbt-btn rbt-btn-sm" href="<?= site_url('shop?flag=new') ?>">Shop New</a>
                                        <a href="<?= site_url('shop?flag=new') ?>" class="product-img position-bottom mt--24"><img src="<?= base_url('assets/frontend/images/gallery/bloom-mannequin.png') ?>" alt="Bloom Kidswear" style="max-height:260px;width:auto"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
