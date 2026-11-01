<?php
$money = static fn ($v) => 'PKR ' . number_format((float) $v);
$img   = static fn ($path) => base_url($path);
$stars = static function (float $rating): string {
    $out = '';
    for ($i = 1; $i <= 5; $i++) {
        $out .= '<li><i class="fa-solid fa-star' . ($i <= round($rating) ? ' rbt-rated-icon' : '') . '"></i></li>';
    }

    return $out;
};
$chk = static fn (bool $on) => $on ? ' checked' : '';
?>
<?= $this->include('storefront/partials/head') ?>
<?= $this->include('storefront/partials/header') ?>

<div id="bloom-shop-top">
<?= view('storefront/partials/breadcrumb', ['crumbs' => $f['category'] ? ['Shop' => site_url('shop'), $title => null] : ['Shop' => null]]) ?>

<!-- Category circles -->
<div class="rbt-component-area rbt-catagories-area pt--32 pt_sm--16 rbt-bg-color-white">
    <div class="container">
        <div class="row row--12 align-items-end rbt-tablet-row rbt-mobile-row justify-content-center">
            <?php foreach ($tree as $i => $parent): ?>
            <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                <a class="rbt-cat-box rbt-cat-box-1 text-center rbt-scroll-trigger fade_in animation-order-<?= $i + 1 ?>" href="<?= esc($url(['category' => $parent['slug']]), 'attr') ?>">
                    <div class="inner">
                        <div class="rbt-image-portion">
                            <img src="<?= !empty($parent['image']) ? $img($parent['image']) : base_url('assets/frontend/images/favicon.png') ?>" alt="<?= esc($parent['name']) ?>">
                        </div>
                        <div class="content"><p class="title"><?= esc($parent['name']) ?></p></div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="rbt-component-area ptb--32 ptb_sm--12 ptb_md--20">
    <div class="container"><div class="rbt-separator rbt-separator-gray200"></div></div>
</div>
</div>

