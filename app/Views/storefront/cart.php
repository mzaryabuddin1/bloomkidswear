<?php
use App\Libraries\Cart as CartLib;

$m = static fn ($v) => CartLib::money($v);
?>
<?= $this->include('storefront/partials/head') ?>
<?= $this->include('storefront/partials/header') ?>
<?= view('storefront/partials/breadcrumb', ['crumbs' => ['Shopping Cart' => null]]) ?>

<div class="rbt-component-area rbt-cart-page rbt-section-gapBottom rbt-bg-color-white">
    <div class="container">
        <div class="row row--12">
            <div class="col-lg-12">
                <div class="rbt-component-section-title d-flex flex-coloumn justify-content-center align-items-center p-0 mb--24 border-0">
                    <h2 class="rbt-title"><span class="rbt-bold--text">Shopping Cart</span></h2>
                </div>
            </div>
        </div>

        <div id="bloom-cart-region">
            <?php if (session()->getFlashdata('cartNotice')): ?>
            <div class="alert alert-warning mb--24"><?= esc(session()->getFlashdata('cartNotice')) ?></div>
            <?php endif; ?>

            <?php if (! $cart['items']): ?>
            <div class="text-center ptb--60">
                <i class="fa-regular fa-bag-shopping" style="font-size:56px;color:#a8b6cb"></i>
                <h3 class="h5 mt--16">Your cart is empty</h3>
                <p class="b2">Looks like you haven’t added anything yet.</p>
                <a href="<?= site_url('shop') ?>" class="rbt-btn rbt-btn-sm mt--8">Continue shopping</a>
            </div>
            <?php else: ?>
            <div class="row row--12 mt_dec--24">
                <div class="col-12 col-md-12 col-lg-8 mt--24">
                    <div class="rbt-transparent-table-one-wrapper rbt-has-bg-gray rbt-scrollable-content">
                        <table class="rbt-transparent-table-one table-variation-one mb--0">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart['items'] as $i): ?>
                                <tr>
                                    <td>
                                        <div class="cart-product-card">
                                            <div class="product-thumbnail">
                                                <a href="<?= esc($i['url'], 'attr') ?>"><img src="<?= esc($i['image'], 'attr') ?>" alt="<?= esc($i['name']) ?>"></a>
                                                <button type="button" class="close-btn" data-cart-remove="<?= esc($i['key'], 'attr') ?>" aria-label="Remove"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h3 class="rbt-wish-product-name h6"><a href="<?= esc($i['url'], 'attr') ?>"><?= esc($i['name']) ?></a></h3>
                                                <span class="rbt-product-id"><span class="rbt-text-semi-bold">SKU:</span> <?= esc($i['sku']) ?><?= $i['size'] ? ' · <span class="rbt-text-semi-bold">Size:</span> ' . esc($i['size']) : '' ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="price-text h6 d-block"><?= $m($i['price']) ?></span></td>
                                    <td>
                                        <div class="rbt-qty-area rbt-qty-sm">
                                            <button type="button" class="qty-item-btn qty-item-btn-decr"><i class="fa-solid fa-minus"></i></button>
                                            <input type="number" class="items-qty-input" data-cart-key="<?= esc($i['key'], 'attr') ?>" value="<?= str_pad((string) $i['qty'], 2, '0', STR_PAD_LEFT) ?>" min="1" max="<?= (int) $i['max'] ?>">
                                            <button type="button" class="qty-item-btn qty-item-btn-incr"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td><span class="price-text h6 d-block"><span class="rbt-bold--text"><?= $m($i['line']) ?></span></span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt--16"><a href="<?= site_url('shop') ?>" class="rbt-link-hover"><i class="fa-regular fa-arrow-left mr--4"></i> Continue shopping</a></div>
                </div>

                <div class="col-12 col-md-12 col-lg-4 mt--24">
                    <div class="rbt-sidebar-cart sticky-top">
                        <div class="rbt-sidebar-widget">
                            <div class="rbt-inner">
                                <h3 class="title h5 rbt-text-bold mb--12">Order summary</h3>
                                <div class="rbt-cart-subttotal">
                                    <p>Subtotal (<?= (int) $cart['count'] ?> item<?= $cart['count'] === 1 ? '' : 's' ?>)</p>
                                    <p class="price"><?= $m($cart['subtotal']) ?></p>
                                </div>
                                <div class="rbt-cart-subttotal">
                                    <p>Delivery</p>
                                    <p class="price"><?= $cart['shipping'] ? $m($cart['shipping']) : 'Free' ?></p>
                                </div>
                                <hr class="mb--8 mt--8 rbt-bg-color-gray-200">
                                <div class="rbt-cart-subttotal mb--12">
                                    <p class="subtotal"><strong>Total</strong></p>
                                    <p class="price"><?= $m($cart['total']) ?></p>
                                </div>
                                <div class="offer-progress-area">
                                    <p class="offer-text">
                                        <?php if ($cart['remaining'] > 0): ?>Add <strong><?= $m($cart['remaining']) ?></strong> more to get <strong>free delivery</strong>
                                        <?php else: ?>🎉 You’ve unlocked <strong>free delivery</strong><?php endif; ?>
                                    </p>
                                    <div class="progress" role="progressbar" aria-label="Free delivery progress" aria-valuenow="<?= (int) $cart['progress'] ?>" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width:<?= (int) $cart['progress'] ?>%"></div>
                                    </div>
                                </div>
                                <div class="rbt-minicart-bottom mt--24">
                                    <div class="checkout-btn mt--20">
                                        <a class="rbt-btn w-100 text-center" href="<?= site_url('checkout') ?>"><span class="btn-text">Proceed to checkout</span></a>
                                    </div>
                                    <p class="b3 mt--16 mb--0 text-center"><i class="fa-regular fa-money-bill-1-wave mr--4"></i> Cash on delivery &amp; card payments accepted</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->include('storefront/partials/footer') ?>
<?= $this->include('storefront/partials/auth_modal') ?>
<?= $this->include('storefront/partials/scripts') ?>
