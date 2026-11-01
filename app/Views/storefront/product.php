<?php
use App\Libraries\Cart as CartLib;

$m      = static fn ($v) => CartLib::money($v);
$img    = static fn ($path) => base_url($path);
$onSale = $p['sale_price'] !== null && (float) $p['sale_price'] < (float) $p['price'];
$pct    = $onSale ? (int) round((1 - $p['sale_price'] / $p['price']) * 100) : 0;
$sizes  = array_values(array_filter(explode(',', (string) $p['sizes']), 'strlen'));
$stock  = (int) $p['stock'];
$maxQty = max(1, min(CartLib::MAX_QTY, $stock));
$gallery = array_values(array_unique(array_filter([$p['image'], $p['hover_image']])));
$stars = static function (float $rating): string {
    $out = '';
    for ($i = 1; $i <= 5; $i++) {
        $out .= '<li><i class="fa-solid fa-star' . ($i <= round($rating) ? ' rbt-rated-icon' : '') . '"></i></li>';
    }

    return $out;
};
?>
<?= $this->include('storefront/partials/head') ?>
<?= $this->include('storefront/partials/header') ?>
<?= view('storefront/partials/breadcrumb', ['crumbs' => array_filter(['Shop' => site_url('shop'), $p['category_name'] => $p['category_slug'] ? site_url('shop?category=' . $p['category_slug']) : null, $p['name'] => null])]) ?>

