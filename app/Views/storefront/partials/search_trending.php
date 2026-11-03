<?php
// Best sellers shown inside the search overlay.
static $trending = null;
$trending ??= db_connect()->table('products')
    ->select('products.name, products.slug, products.image, products.price, products.sale_price, products.badge')
    ->where('is_active', 1)->where('stock >', 0)
    ->orderBy('sold_count', 'DESC')->limit(4)->get()->getResultArray();
?>
                <div class="row row--12 m--0 mt--16">
                    <?php foreach ($trending as $t):
                        $sale = $t['sale_price'] !== null && (float) $t['sale_price'] < (float) $t['price']; ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 mt--16">
                        <div class="rbt-card rbt-product-card has-hover-box-shadow">
                            <div class="inner">
                                <div class="rbt-card-img rbt-bg-color-default">
                                    <a href="<?= site_url('product/' . $t['slug']) ?>">
                                        <img src="<?= base_url($t['image']) ?>" alt="<?= esc($t['name']) ?>" loading="lazy">
                                    </a>
                                    <?php if ($t['badge']): ?>
                                    <div class="rbt-badge-wrapper rbt-content-top-left"><div class="rbt-product-badge rbt-product-badge-bg-secondary-gradient border-rounded"><?= esc($t['badge']) ?></div></div>
                                    <?php endif; ?>
                                </div>
                                <div class="rbt-card-body">
                                    <h2 class="rbt-card-title"><a href="<?= site_url('product/' . $t['slug']) ?>"><?= esc($t['name']) ?></a></h2>
                                    <div class="pricing-part">
                                        <span class="price-text">PKR <?= number_format((float) ($sale ? $t['sale_price'] : $t['price'])) ?></span>
                                        <?php if ($sale): ?><del class="rbt-dis-price-text">PKR <?= number_format((float) $t['price']) ?></del><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