<div class="rbt-component-area rbt-shop-filter-area rbt-bg-color-white rbt-section-gapBottom">
    <div class="container">
        <div class="row row--16 mt_dec--24">

            <!-- Sidebar -->
            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mt--24 collapse d-lg-block" id="bloom-filters">
                <aside class="rbt-sidebar has-rbt-fshape sticky-top">
                    <div class="rbt-sidebar-widget-wrapper rbt-sidebar-bg-one position-relative">
                        <div class="rbt-sidebar-top">
                            <h2 class="rbt-sidebar-title h6"><i class="fa-sharp fa-regular fa-filter-list mr--4"></i> Filter &amp; Refine</h2>
                        </div>
                        <div class="rbt-sidebar-bottom">

                            <!-- Categories -->
                            <div class="rbt-single-widget rbt-widget-categories">
                                <div class="rbt-single-widget-inner">
                                    <h2 class="rbt-widget-title rbt-widget-title-without-border h4">
                                        <a data-bs-toggle="collapse" href="#bloom-w-cat" role="button" aria-expanded="true">Categories <span class="icon"><i class="fa-regular fa-chevron-down"></i></span></a>
                                    </h2>
                                    <div class="collapse show" id="bloom-w-cat">
                                        <ul class="rbt-sidebar-list-wrapper rbt-categories-list-check">
                                            <li class="rbt-check-group">
                                                <input id="cat-all" type="checkbox"<?= $chk(! $f['category']) ?> data-shop-url="<?= esc($url(['category' => null]), 'attr') ?>">
                                                <label for="cat-all">All products <span class="rbt-lable count">(<?= array_sum(array_map(static fn ($p) => $counts['cat'][$p['slug']] ?? 0, $tree)) ?>)</span></label>
                                            </li>
                                            <?php foreach ($tree as $parent): ?>
                                            <li class="rbt-check-group">
                                                <input id="cat-<?= esc($parent['slug']) ?>" type="checkbox"<?= $chk($f['category'] === $parent['slug']) ?> data-shop-url="<?= esc($url(['category' => $parent['slug']]), 'attr') ?>">
                                                <label for="cat-<?= esc($parent['slug']) ?>"><?= esc($parent['name']) ?> <span class="rbt-lable count">(<?= (int) ($counts['cat'][$parent['slug']] ?? 0) ?>)</span></label>
                                            </li>
                                            <?php if ($f['category'] && ($f['category'] === $parent['slug'] || ($cats[$f['category']]['parent_slug'] ?? null) === $parent['slug'])): ?>
                                                <?php foreach ($parent['children'] as $child): ?>
                                                <li class="rbt-check-group" style="padding-left:22px">
                                                    <input id="cat-<?= esc($child['slug']) ?>" type="checkbox"<?= $chk($f['category'] === $child['slug']) ?> data-shop-url="<?= esc($url(['category' => $child['slug']]), 'attr') ?>">
                                                    <label for="cat-<?= esc($child['slug']) ?>"><?= esc($child['name']) ?> <span class="rbt-lable count">(<?= (int) ($counts['cat'][$child['slug']] ?? 0) ?>)</span></label>
                                                </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="rbt-single-widget rbt-widget-categories">
                                <div class="rbt-single-widget-inner">
                                    <h2 class="rbt-widget-title rbt-widget-title-without-border h4">
                                        <a data-bs-toggle="collapse" href="#bloom-w-price" role="button" aria-expanded="true">Filter by price <span class="icon"><i class="fa-regular fa-chevron-down"></i></span></a>
                                    </h2>
                                    <div class="collapse show" id="bloom-w-price">
                                        <ul class="rbt-sidebar-list-wrapper rbt-categories-list-check">
                                            <?php foreach ($priceRanges as $key => [$label]): ?>
                                            <li class="rbt-check-group">
                                                <input id="price-<?= esc($key) ?>" type="checkbox"<?= $chk($f['price'] === $key) ?> data-shop-url="<?= esc($url(['price' => $f['price'] === $key ? null : $key, 'min' => null, 'max' => null]), 'attr') ?>">
                                                <label for="price-<?= esc($key) ?>"><?= esc($label) ?> <span class="rbt-lable count">(<?= (int) ($counts['price'][$key] ?? 0) ?>)</span></label>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <form data-shop-form method="get" action="<?= site_url('shop') ?>" class="rbt-price-input-grp">
                                            <?php foreach (['category' => $f['category'], 'q' => $f['q'], 'age' => $f['age'], 'rating' => $f['rating'], 'flag' => $f['flag']] as $k => $v): if ($v): ?><input type="hidden" name="<?= $k ?>" value="<?= esc($v) ?>"><?php endif; endforeach; ?>
                                            <?php if ($f['colors']): ?><input type="hidden" name="colors" value="<?= esc(implode(',', $f['colors'])) ?>"><?php endif; ?>
                                            <?php if ($f['sizes']): ?><input type="hidden" name="sizes" value="<?= esc(implode(',', $f['sizes'])) ?>"><?php endif; ?>
                                            <input type="number" min="0" name="min" placeholder="PKR Min" value="<?= esc($f['min'] ?? '') ?>">
                                            <input type="number" min="0" name="max" placeholder="PKR Max" value="<?= esc($f['max'] ?? '') ?>">
                                            <button type="submit" class="rbt-btn">Go</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Colour -->
                            <div class="rbt-single-widget rbt-widget-categories">
                                <div class="rbt-single-widget-inner">
                                    <h2 class="rbt-widget-title rbt-widget-title-without-border h4">
                                        <a data-bs-toggle="collapse" href="#bloom-w-color" role="button" aria-expanded="true">Filter by colour <span class="icon"><i class="fa-regular fa-chevron-down"></i></span></a>
                                    </h2>
                                    <div class="collapse show" id="bloom-w-color">
                                        <ul class="rbt-sidebar-list-wrapper rbt-categories-list-color-swatch">
                                            <?php foreach ($colorHex as $name => $hex): if (empty($counts['color'][$name])) continue;
                                                $on = in_array($name, $f['colors'], true);
                                                $next = $on ? array_values(array_diff($f['colors'], [$name])) : array_merge($f['colors'], [$name]); ?>
                                            <li class="rbt-color-swatch-group">
                                                <a href="<?= esc($url(['colors' => $next]), 'attr') ?>" class="rbt-color-swatch-content<?= $on ? ' active' : '' ?>">
                                                    <span class="rbt-color-swatch">
                                                        <span class="rbt-color-swatch-bg" style="background:<?= $hex ?>;<?= $name === 'white' ? 'border:1px solid #d9dee8' : '' ?>"></span>
                                                        <span class="rbt-color-swatch-text"><?= esc(ucfirst($name)) ?></span>
                                                    </span>
                                                </a>
                                                <span class="rbt-color-swatch-count">(<?= (int) $counts['color'][$name] ?>)</span>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Age group -->
                            <div class="rbt-single-widget rbt-widget-categories">
                                <div class="rbt-single-widget-inner">
                                    <h2 class="rbt-widget-title rbt-widget-title-without-border h4">
                                        <a data-bs-toggle="collapse" href="#bloom-w-age" role="button" aria-expanded="true">Age group <span class="icon"><i class="fa-regular fa-chevron-down"></i></span></a>
                                    </h2>
                                    <div class="collapse show" id="bloom-w-age">
                                        <ul class="rbt-sidebar-list-wrapper rbt-categories-list-check">
                                            <?php foreach ($ageLabels as $key => $label): ?>
                                            <li class="rbt-check-group">
                                                <input id="age-<?= $key ?>" type="checkbox"<?= $chk($f['age'] === $key) ?> data-shop-url="<?= esc($url(['age' => $f['age'] === $key ? null : $key]), 'attr') ?>">
                                                <label for="age-<?= $key ?>"><?= esc($label) ?> <span class="rbt-lable count">(<?= (int) ($counts['age'][$key] ?? 0) ?>)</span></label>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Size -->
                            <div class="rbt-single-widget rbt-widget-categories">
                                <div class="rbt-single-widget-inner">
                                    <h2 class="rbt-widget-title rbt-widget-title-without-border h4">
                                        <a data-bs-toggle="collapse" href="#bloom-w-size" role="button" aria-expanded="true">Size <span class="icon"><i class="fa-regular fa-chevron-down"></i></span></a>
                                    </h2>
                                    <div class="collapse show" id="bloom-w-size">
                                        <div class="rbt-tag-list rbt-tag-list-rounded rbt-tag-list-sm pt--8">
                                            <?php foreach ($counts['size'] as $size => $n):
                                                $on = in_array((string) $size, $f['sizes'], true);
                                                $next = $on ? array_values(array_diff($f['sizes'], [(string) $size])) : array_merge($f['sizes'], [(string) $size]); ?>
                                            <a href="<?= esc($url(['sizes' => $next]), 'attr') ?>" style="<?= $on ? 'background:#233b61;color:#fff' : '' ?>"><?= esc($size) ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rating -->
                            <div class="rbt-single-widget rbt-widget-categories">
                                <div class="rbt-single-widget-inner">
                                    <h2 class="rbt-widget-title rbt-widget-title-without-border h4">
                                        <a data-bs-toggle="collapse" href="#bloom-w-rating" role="button" aria-expanded="true">Customer Reviews <span class="icon"><i class="fa-regular fa-chevron-down"></i></span></a>
                                    </h2>
                                    <div class="collapse show" id="bloom-w-rating">
                                        <ul class="rbt-sidebar-list-wrapper rbt-categories-review-list">
                                            <?php foreach ([4, 3, 2] as $r): ?>
                                            <li class="rbt-review-group">
                                                <a href="<?= esc($url(['rating' => $f['rating'] === $r ? null : $r]), 'attr') ?>" class="rbt-card-rating d-flex"<?= $f['rating'] === $r ? ' style="font-weight:700"' : '' ?>>
                                                    <ul class="rbt-rating-icon-list">
                                                        <?php for ($i = 1; $i <= 5; $i++): ?><li><i class="fa-solid fa-star<?= $i <= $r ? ' rbt-rated-icon' : '' ?>"></i></li><?php endfor; ?>
                                                    </ul>
                                                    <p class="rbt-rating-text">&amp; Up</p>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </aside>
            </div>

            <!-- Products -->
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12 mt--24" id="bloom-results">
                <div class="rbt-shop-tools-wrapper">
                    <div class="rbt-shop-tool-content rbt-shop-filter-tag-wrapper w-100">
                        <p class="rbt-shop-tools-title h6">Fast Filter :</p>
                        <div class="rbt-shop-filter-tag-list rbt-tag-list rbt-tag-list-rounded rbt-tag-list-var-one">
                            <?php foreach ($flags as $key => [$label, $icon]): ?>
                            <a href="<?= esc($url(['flag' => $f['flag'] === $key ? null : $key]), 'attr') ?>"<?= $f['flag'] === $key ? ' style="background:#233b61;color:#fff"' : '' ?>><i class="fa-regular <?= $icon ?>"></i> <?= esc($label) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="rbt-shop-tools-wrapper rbt-shop-tools-wrapper-var-one mt--20 mt_sm--12">
                    <div class="rbt-shop-tool-content rbt-shop-view-var-wrapper sm_w-100 md_w-100">
                        <p class="rbt-shop-tools-title h6">Showing <?= $from ?>–<?= $to ?> of <?= $total ?> result<?= $total === 1 ? '' : 's' ?></p>
                    </div>
                    <div class="rbt-shop-tool-content rbt-shop-view-sort-wrapper">
                        <div class="rbt-tools-select-single">
                            <p class="rbt-shop-tools-title h6">Sort :</p>
                            <select class="form-select" aria-label="Sort products" data-shop-select style="min-width:200px;height:42px;padding:0 38px 0 16px;font-size:14px;line-height:40px;border-radius:8px">
                                <?php foreach ($sorts as $key => $label): ?>
                                <option value="<?= esc($url(['sort' => $key === 'latest' ? null : $key]), 'attr') ?>"<?= $f['sort'] === $key ? ' selected' : '' ?>><?= esc($label) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="rbt-shop-tool-content rbt-shop-view-var-wrapper d-none d-lg-flex">
                        <form data-shop-form method="get" action="<?= site_url('shop') ?>" class="rbt-inner-search-field style-one rbt-search-field-rounded">
                            <?php if ($f['category']): ?><input type="hidden" name="category" value="<?= esc($f['category']) ?>"><?php endif; ?>
                            <input type="text" name="q" value="<?= esc($f['q']) ?>" placeholder="Search for products">
                            <button class="rbt-round-btn search-btn" type="submit" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>

                <div class="rbt-shop-tool-content rbt-shop-view-var-wrapper justify-content-between d-lg-none mt--16 mt_sm--12">
                    <p class="rbt-shop-tools-title h6 rbt-text-color-heading">
                        <a href="#bloom-filters" data-bs-toggle="collapse" class="rbt-filter-button"><i class="fa-sharp fa-regular fa-filter mr--4"></i> <span class="filter-text">Show Filter</span></a>
                    </p>
                </div>

                <?php if ($chips): ?>
                <div class="rbt-shop-tools-wrapper mt--20">
                    <div class="rbt-shop-tool-content rbt-shop-filter-tag-wrapper">
                        <div class="rbt-shop-filter-tag-list rbt-tag-list rbt-tag-list-sm rbt-tag-list-bg-var-one rbt-tag-list-rounded rbt-tag-cancel-var">
                            <?php foreach ($chips as [$label, $href]): ?>
                            <a href="<?= esc($href, 'attr') ?>"><i class="fa-solid fa-xmark"></i> <?= esc($label) ?></a>
                            <?php endforeach; ?>
                            <a href="<?= site_url('shop') ?>" class="text-decoration-underline">Clear All</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (! $products): ?>
                <style>
                    @keyframes bloomSuggestIn { from { opacity: 0; transform: translateY(18px) scale(.92); } to { opacity: 1; transform: none; } }
                    @keyframes bloomSuggestBounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }
                    @keyframes bloomSuggestGlow { 0%, 100% { box-shadow: 0 0 0 0 rgba(35,59,97,.45); } 50% { box-shadow: 0 0 0 10px rgba(35,59,97,0); } }
                    #bloom-results .bloom-suggest { opacity: 0; animation: bloomSuggestIn .6s cubic-bezier(.2,.8,.3,1.2) forwards; transition: transform .25s ease, box-shadow .25s ease, background-color .25s ease, color .25s ease !important; }
                    #bloom-results .bloom-suggest:nth-child(2) { animation-delay: .12s; }
                    #bloom-results .bloom-suggest:nth-child(3) { animation-delay: .24s; }
                    #bloom-results .bloom-suggest:nth-child(4) { animation-delay: .36s; }
                    #bloom-results .bloom-suggest:first-child { animation: bloomSuggestIn .6s cubic-bezier(.2,.8,.3,1.2) forwards, bloomSuggestBounce 1.6s ease-in-out .8s infinite, bloomSuggestGlow 1.6s ease-in-out .8s infinite; }
                    #bloom-results .bloom-suggest:hover { animation-play-state: paused; transform: translateY(-4px) scale(1.04); box-shadow: 0 10px 22px rgba(35,59,97,.25); }
                    #bloom-results .bloom-suggest:active { transform: scale(.97); }
                </style>
                <div class="text-center ptb--40">
                    <i class="fa-regular fa-face-smile-wink" style="font-size:48px;color:#a8b6cb"></i>
                    <h3 class="h5 mt--16">We couldn’t find an exact match</h3>
                    <p class="b2">Nothing fits all of your filters together, but these similar options have items:</p>
                    <?php if ($suggestions): ?>
                    <div class="d-flex flex-wrap justify-content-center mt--16" style="gap:10px">
                        <?php foreach (array_slice($suggestions, 0, 4) as $i => [$label, $href, $n]): ?>
                        <a href="<?= esc($href, 'attr') ?>" class="bloom-suggest rbt-btn rbt-btn-sm<?= $i ? ' rbt-btn-border' : '' ?>">Remove “<?= esc($label) ?>” · <?= (int) $n ?> item<?= $n === 1 ? '' : 's' ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <div class="d-flex flex-wrap justify-content-center mt--16" style="gap:10px">
                        <?php foreach ($tree as $i => $parent): ?>
                        <a href="<?= esc($url(['category' => $parent['slug'], 'q' => null, 'colors' => [], 'sizes' => [], 'age' => null, 'price' => null, 'min' => null, 'max' => null, 'rating' => null, 'flag' => null]), 'attr') ?>" class="bloom-suggest rbt-btn rbt-btn-sm<?= $i ? ' rbt-btn-border' : '' ?>"><?= esc($parent['name']) ?> · <?= (int) ($counts['cat'][$parent['slug']] ?? 0) ?> items</a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <p class="mt--24"><a href="<?= site_url('shop') ?>" class="text-decoration-underline">or browse all products</a></p>
                </div>
                <?php else: ?>
                <div class="row row--12 mt_sm--8 mt_md--8">
                    <?php foreach ($products as $i => $p):
                        $onSale = $p['sale_price'] !== null && (float) $p['sale_price'] < (float) $p['price'];
                        $badges = array_filter([$p['badge'], $onSale ? '-' . round((1 - $p['sale_price'] / $p['price']) * 100) . '%' : null]);
                        ?>
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6 mt--24">
                        <div class="rbt-card rbt-product-card has-hover-box-shadow">
                            <div class="inner rbt-scroll-trigger fade_in animation-order-<?= ($i % 3) + 1 ?>">
                                <div class="rbt-card-img rbt-has-hover-img rbt-bg-color-default">
                                    <a href="<?= site_url('product/' . $p['slug']) ?>">
                                        <img class="rbt-prd-img" src="<?= $img($p['image']) ?>" alt="<?= esc($p['name']) ?>" loading="lazy">
                                        <img class="rbt-hover-img" src="<?= $img($p['hover_image'] ?: $p['image']) ?>" alt="<?= esc($p['name']) ?>" loading="lazy">
                                    </a>
                                    <?php if ($badges): ?>
                                    <div class="rbt-badge-wrapper rbt-content-top-left">
                                        <?php foreach ($badges as $j => $badge): ?>
                                        <div class="rbt-product-badge <?= $j === 0 && $p['badge'] ? 'rbt-product-badge-bg-secondary-gradient' : 'rbt-product-badge-bg-danger' ?> border-rounded"><?= esc($badge) ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="rbt-quick-btn-grp has-mixup-midlayer bottom-right--position">
                                        <button class="rbt-wishlisted-btn rbt-quick-btn tooltips" type="button" data-tooltip="Add to wishlist" data-tooltip-position="left"><i class="fa-regular fa-heart"></i></button>
                                    </div>
                                </div>
                                <div class="rbt-card-body">
                                    <a href="<?= esc($url(['category' => $p['category_slug']]), 'attr') ?>" class="rbt-card-subtitle rbt-card-catagories-text"><?= esc($p['category_name']) ?></a>
                                    <h2 class="rbt-card-title"><a href="<?= site_url('product/' . $p['slug']) ?>"><?= esc($p['name']) ?></a></h2>
                                    <div class="rbt-card-rating">
                                        <ul class="rbt-rating-icon-list"><?= $stars((float) $p['rating_avg']) ?></ul>
                                        <p class="rating-digit">(<?= (int) $p['rating_count'] ?>)</p>
                                    </div>
                                    <div class="pricing-part">
                                        <span class="price-text"><?= $money($onSale ? $p['sale_price'] : $p['price']) ?></span>
                                        <?php if ($onSale): ?><del class="rbt-dis-price-text"><?= $money($p['price']) ?></del><?php endif; ?>
                                        <?php if ((int) $p['stock'] > 0): ?>
                                        <div class="rbt-badge rbt-badge-bg-green rbt-badge-border rbt-badge-small rbt-badge-rounded"><?= (int) $p['stock'] ?> in Stock</div>
                                        <?php else: ?>
                                        <div class="rbt-badge rbt-badge-border rbt-badge-small rbt-badge-rounded">Out of stock</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="prd-btn-grp">
                                        <?php $sizeList = array_filter(explode(',', (string) $p['sizes']), 'strlen'); ?>
                                        <?php if ($sizeList): ?>
                                        <div class="bloom-size-pills mb--8" role="group" aria-label="Select sizes">
                                            <?php foreach ($sizeList as $sz): ?>
                                            <button type="button" class="bloom-pill" data-card-size="<?= esc($sz, 'attr') ?>" aria-pressed="false"><?= esc($sz) ?></button>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                        <?php if ((int) $p['stock'] > 0): ?>
                                        <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block has-left-icon" href="#" data-add-to-cart="<?= (int) $p['id'] ?>"><i class="fa-regular fa-cart-shopping"></i> Add To Cart</a>
                                        <?php else: ?>
                                        <span class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block disabled" style="opacity:.5;pointer-events:none">Out of stock</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($pages > 1): ?>
                <div class="row mt--40 mt_sm--16">
                    <div class="col-12">
                        <nav class="rbt-nav-effect-activation text-center">
                            <ul class="rbt-pagination d-inline-flex">
                                <?php if ($page > 1): ?><li><a href="<?= esc($url(['page' => $page - 1 > 1 ? $page - 1 : null]), 'attr') ?>" aria-label="Previous"><i class="fa-regular fa-chevron-left"></i></a></li><?php endif; ?>
                                <?php for ($n = 1; $n <= $pages; $n++): ?>
                                <li><a href="<?= esc($url(['page' => $n > 1 ? $n : null]), 'attr') ?>"<?= $n === $page ? ' class="active"' : '' ?>><?= $n ?></a></li>
                                <?php endfor; ?>
                                <?php if ($page < $pages): ?><li><a href="<?= esc($url(['page' => $page + 1]), 'attr') ?>" aria-label="Next"><i class="fa-regular fa-chevron-right"></i></a></li><?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->include('storefront/partials/footer') ?>
<?= $this->include('storefront/partials/auth_modal') ?>
<?= $this->include('storefront/partials/scripts') ?>
