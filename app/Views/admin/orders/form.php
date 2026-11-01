<?php
use App\Libraries\Cart;

$editing = (bool) $order;
$o       = static fn (string $k, $d = '') => old($k, $order[$k] ?? $d);
$inp     = 'mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600';
$sel     = 'mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700 focus:border-brand-600';
$lines   = [];
foreach ($items as $i) {
    $lines[] = ['item_id' => $i['id'], 'product_id' => $i['product_id'], 'name' => $i['name'], 'sku' => $i['sku'], 'image' => $i['image'], 'size' => $i['size'], 'qty' => (int) $i['qty'], 'unit_price' => (float) $i['unit_price']];
}
if ($posted = old('lines')) {
    $lines = [];
    foreach ($posted as $r) {
        $pr = $products ? (array_column($products, null, 'id')[(int) ($r['product_id'] ?? 0)] ?? null) : null;
        $lines[] = ['item_id' => $r['item_id'] ?? '', 'product_id' => $r['product_id'] ?: null, 'name' => $pr['name'] ?? ($r['name'] ?? 'Product'), 'sku' => $pr['sku'] ?? '', 'image' => $pr['image'] ?? '', 'size' => $r['size'] ?? '', 'qty' => (int) ($r['qty'] ?? 1), 'unit_price' => (float) ($r['unit_price'] ?? 0)];
    }
}
$byId = array_column($products, null, 'id');
foreach ($lines as &$l) {
    $l['sizes'] = $l['product_id'] && isset($byId[$l['product_id']]) ? array_values(array_filter(explode(',', $byId[$l['product_id']]['sizes']), 'strlen')) : ($l['size'] ? [$l['size']] : []);
}
unset($l);
$orderDate = $editing ? date('Y-m-d', strtotime($order['created_at'])) : date('Y-m-d');
?>
<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6">
  <nav class="mb-1 flex items-center gap-1.5 text-[13px] text-ink-400">
    <a href="<?= site_url('admin/dashboard') ?>" class="hover:text-brand-600">Home</a>
    <i data-lucide="chevron-right" class="h-3.5 w-3.5"></i>
    <a href="<?= site_url('admin/orders') ?>" class="hover:text-brand-600">Orders</a>
    <i data-lucide="chevron-right" class="h-3.5 w-3.5"></i>
    <span class="text-ink-700"><?= $editing ? 'Edit Order' : 'Add Order' ?></span>
  </nav>
  <h1 class="text-[24px] font-semibold text-ink-900"><?= $editing ? 'Edit Order' : 'Add Order' ?></h1>
  <?php if ($editing): ?><p class="mt-1 text-[14px] text-ink-500">Every save keeps the previous version in the order’s history, so nothing is lost.</p><?php endif; ?>
</div>