<div class="rbt-component-area rbt-single-product-area rbt-bg-color-white rbt-section-gapBottom pt--32" data-product-scope>
    <div class="container rbt-single-product">
        <div class="row row--20 justify-content-center">

            <!-- Gallery -->
            <div class="col-xl-6 col-lg-6 col-12 mt--16">
                <div class="rbt-single-product-media-area">
                    <div class="position-relative rbt-bg-color-default" style="border-radius:12px;overflow:hidden">
                        <?php if ($p['badge'] || $onSale): ?>
                        <div class="rbt-badge-wrapper rbt-content-top-left" style="position:absolute;top:14px;left:14px;z-index:2">
                            <?php if ($p['badge']): ?><div class="rbt-product-badge rbt-product-badge-bg-secondary-gradient border-rounded"><?= esc($p['badge']) ?></div><?php endif; ?>
                            <?php if ($onSale): ?><div class="rbt-product-badge rbt-product-badge-bg-danger border-rounded">-<?= $pct ?>%</div><?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <a href="<?= $img($gallery[0]) ?>" data-fancybox="product-single-image" id="bloom-main-link">
                            <img id="bloom-main-img" class="w-100 rbt-prd-img" src="<?= $img($gallery[0]) ?>" alt="<?= esc($p['name']) ?>">
                        </a>
                    </div>
                    <?php if (count($gallery) > 1): ?>
                    <div class="d-flex mt--12" style="gap:10px">
                        <?php foreach ($gallery as $i => $g): ?>
                        <button type="button" class="bloom-thumb p-0" data-src="<?= $img($g) ?>" aria-label="Photo <?= $i + 1 ?>" style="width:84px;border:2px solid <?= $i ? 'transparent' : '#233b61' ?>;border-radius:8px;overflow:hidden;background:#fff">
                            <img class="w-100" src="<?= $img($g) ?>" alt="">
                        </button>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Details -->
            <div class="col-xl-6 col-lg-6 col-12 mt--16">
                <div class="rbt-single-product-content ptb--0">
                    <?php if ($p['category_name']): ?>
                    <a href="<?= site_url('shop?category=' . $p['category_slug']) ?>" class="rbt-card-subtitle rbt-card-catagories-text"><?= esc($p['category_name']) ?></a>
                    <?php endif; ?>
                    <h2 class="rbt-card-title mt--12"><a href="<?= site_url('product/' . $p['slug']) ?>" style="color:inherit"><?= esc($p['name']) ?></a></h2>

                    <div class="rbt-info-wrapper d-flex mt--16">
                        <div class="rbt-card-rating mt--0">
                            <ul class="rbt-rating-icon-list"><?= $stars((float) $p['rating_avg']) ?></ul>
                            <p class="rating-digit">(<?= (int) $p['rating_count'] ?>)</p>
                            <?php if ((int) $p['sold_count'] > 0): ?>
                            <div class="prd-info-section has-left-separator"><div class="rbt-text-group"><span class="icon mr--4"><i class="fa-solid fa-bag-shopping"></i></span><?= (int) $p['sold_count'] ?>+ sold</div></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="rbt-info-wrapper d-flex justify-content-between mt--16">
                        <div class="rbt-store-price-1">
                            <div class="pricing-part mt--0">
                                <span class="price-text"><?= $m($onSale ? $p['sale_price'] : $p['price']) ?></span>
                                <?php if ($onSale): ?><del class="price-text"><?= $m($p['price']) ?></del><span class="rbt-offer-badge rbt-offer-badge-md">Save <?= $pct ?>%</span><?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($p['short_description'] ?? ''): ?><p class="description-text b2 mt--16"><?= esc($p['short_description']) ?></p><?php endif; ?>

                    <div class="rbt-info-wrapper d-flex mt--16 flex-wrap" style="gap:18px">
                        <?php if ($p['sku']): ?><div class="prd-id-text d-flex" style="gap:6px"><p class="text-bold">SKU:</p><p><?= esc($p['sku']) ?></p></div><?php endif; ?>
                        <?php if ($p['colors']): ?><div class="prd-id-text d-flex" style="gap:6px"><p class="text-bold">Colour:</p><p><?= esc(ucfirst(explode(',', $p['colors'])[0])) ?></p></div><?php endif; ?>
                        <div class="prd-id-text d-flex" style="gap:6px"><p class="text-bold">Availability:</p>
                            <?php if ($stock > 0): ?><p style="color:#1a8f4c"><?= $stock ?> in stock</p><?php else: ?><p style="color:#c0392b">Out of stock</p><?php endif; ?></div>
                    </div>

                    <?php if ($sizes): ?>
                    <div class="mt--24">
                        <p class="text-bold mb--8">Select size <small style="font-weight:400;color:#7a90b0">(pick one or more)</small></p>
                        <div class="bloom-size-pills" role="group" aria-label="Select sizes">
                            <?php foreach ($sizes as $sz): ?>
                            <button type="button" class="bloom-pill" data-card-size="<?= esc($sz, 'attr') ?>" aria-pressed="false"><?= esc($sz) ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($stock > 0): ?>
                    <div class="product-btn-grp mt--24">
                        <div class="rbt-qty-area">
                            <button type="button" class="qty-item-btn qty-item-btn-decr" aria-label="Decrease quantity"><i class="fa-solid fa-minus"></i></button>
                            <input type="number" class="items-qty-input" data-product-qty value="1" min="1" max="<?= $maxQty ?>">
                            <button type="button" class="qty-item-btn qty-item-btn-incr" aria-label="Increase quantity"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <a class="rbt-btn rbt-btn-border has-left-icon d-block text-center" href="#" data-add-to-cart="<?= (int) $p['id'] ?>"><i class="fa-regular fa-cart-shopping"></i> Add To Cart</a>
                    </div>
                    <?php else: ?>
                    <p class="mt--24"><span class="rbt-btn rbt-btn-border disabled" style="opacity:.5;pointer-events:none">Out of stock</span></p>
                    <?php endif; ?>

                    <div class="rbt-quick-link-grp">
                        <button class="rbt-quick-link rbt-wishlisted-btn" type="button"><i class="fa-sharp fa-regular fa-heart"></i> Add To Wishlist</button>
                    </div>

                    <ul class="mt--24 b3" style="list-style:none;padding:0;display:grid;gap:6px">
                        <li><i class="fa-solid fa-truck mr--4"></i> Free delivery on orders over PKR 10,000</li>
                        <li><i class="fa-solid fa-hand-holding-dollar mr--4"></i> Cash on delivery available</li>
                        <li><i class="fa-solid fa-rotate-left mr--4"></i> 7 days easy returns</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="row mt--40">
            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="tab" href="#bloom-tab-desc" role="tab">Description</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#bloom-tab-spec" role="tab">Specification</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#bloom-tab-rev" role="tab">Reviews (<?= (int) $p['rating_count'] ?>)</a></li>
                </ul>
                <div class="tab-content pt--24">
                    <div class="tab-pane fade show active" id="bloom-tab-desc" role="tabpanel">
                        <p class="b2"><?= nl2br(esc($p['description'] ?: ($p['short_description'] ?: $p['name'] . ' — soft, comfortable and made for play.'))) ?></p>
                    </div>
                    <div class="tab-pane fade" id="bloom-tab-spec" role="tabpanel">
                        <table class="table" style="max-width:560px">
                            <tbody>
                                <?php foreach ([
                                    'Category'  => $p['category_name'],
                                    'Age group' => $ageLabels[$p['age_group']] ?? $p['age_group'],
                                    'Material'  => $p['material'],
                                    'Colour'    => $p['colors'] ? ucfirst(explode(',', $p['colors'])[0]) : null,
                                    'Sizes'     => $sizes ? implode(', ', $sizes) : null,
                                    'SKU'       => $p['sku'],
                                ] as $k => $v): if (! $v) continue; ?>
                                <tr><th style="width:160px"><?= esc($k) ?></th><td><?= esc($v) ?></td></tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="bloom-tab-rev" role="tabpanel">
                        <div class="d-flex align-items-center" style="gap:12px">
                            <h3 class="h2 mb-0"><?= number_format((float) $p['rating_avg'], 1) ?></h3>
                            <div class="rbt-card-rating mt--0"><ul class="rbt-rating-icon-list"><?= $stars((float) $p['rating_avg']) ?></ul><p class="rating-digit">Based on <?= (int) $p['rating_count'] ?> review<?= (int) $p['rating_count'] === 1 ? '' : 's' ?></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($related): ?>
        <div class="row mt--48">
            <div class="col-12"><h3 class="h4 mb--8">You may also like</h3></div>
            <?php foreach ($related as $r):
                $rs = $r['sale_price'] !== null && (float) $r['sale_price'] < (float) $r['price']; ?>
            <div class="col-lg-3 col-md-4 col-6 mt--16">
                <div class="rbt-card rbt-product-card has-hover-box-shadow"><div class="inner">
                    <div class="rbt-card-img rbt-has-hover-img rbt-bg-color-default">
                        <a href="<?= site_url('product/' . $r['slug']) ?>">
                            <img class="rbt-prd-img" src="<?= $img($r['image']) ?>" alt="<?= esc($r['name']) ?>" loading="lazy">
                            <img class="rbt-hover-img" src="<?= $img($r['hover_image'] ?: $r['image']) ?>" alt="<?= esc($r['name']) ?>" loading="lazy">
                        </a>
                    </div>
                    <div class="rbt-card-body">
                        <h2 class="rbt-card-title"><a href="<?= site_url('product/' . $r['slug']) ?>"><?= esc($r['name']) ?></a></h2>
                        <div class="pricing-part"><span class="price-text"><?= $m($rs ? $r['sale_price'] : $r['price']) ?></span><?php if ($rs): ?><del class="rbt-dis-price-text"><?= $m($r['price']) ?></del><?php endif; ?></div>
                    </div>
                </div></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('click', function (e) {
    var t = e.target.closest('.bloom-thumb');
    if (!t) return;
    var main = document.getElementById('bloom-main-img');
    main.src = t.dataset.src;
    document.getElementById('bloom-main-link').href = t.dataset.src;
    document.querySelectorAll('.bloom-thumb').forEach(function (b) { b.style.borderColor = b === t ? '#233b61' : 'transparent'; });
});
</script>
<?= $this->include('storefront/partials/footer') ?>
<?= $this->include('storefront/partials/auth_modal') ?>
<?= $this->include('storefront/partials/scripts') ?>
