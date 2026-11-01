<?php
$steps = ['placed' => ['Order placed', 'fa-receipt'], 'processing' => ['Processing', 'fa-box'], 'shipped' => ['Shipped', 'fa-truck-fast'], 'delivered' => ['Delivered', 'fa-house-circle-check']];
$statusKey = $order['status'] ?? '';
$reached   = array_search($statusKey, array_keys($steps), true);
?>
<?= $this->include('storefront/partials/head') ?>
<?= $this->include('storefront/partials/header') ?>
<?= view('storefront/partials/breadcrumb', ['crumbs' => ['Track Your Order' => null]]) ?>

<div class="rbt-component-area rbt-section-gap rbt-bg-color-gray-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6">
                <div class="rbt-bg-color-white p--32" style="border-radius:16px">
                    <div class="rbt-component-section-title rbt-gap--4 mb--0 p-0 border-0 text-center">
                        <h2 class="rbt-title mb--8"><span class="rbt-text-bold">Track Your Order</span></h2>
                        <p class="b2">Enter your order number and the email used at checkout to see where your order is.</p>
                    </div>

                    <?php if ($error): ?>
                        <div class="alert alert-danger mt--16"><?= esc($error) ?></div>
                    <?php endif; ?>

                    <form action="<?= site_url('track-order') ?>" method="post" class="mt--24">
                        <?= csrf_field() ?>
                        <div class="rbt-input-field-grp">
                            <label class="rbt-field-label" for="track_order_number">Order number<span class="rbt-text-color-danger">*</span></label>
                            <input class="rbt-input-field" type="text" id="track_order_number" name="order_number" placeholder="e.g. BK-10025" value="<?= esc(old('order_number')) ?>" required>
                        </div>
                        <div class="rbt-input-field-grp mt--16">
                            <label class="rbt-field-label" for="track_email">Billing email<span class="rbt-text-color-danger">*</span></label>
                            <input class="rbt-input-field" type="email" id="track_email" name="email" placeholder="you@example.com" value="<?= esc(old('email') ?: ($email ?? '')) ?>" required>
                        </div>
                        <button type="submit" class="rbt-btn d-block w-100 mt--24"><i class="fa-regular fa-location-dot mr--4"></i> Track order</button>
                    </form>

                    <?php if ($order): ?>
                    <hr class="mt--32 mb--24">
                    <h3 class="h6 mb--4">Order #<?= esc($order['order_number']) ?></h3>
                    <p class="b3 mb--16">Placed on <?= esc(date('M d, Y', strtotime($order['created_at']))) ?> &middot; Total $<?= number_format((float) $order['total'], 2) ?></p>

                    <?php if ($statusKey === 'cancelled'): ?>
                        <div class="alert alert-warning">This order was cancelled.</div>
                    <?php else: ?>
                        <ul class="list-unstyled m-0">
                            <?php $i = 0; foreach ($steps as $key => [$label, $icon]): $done = $reached !== false && $i <= $reached; $i++; ?>
                            <li class="d-flex align-items-center mb--16" style="gap:14px;<?= $done ? '' : 'opacity:.45' ?>">
                                <span style="width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:<?= $done ? '#233b61' : '#e6eaf1' ?>;color:<?= $done ? '#fff' : '#556f93' ?>"><i class="fa-regular <?= $icon ?>"></i></span>
                                <span class="b1 <?= $key === $statusKey ? 'rbt-text-bold' : '' ?>"><?= $label ?></span>
                                <?php if ($key === $statusKey): ?><span class="badge bg-primary ms-auto">Current</span><?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php if (! empty($order['tracking_number'])): ?>
                            <p class="b2 mt--8 mb--0">Carrier: <strong><?= esc($order['carrier'] ?: 'Courier') ?></strong> &middot; Tracking no. <strong><?= esc($order['tracking_number']) ?></strong></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('storefront/partials/footer') ?>
<?= $this->include('storefront/partials/auth_modal') ?>
<?= $this->include('storefront/partials/scripts') ?>
