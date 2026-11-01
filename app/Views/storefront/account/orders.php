<?= $this->include('storefront/partials/head') ?>
<?= $this->include('storefront/partials/header') ?>
<?= view('storefront/partials/breadcrumb', ['crumbs' => ['My Account' => site_url('account'), 'Orders' => null]]) ?>

<div class="rbt-component-area rbt-section-gap rbt-bg-color-gray-light">
    <div class="container">
        <div class="row row--12 mt_dec--24">
            <div class="col-12 col-md-12 col-lg-4 col-xl-3 mt--24">
                <?= view('storefront/account/_sidebar', ['active' => 'orders', 'customer' => $customer, 'orderCount' => $orderCount ?? 0, 'wishlistCount' => $wishlistCount ?? 0]) ?>
            </div>
            <div class="col-12 col-md-12 col-lg-8 col-xl-9 mt--24">
                <div class="rbt-profile-content-area">
                    <div class="rbt-component-section-title rbt-gap--4 mb--0 p-0 border-0">
                        <h2 class="rbt-title mb--0"><span class="rbt-text-bold">My orders</span></h2>
                    </div>
                    <hr class="mt--24">
                    <?php if (! $orders): ?>
                        <div class="text-center ptb--40">
                            <i class="fa-regular fa-box-open" style="font-size:44px;color:#a8b6cb"></i>
                            <h3 class="h6 mt--16">No orders yet</h3>
                            <p class="b2">When you place an order it will show up here.</p>
                            <a href="<?= site_url('home') ?>" class="rbt-btn rbt-btn-sm mt--8">Start shopping</a>
                        </div>
                    <?php else: ?>
                    <div class="rbt-transparent-table-one-wrapper">
                        <table class="rbt-transparent-table-one table-variation-one m--0 mb--0">
                            <thead>
                                <tr>
                                    <th class="pt--0" scope="col">Order ID</th>
                                    <th class="pt--0" scope="col">Date</th>
                                    <th class="pt--0" scope="col">Status</th>
                                    <th class="pt--0" scope="col">Total</th>
                                    <th class="pt--0" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>#<?= esc($order['order_number']) ?></td>
                                    <td><?= esc(date('M d, Y', strtotime($order['created_at']))) ?></td>
                                    <td><?= esc(ucfirst($order['status'])) ?></td>
                                    <td>$<?= number_format((float) $order['total'], 2) ?></td>
                                    <td><a href="<?= site_url('track-order') ?>" class="rbt-btn rbt-btn-sm rbt-btn-secondary">Track</a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('storefront/partials/footer') ?>
<?= $this->include('storefront/partials/auth_modal') ?>
<?= $this->include('storefront/partials/scripts') ?>