<form id="order-form" method="post" action="<?= $editing ? site_url('admin/orders/' . $order['id']) : site_url('admin/orders') ?>" class="grid gap-6 xl:grid-cols-[300px_minmax(0,1fr)]">
  <?= csrf_field() ?>

  <aside class="min-w-0 space-y-6">
    <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
      <h2 class="mb-5 text-[18px] font-semibold text-ink-900">Order Details</h2>
      <div class="mb-5">
        <p class="text-[13px] font-semibold text-ink-700">Order ID</p>
        <p class="mt-1 text-[15px] font-semibold text-ink-900"><?= $editing ? '#' . esc($order['order_number']) : 'Generated on save' ?></p>
      </div>
      <div class="space-y-5">
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Order Status <span class="text-danger-500">*</span></span>
          <select required name="status" class="<?= $sel ?>"><?php foreach ($statuses as $k => $label): ?><option value="<?= $k ?>" <?= $o('status', 'placed') === $k ? 'selected' : '' ?>><?= $label ?></option><?php endforeach; ?></select>
          <p class="mt-1 text-[12px] text-ink-400">Cancelling returns the items to stock.</p></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Payment Method <span class="text-danger-500">*</span></span>
          <select required name="payment_method" class="<?= $sel ?>"><?php foreach ($methods as $k => $label): ?><option value="<?= $k ?>" <?= $o('payment_method', 'cod') === $k ? 'selected' : '' ?>><?= $label ?></option><?php endforeach; ?></select></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Payment Status <span class="text-danger-500">*</span></span>
          <select required name="payment_status" class="<?= $sel ?>"><?php foreach ($payStates as $k => $label): ?><option value="<?= $k ?>" <?= $o('payment_status', 'pending') === $k ? 'selected' : '' ?>><?= $label ?></option><?php endforeach; ?></select></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Delivery Charge (PKR) <span class="text-danger-500">*</span></span>
          <input required type="number" min="0" step="1" name="shipping" id="f-shipping" value="<?= esc($o('shipping', ''), 'attr') ?>" class="<?= $inp ?>">
          <p class="mt-1 text-[12px] text-ink-400">Free from <?= Cart::money($freeOver) ?>, otherwise <?= Cart::money($flat) ?>. Edit to override.</p></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Order Date <span class="text-danger-500">*</span></span>
          <input required type="date" name="order_date" value="<?= esc(old('order_date', $orderDate), 'attr') ?>" class="<?= $inp ?>"></label>
      </div>
    </article>

    <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
      <h2 class="mb-5 text-[18px] font-semibold text-ink-900">Customer</h2>
      <div class="space-y-5">
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Full Name <span class="text-danger-500">*</span></span>
          <input required name="name" value="<?= esc($o('name'), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Email <span class="text-danger-500">*</span></span>
          <input required type="email" name="email" value="<?= esc($o('email'), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Phone <span class="text-danger-500">*</span></span>
          <input required type="tel" name="phone" value="<?= esc($o('phone'), 'attr') ?>" class="<?= $inp ?>"></label>
      </div>
    </article>
  </aside>

  <div class="min-w-0 space-y-6">
    <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
      <h2 class="text-[18px] font-semibold text-ink-900">Select Products</h2>
      <p class="mt-1 text-[14px] text-ink-700">Tick products to add them, then set size, quantity and price.</p>

      <div id="lines" class="mt-4 space-y-3"></div>
      <p id="lines-empty" class="mt-4 hidden rounded-base border border-dashed border-surface-line p-4 text-center text-[14px] text-ink-400">No products added yet.</p>
      <p class="mt-4 text-[15px] font-semibold text-ink-900">Total Cost: PKR <span id="f-total">0</span> <span class="text-[13px] font-normal text-ink-400">(items <span id="f-subtotal">0</span> + delivery)</span></p>

      <label class="relative mt-5 block">
        <span class="sr-only">Search products</span>
        <i data-lucide="search" class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-400"></i>
        <input id="product-search" type="search" placeholder="Search Products" class="h-11 w-full rounded-base border border-surface-line bg-surface-body pl-11 pr-4 text-[14px] focus:border-brand-600">
      </label>
      <div class="mt-4 dashboard-scrollbar max-h-[360px] overflow-y-auto pr-1" id="product-list">
        <div class="sticky top-0 flex items-center justify-between border-b border-surface-line bg-surface-card pb-2 text-[13px] uppercase text-ink-400"><span class="font-semibold">Product</span><span class="font-semibold">Qty Remaining</span></div>
        <?php foreach ($products as $p): ?>
        <label data-product-item data-name="<?= esc(strtolower($p['name'] . ' ' . $p['sku']), 'attr') ?>" class="flex cursor-pointer items-center gap-3 border-b border-surface-line py-3 last:border-b-0 hover:bg-surface-body/60">
          <input type="checkbox" data-pid="<?= (int) $p['id'] ?>" class="h-4 w-4 shrink-0 rounded border-surface-line text-brand-600 focus:ring-brand-600">
          <img src="<?= base_url($p['image']) ?>" alt="" class="h-11 w-11 shrink-0 rounded-base bg-surface-body object-cover">
          <div class="min-w-0 flex-1">
            <p class="font-semibold text-ink-900"><?= esc($p['name']) ?><?= $p['is_active'] ? '' : ' <span class="text-[12px] font-normal text-ink-400">(hidden)</span>' ?></p>
            <p class="text-[13px] text-ink-400">Price: <?= Cart::money($p['effective']) ?></p>
            <p class="text-[13px] text-ink-400">SKU: <?= esc($p['sku']) ?></p>
          </div>
          <span class="shrink-0 text-[14px] font-medium <?= (int) $p['stock'] < 1 ? 'text-danger-500' : 'text-ink-500' ?>"><?= (int) $p['stock'] ?></span>
        </label>
        <?php endforeach; ?>
      </div>
      <p id="product-empty" class="hidden py-8 text-center text-[14px] text-ink-400">No products match your search.</p>
    </article>

    <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
      <h2 class="text-[18px] font-semibold text-ink-900">Delivery Details</h2>
      <div class="mt-5 grid gap-5 sm:grid-cols-2">
        <label class="block sm:col-span-2"><span class="text-[13px] font-semibold text-ink-700">Address <span class="text-danger-500">*</span></span>
          <input required name="address" value="<?= esc($o('address'), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">City <span class="text-danger-500">*</span></span>
          <input required name="city" value="<?= esc($o('city'), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Province <span class="text-danger-500">*</span></span>
          <select required name="province" class="<?= $sel ?>"><option value="">Select province</option><?php foreach ($provinces as $p): ?><option value="<?= esc($p, 'attr') ?>" <?= $o('province') === $p ? 'selected' : '' ?>><?= esc($p) ?></option><?php endforeach; ?></select></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Postal code</span>
          <input name="postal_code" value="<?= esc($o('postal_code'), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Courier</span>
          <input name="carrier" value="<?= esc($o('carrier'), 'attr') ?>" placeholder="e.g. TCS, Leopards" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Tracking number</span>
          <input name="tracking_number" value="<?= esc($o('tracking_number'), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block sm:col-span-2"><span class="text-[13px] font-semibold text-ink-700">Order notes</span>
          <textarea name="notes" rows="3" class="mt-1.5 w-full resize-y rounded-base border border-surface-line bg-surface-body px-3 py-3 text-[14px] focus:border-brand-600"><?= esc($o('notes')) ?></textarea></label>
      </div>
    </article>
  </div>
