<?php
use App\Libraries\Cart as CartLib;

$m    = static fn ($v) => CartLib::money($v);
$card = $order['payment_method'] === 'card';
?>
<?= $this->include('storefront/partials/head') ?>
<?= $this->include('storefront/partials/header') ?>
<?= view('storefront/partials/breadcrumb', ['crumbs' => ['Checkout' => null, 'Thank You' => null]]) ?>

<div class="rbt-component-area rbt-cart-page rbt-section-gapBottom rbt-bg-color-white">
    <div class="container">
        <div class="row row--12 mt_dec--24 justify-content-center">
            <div class="col-xl-8 col-12 mt--24 rbt-checkout-single-content">
                <div class="w-100 pt-sm-2 pt-md-3 pt-lg-4 pb-lg-4 px-3 px-sm-4">
                    <div class="d-flex align-items-sm-center border-bottom pb-3 pb-md-4 active">
                        <div class="rbt-checkout-step rbt-bg-color-success rbt-text-color-white"><i class="fa-solid fa-check"></i></div>
                        <div class="w-100 ps-3">
                            <div class="fs-sm mb-1">Order #<?= esc($order['order_number']) ?></div>
                            <div class="d-sm-flex align-items-center">
                                <h1 class="h4 mb-0 me-3">Thank you for your order!</h1>
                                <div class="nav mt-2 mt-sm-0 ms-auto rbt-link-hover"><a class="nav-link p-0" href="<?= site_url('track-order') ?>">Track order</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-4 pt-3 pb-4 mt-3">
                        <div>
                            <h2 class="h6 mb-2">Delivery</h2>
                            <p class="fs-sm mb-0"><?= esc($order['name']) ?> · <?= esc($order['phone']) ?><br>
                                <?= esc($order['address']) ?>, <?= esc($order['city']) ?>, <?= esc($order['province']) ?><?= $order['postal_code'] ? ' ' . esc($order['postal_code']) : '' ?></p>
                        </div>
                        <div>
                            <h2 class="h6 mb-2">Estimated delivery</h2>
                            <p class="fs-sm mb-0"><?= date('l, j M', strtotime('+3 days')) ?> – <?= date('l, j M', strtotime('+5 days')) ?></p>
                        </div>
                        <div>
                            <h2 class="h6 mb-2">Payment</h2>
                            <?php if ($card): ?>
                            <p class="fs-sm mb-0"><?= esc($order['card_brand']) ?> ending <?= esc($order['card_last4']) ?> · <strong>Paid</strong> <?= $m($order['total']) ?></p>
                            <?php else: ?>
                            <p class="fs-sm mb-0">Cash on delivery · please keep <strong><?= $m($order['total']) ?></strong> ready for our rider.</p>
                            <?php endif; ?>
                        </div>
                        <p class="fs-sm mb-0">A confirmation will be sent to <strong><?= esc($order['email']) ?></strong>. Use your order number and email on the <a href="<?= site_url('track-order') ?>">Track Your Order</a> page anytime.</p>
                    </div>

                    <div class="rbt-transparent-table-one-wrapper rbt-has-bg-gray">
                        <table class="rbt-transparent-table-one table-variation-one mb--0">
                            <thead><tr><th>Item</th><th>Qty</th><th>Total</th></tr></thead>
                            <tbody>
                                <?php foreach ($items as $i): ?>
                                <tr>
                                    <td>
                                        <div class="cart-product-card">
                                            <div class="product-thumbnail"><img src="<?= base_url($i['image']) ?>" alt="<?= esc($i['name']) ?>"></div>
                                            <div class="d-flex flex-column">
                                                <h3 class="rbt-wish-product-name h6 mb-0"><?= esc($i['name']) ?></h3>
                                                <span class="rbt-product-id"><?= $i['size'] ? 'Size ' . esc($i['size']) . ' · ' : '' ?><?= $m($i['unit_price']) ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= (int) $i['qty'] ?></td>
                                    <td><span class="rbt-bold--text"><?= $m($i['line_total']) ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="p--16">
                            <div class="rbt-cart-subttotal"><p>Subtotal</p><p class="price"><?= $m($order['subtotal']) ?></p></div>
                            <div class="rbt-cart-subttotal"><p>Delivery</p><p class="price"><?= (float) $order['shipping'] ? $m($order['shipping']) : 'Free' ?></p></div>
                            <hr class="mb--8 mt--8 rbt-bg-color-gray-200">
                            <div class="rbt-cart-subttotal"><p class="subtotal"><strong>Total</strong></p><p class="price"><?= $m($order['total']) ?></p></div>
                        </div>
                    </div>

                    <div class="mt--24"><a href="<?= site_url('shop') ?>" class="rbt-btn rbt-btn-sm">Continue shopping</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('storefront/partials/footer') ?>
<?= $this->include('storefront/partials/auth_modal') ?>
<?= $this->include('storefront/partials/scripts') ?>
