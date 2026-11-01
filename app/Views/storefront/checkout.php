<?php
use App\Libraries\Cart as CartLib;

$m   = static fn ($v) => CartLib::money($v);
$err = static fn (string $k) => isset($errors[$k]) ? '<small class="d-block mt--4" style="color:#d6336c">' . esc($errors[$k]) . '</small>' : '';
?>
<?= $this->include('storefront/partials/head') ?>
<?= $this->include('storefront/partials/header') ?>
<?= view('storefront/partials/breadcrumb', ['crumbs' => ['Cart' => site_url('cart'), 'Checkout' => null]]) ?>

<div class="rbt-component-area rbt-cart-page rbt-section-gapBottom rbt-bg-color-white">
    <div class="container">
        <?php if ($error): ?><div class="alert alert-danger mb--24"><i class="fa-regular fa-circle-exclamation mr--4"></i> <?= esc($error) ?></div><?php endif; ?>
        <?php if ($errors): ?><div class="alert alert-danger mb--24">Please fix the highlighted fields below and try again.</div><?php endif; ?>

        <form method="post" action="<?= site_url('checkout') ?>" id="bloom-checkout-form" novalidate autocomplete="on">
            <?= csrf_field() ?>
            <div class="row row--12 mt_dec--24">
                <div class="col-12 col-lg-8 mt--24">
                    <div class="rbt-transparent-table-one-wrapper rbt-has-bg-gray">
                        <div class="rbt-checkout-wrapper-box">

                            <!-- 1. Delivery details -->
                            <div class="rbt-checkout-single-content active">
                                <span class="rbt-checkout-step">1</span>
                                <div class="rbt-checkout-content-inner">
                                    <h3 class="title h5">Delivery Details</h3>
                                    <div class="row row--12">
                                        <div class="col-md-6 mb--16">
                                            <input type="text" name="name" placeholder="Full name *" value="<?= esc($form['name'], 'attr') ?>" autocomplete="name" required>
                                            <?= $err('name') ?>
                                        </div>
                                        <div class="col-md-6 mb--16">
                                            <input type="email" name="email" placeholder="Email address *" value="<?= esc($form['email'], 'attr') ?>" autocomplete="email" required>
                                            <?= $err('email') ?>
                                        </div>
                                        <div class="col-md-6 mb--16">
                                            <input type="tel" name="phone" placeholder="Phone, e.g. 0300 1234567 *" value="<?= esc($form['phone'], 'attr') ?>" autocomplete="tel" required>
                                            <?= $err('phone') ?>
                                        </div>
                                        <div class="col-md-6 mb--16">
                                            <input type="text" name="city" placeholder="City *" value="<?= esc($form['city'], 'attr') ?>" autocomplete="address-level2" required>
                                            <?= $err('city') ?>
                                        </div>
                                        <div class="col-12 mb--16">
                                            <input type="text" name="address" placeholder="Street address, house / apartment *" value="<?= esc($form['address'], 'attr') ?>" autocomplete="street-address" required>
                                            <?= $err('address') ?>
                                        </div>
                                        <div class="col-md-6 mb--16">
                                            <select name="province" class="w-100" style="height:50px" required>
                                                <option value="">Province *</option>
                                                <?php foreach ($provinces as $p): ?><option value="<?= esc($p, 'attr') ?>"<?= $form['province'] === $p ? ' selected' : '' ?>><?= esc($p) ?></option><?php endforeach; ?>
                                            </select>
                                            <?= $err('province') ?>
                                        </div>
                                        <div class="col-md-6 mb--16">
                                            <input type="text" name="postal_code" placeholder="Postal code (optional)" value="<?= esc($form['postal_code'], 'attr') ?>" autocomplete="postal-code">
                                        </div>
                                        <div class="col-12">
                                            <textarea name="notes" rows="2" placeholder="Order notes, e.g. delivery instructions (optional)"><?= esc($form['notes']) ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Payment -->
                            <div class="rbt-checkout-single-content active">
                                <span class="rbt-checkout-step">2</span>
                                <div class="rbt-checkout-content-inner">
                                    <h3 class="title h5">Payment Method</h3>
                                    <div class="mb-4" id="paymentMethod" role="list">

                                        <div class="single-payment-methode mt-2">
                                            <div class="rbt-radio-accordion form-check mb-0" role="listitem">
                                                <label class="form-check-label w-100 text-dark-emphasis fw-semibold">
                                                    <input type="radio" class="rbt-form-check-input me-1 me-sm-2" name="payment" value="cod"<?= $form['payment'] !== 'card' ? ' checked' : '' ?>>
                                                    <i class="fa-regular fa-money-bill-1-wave mr--4"></i> Cash on delivery
                                                </label>
                                            </div>
                                            <div class="pt-2 pb-2 ps-3 ms-2 ms-sm-3 bloom-pay-panel" data-pay="cod"<?= $form['payment'] === 'card' ? ' style="display:none"' : '' ?>>
                                                <p class="b3 mb-0">Pay in cash to our rider when your order arrives. Please keep the exact amount ready.</p>
                                            </div>
                                        </div>

                                        <div class="single-payment-methode mt-2 d-block">
                                            <div class="rbt-radio-accordion form-check mb-0" role="listitem">
                                                <label class="form-check-label d-flex align-items-center text-dark-emphasis fw-semibold">
                                                    <input type="radio" class="rbt-form-check-input me-1 me-sm-2" name="payment" value="card"<?= $form['payment'] === 'card' ? ' checked' : '' ?>>
                                                    <i class="fa-regular fa-credit-card mr--4"></i> Credit or debit card
                                                    <span class="d-none d-sm-flex gap-2 ms-3 b3 rbt-text-color-gray-400"><i class="fa-brands fa-cc-visa" style="font-size:24px"></i> <i class="fa-brands fa-cc-mastercard" style="font-size:24px"></i></span>
                                                </label>
                                            </div>
                                            <div class="pt-2 pb-2 ps-3 ms-2 ms-sm-3 bloom-pay-panel" data-pay="card"<?= $form['payment'] === 'card' ? '' : ' style="display:none"' ?>>
                                                <div class="mb--16">
                                                    <input type="text" name="card_number" inputmode="numeric" autocomplete="cc-number" placeholder="Card number" maxlength="23" data-card-field>
                                                </div>
                                                <div class="mb--16">
                                                    <input type="text" name="card_name" autocomplete="cc-name" placeholder="Name on card" data-card-field>
                                                </div>
                                                <div class="row row--12">
                                                    <div class="col-6"><input type="text" name="card_expiry" inputmode="numeric" autocomplete="cc-exp" placeholder="MM/YY" maxlength="7" data-card-field></div>
                                                    <div class="col-6"><input type="password" name="card_cvc" inputmode="numeric" autocomplete="cc-csc" placeholder="CVC" maxlength="4" data-card-field></div>
                                                </div>
                                                <p class="b3 mt--12 mb-0 rbt-text-color-gray-400"><i class="fa-regular fa-lock mr--4"></i> Card details are used once to take payment and are never stored.</p>
                                                <div id="bloom-card-error" class="mt--8" style="color:#d6336c;font-size:14px"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-check mb-lg-4">
                                        <input type="checkbox" class="form-check-input" id="accept-terms" name="terms" value="1">
                                        <label for="accept-terms" class="form-check-label nav align-items-center rbt-link-hover">I accept the <a class="nav-link ms-1 p-0" href="#!">Terms and Conditions</a></label>
                                        <?= $err('terms') ?>
                                    </div>
                                    <div class="text-center mt--12 rbt-btn-area d-block">
                                        <button type="submit" class="rbt-btn splash-btn icon-reverse-left rbt-rounded--4 d-block w-100" id="bloom-place-order">
                                            <span class="icon-left"><i class="fa-sharp fa-regular fa-arrow-right mr--4"></i></span>
                                            <span data-pay-label>Place order · <?= $m($cart['total']) ?></span>
                                            <span class="icon-right"><i class="fa-solid fa-money-bill-1-wave ml--4"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order summary -->
                <div class="col-12 col-lg-4 mt--24">
                    <div class="rbt-sidebar-cart sticky-top">
                        <div class="rbt-sidebar-widget">
                            <div class="rbt-inner">
                                <div class="rbt-title-part d-flex mb--12 justify-content-between align-items-center">
                                    <h3 class="title h5 mb--0 rbt-text-bold">Order summary</h3>
                                    <div class="rbt-link-hover"><a href="<?= site_url('cart') ?>">Edit</a></div>
                                </div>
                                <ul class="rbt-minicart-wrapper mb--16" style="max-height:300px;overflow:auto">
                                    <?php foreach ($cart['items'] as $i): ?>
                                    <li class="minicart-item">
                                        <div class="thumbnail"><img src="<?= esc($i['image'], 'attr') ?>" alt="<?= esc($i['name']) ?>"></div>
                                        <div class="product-content">
                                            <h3 class="title h6"><?= esc($i['name']) ?></h3>
                                            <span class="quantity"><?= (int) $i['qty'] ?>x <span class="price"><?= $m($i['price']) ?></span><?= $i['size'] ? ' <small style="color:#7b8794">· Size ' . esc($i['size']) . '</small>' : '' ?></span>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="rbt-cart-subttotal"><p>Subtotal (<?= (int) $cart['count'] ?> items)</p><p class="price"><?= $m($cart['subtotal']) ?></p></div>
                                <div class="rbt-cart-subttotal"><p>Delivery</p><p class="price"><?= $cart['shipping'] ? $m($cart['shipping']) : 'Free' ?></p></div>
                                <hr class="mb--8 mt--8 rbt-bg-color-gray-200">
                                <div class="rbt-cart-subttotal mb--12"><p class="subtotal"><strong>Total</strong></p><p class="price"><?= $m($cart['total']) ?></p></div>
                                <?php if ($cart['remaining'] > 0): ?>
                                <p class="b3 mb-0">Add <strong><?= $m($cart['remaining']) ?></strong> more for free delivery.</p>
                                <?php else: ?>
                                <p class="b3 mb-0">🎉 Free delivery applied.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->include('storefront/partials/footer') ?>