</form>

<div class="mt-8 flex items-center justify-end gap-3 border-t border-surface-line pt-5">
  <a href="<?= $editing ? site_url('admin/orders/' . $order['id']) : site_url('admin/orders') ?>" class="inline-flex h-11 items-center gap-2 rounded-base border border-surface-line px-5 text-[14px] font-semibold text-ink-700 hover:bg-surface-muted">Cancel</a>
  <button type="submit" form="order-form" class="inline-flex h-11 items-center gap-2 rounded-base bg-brand-600 px-5 text-[14px] font-semibold text-white hover:bg-brand-700">
    <i data-lucide="save" class="h-4 w-4"></i> <?= $editing ? 'Save Changes' : 'Create Order' ?>
  </button>
</div>

<script>
(function () {
  var PRODUCTS = <?= json_encode(array_column($products, null, 'id'), JSON_HEX_TAG | JSON_HEX_AMP) ?>;
  var BASE = <?= json_encode(base_url('/')) ?>;
  var FREE_OVER = <?= (int) $freeOver ?>, FLAT = <?= (int) $flat ?>;
  var initial = <?= json_encode($lines, JSON_HEX_TAG | JSON_HEX_AMP) ?>;
  var wrap = document.getElementById('lines'), empty = document.getElementById('lines-empty');
  var shipEl = document.getElementById('f-shipping'), idx = 0;
  var autoShip = shipEl.value === '';
  var fmt = function (n) { return Math.round(n).toLocaleString('en-US'); };
  var esc = function (s) { var d = document.createElement('div'); d.textContent = s == null ? '' : s; return d.innerHTML; };

  function addLine(l) {
    var n = idx++, p = l.product_id ? PRODUCTS[l.product_id] : null;
    var sizes = l.sizes || (p ? p.sizes.split(',').filter(Boolean) : []);
    var row = document.createElement('div');
    row.className = 'rounded-base border border-surface-line bg-surface-body p-3';
    row.setAttribute('data-line', ''); row.setAttribute('data-pid', l.product_id || '');
    var img = l.image ? '<img src="' + BASE + esc(l.image) + '" alt="" class="h-11 w-11 shrink-0 rounded-base bg-surface-card object-cover">' : '';
    var sizeSel = sizes.length
      ? '<select name="lines[' + n + '][size]" class="h-10 rounded-base border border-surface-line bg-surface-card px-2 text-[14px]">' + sizes.map(function (s) { return '<option' + (s === l.size ? ' selected' : '') + '>' + esc(s) + '</option>'; }).join('') + '</select>'
      : '<input type="hidden" name="lines[' + n + '][size]" value="' + esc(l.size || '') + '">';
    row.innerHTML =
      '<input type="hidden" name="lines[' + n + '][item_id]" value="' + (l.item_id || '') + '">' +
      '<input type="hidden" name="lines[' + n + '][product_id]" value="' + (l.product_id || '') + '">' +
      '<div class="flex flex-wrap items-center gap-3">' + img +
      '<div class="min-w-0 flex-1" style="min-width:150px"><p class="font-semibold text-ink-900">' + esc(l.name) + '</p><p class="text-[13px] text-ink-400">SKU: ' + esc(l.sku || '—') + '</p></div>' +
      sizeSel +
      '<label class="text-[12px] text-ink-400">Qty<input type="number" min="1" name="lines[' + n + '][qty]" value="' + l.qty + '" class="ml-1 h-10 w-20 rounded-base border border-surface-line bg-surface-card px-2 text-[14px]" data-qty></label>' +
      '<label class="text-[12px] text-ink-400">Price<input type="number" min="0" step="1" name="lines[' + n + '][unit_price]" value="' + Math.round(l.unit_price) + '" class="ml-1 h-10 w-28 rounded-base border border-surface-line bg-surface-card px-2 text-[14px]" data-price></label>' +
      '<button type="button" data-dup title="Add another size of this product" class="text-[13px] font-semibold text-brand-600">+ size</button>' +
      '<button type="button" data-del title="Remove" class="text-[13px] font-semibold text-danger-500">Remove</button></div>';
    wrap.appendChild(row);
    sync();
  }

  function sync() {
    var sub = 0, rows = wrap.querySelectorAll('[data-line]');
    rows.forEach(function (r) {
      sub += (parseFloat(r.querySelector('[data-price]').value) || 0) * (parseInt(r.querySelector('[data-qty]').value, 10) || 0);
    });
    empty.classList.toggle('hidden', rows.length > 0);
    if (autoShip) shipEl.value = rows.length ? (sub >= FREE_OVER ? 0 : FLAT) : '';
    document.getElementById('f-subtotal').textContent = fmt(sub);
    document.getElementById('f-total').textContent = fmt(sub + (parseFloat(shipEl.value) || 0));
    var have = {};
    rows.forEach(function (r) { have[r.getAttribute('data-pid')] = true; });
    document.querySelectorAll('#product-list input[data-pid]').forEach(function (c) { c.checked = !!have[c.getAttribute('data-pid')]; });
  }

  document.querySelectorAll('#product-list input[data-pid]').forEach(function (c) {
    c.addEventListener('change', function () {
      var pid = c.getAttribute('data-pid');
      if (c.checked) {
        var p = PRODUCTS[pid];
        addLine({ product_id: p.id, name: p.name, sku: p.sku, image: p.image, size: '', qty: 1, unit_price: p.effective, sizes: p.sizes.split(',').filter(Boolean) });
      } else {
        wrap.querySelectorAll('[data-line][data-pid="' + pid + '"]').forEach(function (r) { r.remove(); });
        sync();
      }
    });
  });
  wrap.addEventListener('input', sync);
  wrap.addEventListener('click', function (e) {
    var row = e.target.closest('[data-line]');
    if (!row) return;
    if (e.target.closest('[data-del]')) { row.remove(); sync(); }
    if (e.target.closest('[data-dup]')) {
      var pid = row.getAttribute('data-pid'), p = pid ? PRODUCTS[pid] : null;
      addLine({ product_id: pid || null, name: row.querySelector('.font-semibold').textContent, sku: p ? p.sku : '', image: p ? p.image : '', size: '', qty: 1, unit_price: parseFloat(row.querySelector('[data-price]').value) || 0, sizes: p ? p.sizes.split(',').filter(Boolean) : [] });
    }
  });
  shipEl.addEventListener('input', function () { autoShip = false; sync(); });

  document.getElementById('product-search').addEventListener('input', function () {
    var q = this.value.trim().toLowerCase(), shown = 0;
    document.querySelectorAll('[data-product-item]').forEach(function (el) {
      var ok = !q || el.getAttribute('data-name').indexOf(q) !== -1;
      el.style.display = ok ? '' : 'none'; if (ok) shown++;
    });
    document.getElementById('product-empty').classList.toggle('hidden', shown > 0);
  });

  initial.forEach(addLine);
  sync();
})();
</script>
<?= $this->endSection() ?>
