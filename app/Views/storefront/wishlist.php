<?= $this->include('storefront/partials/head') ?>
<?= $this->include('storefront/partials/header') ?>
<?= view('storefront/partials/breadcrumb', ['crumbs' => ['Wishlist' => null]]) ?>

<div class="rbt-component-area rbt-section-gap rbt-bg-color-gray-light">
    <div class="container">
        <div class="rbt-component-section-title rbt-gap--4 mb--0 p-0 border-0">
            <h2 class="rbt-title mb--0"><span class="rbt-text-bold">My Wishlist</span></h2>
        </div>
        <?php if (! session('customer_id')): ?>
        <p class="b2 mt--8">Your wishlist is saved on this device.
            <a href="#!" class="rbt-link-hover" data-bs-toggle="modal" data-bs-target="#authModal" data-auth-view="signin"><strong>Sign in</strong></a>
            to keep it on your account.</p>
        <?php endif; ?>
        <hr class="mt--16 mb--24">

        <div id="bloom-wishlist-empty" class="text-center ptb--40" style="display:none">
            <i class="fa-regular fa-heart" style="font-size:44px;color:#a8b6cb"></i>
            <h3 class="h6 mt--16">Your wishlist is empty</h3>
            <p class="b2">Tap the heart on any product to save it here.</p>
            <a href="<?= site_url('home') ?>" class="rbt-btn rbt-btn-sm mt--8">Continue shopping</a>
        </div>
        <div class="row row--12 mt_dec--24" id="bloom-wishlist-grid"></div>
    </div>
</div>

<?= $this->include('storefront/partials/footer') ?>
<?= $this->include('storefront/partials/auth_modal') ?>
<?= $this->include('storefront/partials/scripts') ?>
<script>
(function () {
  var grid = document.getElementById('bloom-wishlist-grid');
  var empty = document.getElementById('bloom-wishlist-empty');

  function el(tag, cls, text) { var n = document.createElement(tag); if (cls) n.className = cls; if (text) n.textContent = text; return n; }

  function render(items) {
    grid.innerHTML = '';
    empty.style.display = items.length ? 'none' : '';
    items.forEach(function (item) {
      var col = el('div', 'col-xl-3 col-lg-4 col-md-6 col-6 mt--24');
      var card = el('div', 'rbt-card rbt-product-card');
      var inner = el('div', 'inner');
      var imgWrap = el('div', 'rbt-card-img rbt-bg-color-default');
      var a = el('a'); a.href = item.url || '#';
      var img = el('img', 'rbt-prd-img'); img.src = item.image || ''; img.alt = item.name; a.appendChild(img);
      imgWrap.appendChild(a);
      var body = el('div', 'rbt-card-body');
      var title = el('h2', 'rbt-card-title h6');
      var ta = el('a', '', item.name); ta.href = item.url || '#'; title.appendChild(ta);
      body.appendChild(title);
      if (item.price) body.appendChild(el('div', 'rbt-price-wrapper', item.price));
      var rm = el('button', 'rbt-btn rbt-btn-sm rbt-btn-border mt--12', 'Remove');
      rm.type = 'button';
      rm.addEventListener('click', function () { BloomWishlist.remove(item.key); });
      body.appendChild(rm);
      inner.appendChild(imgWrap); inner.appendChild(body); card.appendChild(inner); col.appendChild(card); grid.appendChild(col);
    });
  }

  BloomWishlist.ready(render);
})();
</script>
