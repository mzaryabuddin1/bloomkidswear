<?php
$googleUrl   = site_url('account/google');
$flashAuth   = session()->getFlashdata('open_auth');
$flashError  = session()->getFlashdata('auth_error');
$logo        = base_url('assets/frontend/images/logo/bloom-logo-header.png');
?>
<style>
    .bloom-account-menu { display: none; position: absolute; right: 0; top: calc(100% + 10px); z-index: 1100; background: #fff; min-width: 230px; padding: 8px 0; border-radius: 12px; border: 1px solid #e6eaf1; box-shadow: 0 12px 32px rgba(35, 59, 97, .14); }
    .bloom-account-li.open .bloom-account-menu { display: block; }
    .bloom-account-menu .dropdown-item { text-decoration: none; display: flex; align-items: center; gap: 10px; padding: 9px 16px; font-size: 14px; color: #233b61; }
    .bloom-account-menu .dropdown-item i { width: 16px; color: #556f93; }
    .bloom-account-menu .dropdown-item:hover { background: #f2f4f8; }
    .bloom-account-menu-head { padding: 8px 16px 10px; display: flex; flex-direction: column; border-bottom: 1px solid #e6eaf1; margin-bottom: 6px; }
    .bloom-account-menu-head small { color: #7a90b0; font-size: 12px; word-break: break-all; }
    .bloom-auth-view { display: none; }
    .bloom-auth-view.active { display: block; }
    .bloom-auth-alert { display: none; font-size: 14px; padding: 10px 14px; border-radius: 8px; margin-bottom: 12px; }
    .bloom-auth-alert.error { display: block; background: #fdecec; color: #d12626; }
    .bloom-auth-alert.ok { display: block; background: #e8f6ee; color: #1a7f4b; }
    .bloom-link-btn { background: none; border: 0; padding: 0; color: #233b61; font-weight: 600; text-decoration: underline; cursor: pointer; }
    .bloom-link-btn:disabled { color: #a8b6cb; text-decoration: none; cursor: default; }
    .bloom-otp-input { text-align: center; letter-spacing: 10px; font-size: 22px; font-weight: 700; }
    #authModal .rbt-login-form-inner { max-width: 460px; margin: 0 auto; }
    #authModal .rbt-login-form-top { padding-bottom: 8px; }
    .bloom-toast { position: fixed; left: 50%; bottom: 28px; transform: translate(-50%, 20px); background: #233b61; color: #fff; padding: 12px 22px; border-radius: 10px; font-size: 14px; opacity: 0; pointer-events: none; transition: all .25s; z-index: 99999; }
    .bloom-toast.show { opacity: 1; transform: translate(-50%, 0); }
    .rbt-wishlisted-btn.bloom-wished i { font-weight: 900; color: #e5484d; }
</style>

<div class="rbt-default-modal modal fade has-rbt-top-folder-shape" id="authModal" tabindex="-1" role="dialog"
    aria-modal="true" aria-labelledby="authModalLabel" aria-hidden="true"
    data-flash-view="<?= esc($flashAuth ?? '') ?>" data-flash-error="<?= esc($flashError ?? '') ?>">
    <div class="modal-dialog rbt-register-form-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="rbt-folder-shape-right-portion">
                <svg xmlns="http://www.w3.org/2000/svg" width="85" height="90" viewBox="0 0 85 90" fill="none">
                    <path d="M0 0H11.1844C14.5695 0 17.7971 1.42971 20.0716 3.93671L82.1927 72.4059C83.9992 74.397 84.9999 76.9893 84.9999 79.6778C84.9999 85.6547 85.0001 90 85.0001 90H0V0Z" fill="white" />
                </svg>
            </div>
            <div class="modal-header">
                <button type="button" class="rbt-round-btn rbt-modal-dis-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="rbt-top-folder-shape-wrapper">
                <div class="rbt-login-form rbt-bg-color-white rbt-content-trs-portion">
                    <div class="rbt-login-form-inner">
                        <div class="rbt-login-form-top">
                            <div class="logo mb--16">
                                <a href="<?= site_url('home') ?>"><img src="<?= $logo ?>" alt="Bloom Kids Wear"></a>
                            </div>

                            <div id="bloom-auth-alert" class="bloom-auth-alert" role="alert"></div>

                            <!-- Sign in -->
                            <div class="bloom-auth-view active" data-view="signin">
                                <h3 class="rbt-title rbt-text-bold mb--16 h6" id="authModalLabel">Sign In To Proceed</h3>
                                <form data-auth-form="account/login">
                                    <div class="rbt-input-field-grp">
                                        <label class="rbt-field-label" for="auth_signin_email">Your Email<span class="rbt-text-color-danger">*</span></label>
                                        <input class="rbt-input-field" placeholder="Email" type="email" id="auth_signin_email" name="email" required autocomplete="email">
                                    </div>
                                    <div class="rbt-input-field-grp mt--16">
                                        <label class="rbt-field-label" for="auth_signin_password">Password<span class="rbt-text-color-danger">*</span></label>
                                        <input class="rbt-input-field" placeholder="Password" type="password" id="auth_signin_password" name="password" required autocomplete="current-password">
                                    </div>
                                    <div class="text-end mt--8">
                                        <button type="button" class="bloom-link-btn b4" data-auth-go="forgot">Forgot password?</button>
                                    </div>
                                    <button type="submit" class="rbt-btn d-block w-100 mt--16 mb--16">Sign In</button>
                                </form>
                                <?= view('storefront/partials/auth_google', ['googleUrl' => $googleUrl]) ?>
                                <div class="rbt-login-system-switch rbt-link-hover mt--16">
                                    Don't have an account?
                                    <button type="button" class="rbt-switch-btn" data-auth-go="signup"><span>Create an account</span></button>
                                </div>
                            </div>

                            <!-- Sign up -->
                            <div class="bloom-auth-view" data-view="signup">
                                <h3 class="rbt-title rbt-text-bold mb--4 h6">Create an Account</h3>
                                <p class="b4 mb--16">Join Bloom Rewards to earn loyalty points and unlock member-only discounts.</p>
                                <form data-auth-form="account/signup/start">
                                    <div class="row row--12">
                                        <div class="col-6">
                                            <div class="rbt-input-field-grp">
                                                <label class="rbt-field-label" for="auth_su_first">First name<span class="rbt-text-color-danger">*</span></label>
                                                <input class="rbt-input-field" type="text" id="auth_su_first" name="first_name" required autocomplete="given-name">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="rbt-input-field-grp">
                                                <label class="rbt-field-label" for="auth_su_last">Last name</label>
                                                <input class="rbt-input-field" type="text" id="auth_su_last" name="last_name" autocomplete="family-name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rbt-input-field-grp mt--12">
                                        <label class="rbt-field-label" for="auth_su_email">Your Email<span class="rbt-text-color-danger">*</span></label>
                                        <input class="rbt-input-field" placeholder="Email" type="email" id="auth_su_email" name="email" required autocomplete="email">
                                    </div>
                                    <div class="rbt-input-field-grp mt--12">
                                        <label class="rbt-field-label" for="auth_su_phone">Phone <span class="b4">(optional)</span></label>
                                        <input class="rbt-input-field" placeholder="Phone number" type="tel" id="auth_su_phone" name="phone" autocomplete="tel">
                                    </div>
                                    <div class="rbt-input-field-grp mt--12">
                                        <label class="rbt-field-label" for="auth_su_password">Password<span class="rbt-text-color-danger">*</span></label>
                                        <input class="rbt-input-field" placeholder="At least 8 characters" type="password" id="auth_su_password" name="password" required minlength="8" autocomplete="new-password">
                                    </div>
                                    <div class="mt--12">
                                        <button type="button" class="bloom-link-btn b4" data-bs-toggle="collapse" data-bs-target="#auth_su_address_box" aria-expanded="false">+ Add delivery address (optional)</button>
                                    </div>
                                    <div class="collapse" id="auth_su_address_box">
                                        <div class="rbt-input-field-grp mt--12">
                                            <label class="rbt-field-label" for="auth_su_address">Address</label>
                                            <input class="rbt-input-field" type="text" id="auth_su_address" name="address" autocomplete="street-address">
                                        </div>
                                        <div class="row row--12 mt--12">
                                            <div class="col-6">
                                                <label class="rbt-field-label" for="auth_su_city">City</label>
                                                <input class="rbt-input-field" type="text" id="auth_su_city" name="city" autocomplete="address-level2">
                                            </div>
                                            <div class="col-6">
                                                <label class="rbt-field-label" for="auth_su_zip">ZIP code</label>
                                                <input class="rbt-input-field" type="text" id="auth_su_zip" name="zip_code" autocomplete="postal-code">
                                            </div>
                                        </div>
                                        <div class="rbt-input-field-grp mt--12">
                                            <label class="rbt-field-label" for="auth_su_country">Country</label>
                                            <input class="rbt-input-field" type="text" id="auth_su_country" name="country" autocomplete="country-name">
                                        </div>
                                    </div>
                                    <button type="submit" class="rbt-btn d-block w-100 mt--20 mb--16">Send verification code</button>
                                </form>
                                <?= view('storefront/partials/auth_google', ['googleUrl' => $googleUrl]) ?>
                                <div class="rbt-login-system-switch rbt-link-hover mt--16">
                                    Already have an account?
                                    <button type="button" class="rbt-switch-btn" data-auth-go="signin"><span>Sign in</span></button>
                                </div>
                            </div>

                            <!-- Verify email (signup OTP) -->
                            <div class="bloom-auth-view" data-view="otp">
                                <h3 class="rbt-title rbt-text-bold mb--8 h6">Verify your email</h3>
                                <p class="b4 mb--16" data-otp-text>Enter the 6-digit code we emailed you.</p>
                                <form data-auth-form="account/signup/verify">
                                    <input type="hidden" name="email" data-otp-email>
                                    <div class="rbt-input-field-grp">
                                        <label class="rbt-field-label" for="auth_otp_code">Verification code</label>
                                        <input class="rbt-input-field bloom-otp-input" type="text" inputmode="numeric" maxlength="6" id="auth_otp_code" name="code" required autocomplete="one-time-code" placeholder="------">
                                    </div>
                                    <button type="submit" class="rbt-btn d-block w-100 mt--16 mb--12">Verify &amp; create account</button>
                                </form>
                                <div class="d-flex justify-content-between b4">
                                    <button type="button" class="bloom-link-btn" data-auth-resend="signup">Resend code</button>
                                    <button type="button" class="bloom-link-btn" data-auth-go="signup">Back</button>
                                </div>
                            </div>

                            <!-- Forgot password -->
                            <div class="bloom-auth-view" data-view="forgot">
                                <h3 class="rbt-title rbt-text-bold mb--8 h6">Forgot your password?</h3>
                                <p class="b4 mb--16">Enter your email and we'll send you a code to reset it.</p>
                                <form data-auth-form="account/forgot">
                                    <div class="rbt-input-field-grp">
                                        <label class="rbt-field-label" for="auth_fp_email">Your Email<span class="rbt-text-color-danger">*</span></label>
                                        <input class="rbt-input-field" placeholder="Email" type="email" id="auth_fp_email" name="email" required autocomplete="email">
                                    </div>
                                    <button type="submit" class="rbt-btn d-block w-100 mt--16 mb--12">Send reset code</button>
                                </form>
                                <div class="text-center b4"><button type="button" class="bloom-link-btn" data-auth-go="signin">Back to sign in</button></div>
                            </div>

                            <!-- Reset password -->
                            <div class="bloom-auth-view" data-view="reset">
                                <h3 class="rbt-title rbt-text-bold mb--8 h6">Reset your password</h3>
                                <p class="b4 mb--16" data-otp-text>Enter the code we emailed you and choose a new password.</p>
                                <form data-auth-form="account/reset">
                                    <input type="hidden" name="email" data-otp-email>
                                    <div class="rbt-input-field-grp">
                                        <label class="rbt-field-label" for="auth_rp_code">Verification code</label>
                                        <input class="rbt-input-field bloom-otp-input" type="text" inputmode="numeric" maxlength="6" id="auth_rp_code" name="code" required autocomplete="one-time-code" placeholder="------">
                                    </div>
                                    <div class="rbt-input-field-grp mt--12">
                                        <label class="rbt-field-label" for="auth_rp_password">New password<span class="rbt-text-color-danger">*</span></label>
                                        <input class="rbt-input-field" placeholder="At least 8 characters" type="password" id="auth_rp_password" name="password" required minlength="8" autocomplete="new-password">
                                    </div>
                                    <button type="submit" class="rbt-btn d-block w-100 mt--16 mb--12">Update password</button>
                                </form>
                                <div class="d-flex justify-content-between b4">
                                    <button type="button" class="bloom-link-btn" data-auth-resend="reset">Resend code</button>
                                    <button type="button" class="bloom-link-btn" data-auth-go="signin">Back to sign in</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bloom-toast" id="bloom-toast" role="status" aria-live="polite"></div>
