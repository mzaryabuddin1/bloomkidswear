<?= $this->include('storefront/partials/head') ?>
<?= $this->include('storefront/partials/header') ?>
<?= view('storefront/partials/breadcrumb', ['crumbs' => ['My Account' => null, 'Account Information' => null]]) ?>

<div class="rbt-component-area rbt-section-gap rbt-bg-color-gray-light">
    <div class="container">
        <div class="row row--12 mt_dec--24">
            <div class="col-12 col-md-12 col-lg-4 col-xl-3 mt--24">
                <?= view('storefront/account/_sidebar', ['active' => 'info', 'customer' => $customer, 'orderCount' => $orderCount ?? 0, 'wishlistCount' => $wishlistCount ?? 0]) ?>
            </div>
            <div class="col-12 col-md-12 col-lg-8 col-xl-9 mt--24">
                <div class="rbt-profile-content-area">
                    <div class="rbt-component-section-title rbt-gap--4 mb--0 p-0 border-0">
                        <h2 class="rbt-title mb--0"><span class="rbt-text-bold">Personal Information</span></h2>
                    </div>
                    <hr class="mt--20 mb--16">

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
                    <?php endif; ?>

                    <!-- Basic info -->
                    <form action="<?= site_url('account/update/basic') ?>" method="post" class="rbt-single-info mb--24">
                        <?= csrf_field() ?>
                        <h2 class="h6 mb--16 pt--4">Basic Info</h2>
                        <div class="row row--12 mt_dec--24">
                            <div class="col-md-6 mt--24">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" id="first_name" name="first_name" value="<?= esc($firstName) ?>" required>
                            </div>
                            <div class="col-md-6 mt--24">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" id="last_name" name="last_name" value="<?= esc($lastName) ?>">
                            </div>
                            <div class="col-md-6 mt--24">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" id="birth_date" name="birth_date" value="<?= esc($customer['birth_date'] ?? '') ?>">
                            </div>
                        </div>
                        <button type="submit" class="rbt-btn rbt-btn-sm rbt-btn-secondary mt--20"><i class="fa-light fa-floppy-disk mr--4"></i>Save</button>
                    </form>
                    <hr>

                    <!-- Contact info -->
                    <form action="<?= site_url('account/update/contact') ?>" method="post" class="rbt-single-info mb--24">
                        <?= csrf_field() ?>
                        <h2 class="h6 mb--16 pt--4">Contact Info</h2>
                        <div class="row row--12 mt_dec--24">
                            <div class="col-md-6 mt--24">
                                <label for="edit_email" class="form-label">Email Address</label>
                                <input type="email" id="edit_email" value="<?= esc($customer['email']) ?>" readonly>
                            </div>
                            <div class="col-md-6 mt--24">
                                <label for="phone_number" class="form-label">Phone Number <small>(optional)</small></label>
                                <input type="tel" id="phone_number" name="phone" value="<?= esc($customer['phone'] ?? '') ?>">
                            </div>
                        </div>
                        <button type="submit" class="rbt-btn rbt-btn-sm rbt-btn-secondary mt--20"><i class="fa-light fa-floppy-disk mr--4"></i>Save</button>
                    </form>
                    <hr>

                    <!-- Password -->
                    <form action="<?= site_url('account/update/password') ?>" method="post" class="rbt-single-info mb--24">
                        <?= csrf_field() ?>
                        <h2 class="h6 mb--16 pt--4"><?= empty($customer['password']) ? 'Set a password' : 'Password' ?></h2>
                        <div class="row row--12 mt_dec--24">
                            <?php if (! empty($customer['password'])): ?>
                            <div class="col-md-12 mt--24">
                                <label for="curent_password" class="form-label">Current password</label>
                                <input type="password" id="curent_password" name="current_password" autocomplete="current-password" required>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-6 mt--24">
                                <label for="new_password" class="form-label">New password</label>
                                <input type="password" id="new_password" name="new_password" minlength="8" autocomplete="new-password" required>
                            </div>
                            <div class="col-md-6 mt--24">
                                <label for="confirm_password" class="form-label">Confirm password</label>
                                <input type="password" id="confirm_password" name="confirm_password" minlength="8" autocomplete="new-password" required>
                            </div>
                        </div>
                        <button type="submit" class="rbt-btn rbt-btn-sm rbt-btn-secondary mt--20"><i class="fa-light fa-floppy-disk mr--4"></i>Update password</button>
                    </form>
                    <hr>

                    <!-- Delivery address -->
                    <form action="<?= site_url('account/update/address') ?>" method="post" class="rbt-single-info mb--24">
                        <?= csrf_field() ?>
                        <h2 class="h6 mb--16 pt--4">Delivery Address</h2>
                        <div class="row row--12 mt_dec--24">
                            <div class="col-md-6 mt--24">
                                <label for="delivery_country" class="form-label">Country</label>
                                <input type="text" id="delivery_country" name="country" value="<?= esc($customer['country'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mt--24">
                                <label for="delivery_state" class="form-label">State / Province</label>
                                <input type="text" id="delivery_state" name="state" value="<?= esc($customer['state'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mt--24">
                                <label for="delivery_city" class="form-label">City</label>
                                <input type="text" id="delivery_city" name="city" value="<?= esc($customer['city'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mt--24">
                                <label for="zip_code" class="form-label">ZIP code</label>
                                <input type="text" id="zip_code" name="zip_code" value="<?= esc($customer['zip_code'] ?? '') ?>">
                            </div>
                            <div class="col-12 mt--24">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" name="address" value="<?= esc($customer['address'] ?? '') ?>">
                            </div>
                        </div>
                        <button type="submit" class="rbt-btn rbt-btn-sm rbt-btn-secondary mt--20"><i class="fa-light fa-floppy-disk mr--4"></i>Save address</button>
                    </form>
                    <hr>

                    <!-- Delete account -->
                    <form action="<?= site_url('account/delete') ?>" method="post" class="rbt-single-info mb--24"
                        onsubmit="return confirm('Deactivate your account? You will be signed out.');">
                        <?= csrf_field() ?>
                        <h2 class="h6 mb--12 pt--4">Delete Account</h2>
                        <p class="b1 mb--8">Deleting your account deactivates your profile and signs you out. Contact us if you would like it restored.</p>
                        <button type="submit" class="rbt-btn rbt-btn-sm rbt-bg-color-danger mt--16 shadow-none"><i class="fa-regular fa-trash-can-slash mr--4"></i>Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('storefront/partials/footer') ?>
<?= $this->include('storefront/partials/auth_modal') ?>
<?= $this->include('storefront/partials/scripts') ?>