<?= $this->include('storefront/partials/auth_modal') ?>
<?= $this->include('storefront/partials/scripts') ?>
<script>
(function () {
  var form = document.getElementById('bloom-checkout-form');
  if (!form) return;
  var panels = form.querySelectorAll('.bloom-pay-panel');
  var label = form.querySelector('[data-pay-label]');
  var total = <?= json_encode($m($cart['total'])) ?>;
  var cardErr = document.getElementById('bloom-card-error');

  function sync() {
    var method = form.querySelector('input[name="payment"]:checked').value;
    panels.forEach(function (p) { p.style.display = p.getAttribute('data-pay') === method ? '' : 'none'; });
    label.textContent = (method === 'card' ? 'Pay ' : 'Place order · ') + total;
  }
  form.querySelectorAll('input[name="payment"]').forEach(function (r) { r.addEventListener('change', sync); });
  sync();

  var num = form.elements['card_number'], exp = form.elements['card_expiry'];
  num.addEventListener('input', function () { num.value = num.value.replace(/\D/g, '').slice(0, 19).replace(/(.{4})/g, '$1 ').trim(); });
  exp.addEventListener('input', function () {
    var v = exp.value.replace(/\D/g, '').slice(0, 4);
    exp.value = v.length > 2 ? v.slice(0, 2) + '/' + v.slice(2) : v;
  });

  function luhn(s) { var sum = 0, alt = false; for (var i = s.length - 1; i >= 0; i--) { var n = +s[i]; if (alt && (n *= 2) > 9) n -= 9; sum += n; alt = !alt; } return sum % 10 === 0; }

  form.addEventListener('submit', function (e) {
    var method = form.querySelector('input[name="payment"]:checked').value, msg = '';
    if (method === 'card') {
      var digits = num.value.replace(/\D/g, '');
      if (digits.length < 13 || !luhn(digits)) msg = 'That card number does not look valid.';
      else if (!form.elements['card_name'].value.trim()) msg = 'Enter the name on the card.';
      else if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(exp.value)) msg = 'Enter the expiry date as MM/YY.';
      else if (!/^\d{3,4}$/.test(form.elements['card_cvc'].value)) msg = 'Enter the 3 or 4 digit security code.';
    }
    cardErr.textContent = msg;
    if (msg) { e.preventDefault(); num.scrollIntoView({ behavior: 'smooth', block: 'center' }); return; }
    var btn = document.getElementById('bloom-place-order');
    btn.disabled = true; btn.style.opacity = '.7';
    label.textContent = 'Processing…';
  });
})();
</script>
