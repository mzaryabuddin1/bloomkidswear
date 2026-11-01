<?php
use App\Libraries\Cart;

$card   = $order['payment_method'] === 'card';
$method = $methods[$order['payment_method']] ?? ucfirst($order['payment_method']);
$method .= $card && $order['card_brand'] ? ' · ' . $order['card_brand'] . ' ••' . $order['card_last4'] : '';
$badge  = static fn (string $s) => match ($s) {
    'delivered'  => 'bg-success-50 text-success-700',
    'cancelled'  => 'bg-danger-50 text-danger-500',
    'shipped'    => 'bg-brand-50 text-brand-700',
    'processing' => 'bg-warning-50 text-warning-600',
    default      => 'bg-surface-muted text-ink-700',
};
$canEdit = admin_can('orders.manage');
$tab     = old('tab') ?: 'summary';
?>
<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <div>
    <nav class="mb-2 flex items-center gap-1.5 text-[13px] text-ink-400">
      <a href="<?= site_url('admin/dashboard') ?>" class="hover:text-brand-600">Home</a>
      <i data-lucide="chevron-right" class="h-3.5 w-3.5"></i>
      <a href="<?= site_url('admin/orders') ?>" class="hover:text-brand-600">Orders</a>
      <i data-lucide="chevron-right" class="h-3.5 w-3.5"></i>
      <span class="text-ink-700">Order Details</span>
    </nav>
    <div class="flex items-center gap-6">
      <button type="button" data-tab="summary" class="pb-1 text-[15px] font-semibold border-b-2 border-brand-600 text-brand-600">Order Summary</button>
      <button type="button" data-tab="history" class="pb-1 text-[15px] font-medium border-b-2 border-transparent text-ink-500 hover:text-ink-900">Order History <span class="ml-1 rounded-full bg-surface-muted px-2 py-0.5 text-[12px]"><?= count($history) ?></span></button>
    </div>
  </div>
  <div class="flex items-center gap-2">
    <a href="<?= site_url('admin/orders') ?>" class="grid h-11 w-11 place-items-center rounded-base border border-surface-line text-ink-700 hover:bg-surface-muted" aria-label="Back to orders"><i data-lucide="arrow-left" class="h-4 w-4"></i></a>
    <?php if ($canEdit && $order['status'] !== 'cancelled'): ?>
    <a href="<?= site_url('admin/orders/' . $order['id'] . '/edit') ?>" class="inline-flex h-11 items-center gap-2 rounded-base bg-success-600 px-4 text-[14px] font-semibold text-white hover:bg-success-700"><i data-lucide="pencil" class="h-4 w-4"></i> Edit Order</a>
    <?php endif; ?>
    <?php if ($canEdit): ?>
    <a href="<?= site_url('admin/orders/create') ?>" class="inline-flex h-11 items-center gap-2 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700"><i data-lucide="plus" class="h-4 w-4"></i> Add New Order</a>
    <?php endif; ?>
  </div>
</div>

<!-- ============ SUMMARY TAB ============ -->
<div data-panel="summary">
  <section class="grid gap-6 lg:grid-cols-3">
    <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
      <h2 class="mb-4 text-[18px] font-semibold text-ink-900">Order Details (#<?= esc($order['order_number']) ?>)</h2>
      <dl class="space-y-3 text-[14px]">
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="calendar" class="h-4 w-4 text-ink-400"></i> Date Added</dt><dd class="font-medium text-ink-900"><?= esc(date('d/m/Y', strtotime($order['created_at']))) ?></dd></div>
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="credit-card" class="h-4 w-4 text-ink-400"></i> Payment Method</dt><dd class="font-medium text-ink-900"><?= esc($method) ?></dd></div>
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="badge-check" class="h-4 w-4 text-ink-400"></i> Payment Status</dt><dd class="font-medium <?= $order['payment_status'] === 'paid' ? 'text-success-700' : 'text-warning-600' ?>"><?= esc(ucfirst($order['payment_status'])) ?></dd></div>
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="truck" class="h-4 w-4 text-ink-400"></i> Delivery</dt><dd class="font-medium text-ink-900"><?= (float) $order['shipping'] ? 'Flat rate' : 'Free delivery' ?></dd></div>
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="activity" class="h-4 w-4 text-ink-400"></i> Status</dt><dd><span class="badge <?= $badge($order['status']) ?>"><?= esc(ucfirst($order['status'])) ?></span></dd></div>
      </dl>
    </article>

    <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
      <h2 class="mb-4 text-[18px] font-semibold text-ink-900">Customer Details</h2>
      <dl class="space-y-3 text-[14px]">
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="user" class="h-4 w-4 text-ink-400"></i> Customer</dt><dd class="font-medium text-ink-900"><?= esc($order['name'] ?: '—') ?></dd></div>
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="mail" class="h-4 w-4 text-ink-400"></i> Email</dt><dd class="font-medium text-ink-900"><?= esc($order['email']) ?></dd></div>
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="phone" class="h-4 w-4 text-ink-400"></i> Phone</dt><dd class="font-medium text-ink-900"><?= esc($order['phone'] ?: '—') ?></dd></div>
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="user-check" class="h-4 w-4 text-ink-400"></i> Account</dt><dd class="font-medium text-ink-900"><?= $order['customer_id'] ? 'Registered' : 'Guest checkout' ?></dd></div>
      </dl>
    </article>

    <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
      <h2 class="mb-4 text-[18px] font-semibold text-ink-900">Documents</h2>
      <dl class="space-y-3 text-[14px]">
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="file-text" class="h-4 w-4 text-ink-400"></i> Invoice</dt><dd class="font-medium text-brand-600">#INV-<?= esc(str_pad((string) $order['id'], 6, '0', STR_PAD_LEFT)) ?></dd></div>
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="package" class="h-4 w-4 text-ink-400"></i> Shipping</dt><dd class="font-medium text-ink-900"><?= $order['tracking_number'] ? esc(($order['carrier'] ? $order['carrier'] . ' · ' : '') . $order['tracking_number']) : 'Not shipped yet' ?></dd></div>
        <div class="flex items-center justify-between gap-3"><dt class="flex items-center gap-2 text-ink-500"><i data-lucide="gift" class="h-4 w-4 text-ink-400"></i> Items</dt><dd class="font-medium text-ink-900"><?= (int) $order['items_count'] ?></dd></div>
      </dl>
    </article>
  </section>

  <section class="mt-6 grid gap-6 lg:grid-cols-2">
    <article class="relative overflow-hidden rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
      <i data-lucide="credit-card" class="pointer-events-none absolute right-2 bottom-2 h-28 w-28 text-surface-line/70"></i>
      <h2 class="mb-3 text-[18px] font-semibold text-ink-900">Billing &amp; Payment</h2>
      <address class="text-[14px] not-italic leading-relaxed text-ink-600">
        <?= esc($order['name']) ?><br><?= esc($method) ?><br>
        <?php if ($order['payment_ref']): ?>Ref <?= esc($order['payment_ref']) ?><br><?php endif; ?>
        <?php if ($order['payment_method'] === 'cod' && $order['payment_status'] !== 'paid'): ?>Collect <strong><?= Cart::money($order['total']) ?></strong> on delivery.<?php endif; ?>
      </address>
    </article>
    <article class="relative overflow-hidden rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
      <i data-lucide="truck" class="pointer-events-none absolute right-2 bottom-2 h-28 w-28 text-surface-line/70"></i>
      <h2 class="mb-3 text-[18px] font-semibold text-ink-900">Shipping Address</h2>
      <address class="text-[14px] not-italic leading-relaxed text-ink-600">
        <?= esc($order['address']) ?>,<br><?= esc($order['city']) ?><?= $order['postal_code'] ? ' ' . esc($order['postal_code']) : '' ?>,<br><?= esc($order['province']) ?>, Pakistan.
      </address>
      <?php if ($order['notes']): ?><p class="mt-3 rounded-base bg-surface-muted p-3 text-[13px] text-ink-700"><strong>Note:</strong> <?= esc($order['notes']) ?></p><?php endif; ?>
    </article>
  </section>

  <section class="mt-6 rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
    <h2 class="mb-5 text-[18px] font-semibold text-ink-900">Order #<?= esc($order['order_number']) ?></h2>
    <div class="dashboard-scrollbar overflow-x-auto">
      <table class="w-full min-w-[680px] text-left">
        <thead><tr class="border-b border-surface-line text-[13px] uppercase text-ink-400"><th class="pb-3 pr-4 font-semibold">Product</th><th class="pb-3 pr-4 font-semibold">SKU</th><th class="pb-3 pr-4 text-right font-semibold">Qty</th><th class="pb-3 pr-4 text-right font-semibold">Unit Price</th><th class="pb-3 text-right font-semibold">Total</th></tr></thead>
        <tbody class="text-[14px]">
          <?php foreach ($items as $i): ?>
          <tr class="border-b border-surface-line">
            <td class="py-4 pr-4"><div class="flex items-center gap-3">
              <?php if ($i['image']): ?><img src="<?= base_url($i['image']) ?>" alt="" class="h-11 w-11 rounded-base bg-surface-body object-cover"><?php endif; ?>
              <div><p class="font-semibold text-ink-900"><?= esc($i['name']) ?></p><p class="mt-0.5 text-[13px] text-ink-400"><?= $i['size'] ? 'Size ' . esc($i['size']) : '' ?><?= $i['color'] ? ' · ' . esc(ucfirst($i['color'])) : '' ?></p></div>
            </div></td>
            <td class="py-4 pr-4 text-ink-700"><?= esc($i['sku'] ?: '—') ?></td>
            <td class="py-4 pr-4 text-right text-ink-700"><?= (int) $i['qty'] ?></td>
            <td class="py-4 pr-4 text-right text-ink-700"><?= Cart::money($i['unit_price']) ?></td>
            <td class="py-4 text-right font-semibold text-ink-900"><?= Cart::money($i['line_total']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="mt-5 flex justify-end">
      <dl class="w-full max-w-xs space-y-3 text-[14px]">
        <div class="flex items-center justify-between"><dt class="text-ink-500">Subtotal</dt><dd class="font-medium text-ink-900"><?= Cart::money($order['subtotal']) ?></dd></div>
        <div class="flex items-center justify-between"><dt class="text-ink-500">Delivery Charge</dt><dd class="font-medium text-ink-900"><?= (float) $order['shipping'] ? Cart::money($order['shipping']) : 'Free' ?></dd></div>
        <div class="flex items-center justify-between border-t border-surface-line pt-3"><dt class="text-[15px] font-semibold text-ink-900">Grand Total</dt><dd class="text-[18px] font-semibold text-ink-900"><?= Cart::money($order['total']) ?></dd></div>
      </dl>
    </div>
  </section>

  <?php if ($canEdit): ?>
  <form method="post" action="<?= site_url('admin/orders/' . $order['id'] . '/status') ?>" class="mt-6 rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
    <?= csrf_field() ?>
    <h2 class="mb-4 text-[18px] font-semibold text-ink-900">Quick status update</h2>
    <div class="grid gap-4 md:grid-cols-4">
      <label class="block"><span class="text-[13px] font-semibold text-ink-700">Status</span>
        <select name="status" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700"><?php foreach ($statuses as $k => $label): ?><option value="<?= $k ?>" <?= $order['status'] === $k ? 'selected' : '' ?>><?= $label ?></option><?php endforeach; ?></select></label>
      <label class="block"><span class="text-[13px] font-semibold text-ink-700">Courier</span>
        <input name="carrier" value="<?= esc($order['carrier'] ?? '', 'attr') ?>" placeholder="e.g. TCS" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px]"></label>
      <label class="block"><span class="text-[13px] font-semibold text-ink-700">Tracking number</span>
        <input name="tracking_number" value="<?= esc($order['tracking_number'] ?? '', 'attr') ?>" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px]"></label>
      <div class="flex items-end"><button type="submit" class="h-11 w-full rounded-base bg-brand-600 text-[14px] font-semibold text-white hover:bg-brand-700">Update</button></div>
    </div>
    <p class="mt-2 text-[12px] text-ink-400">Delivered marks cash-on-delivery orders paid. Cancelling returns items to stock. Every change is saved in the order history.</p>
  </form>
  <?php endif; ?>
</div>

<!-- ============ HISTORY TAB ============ -->
<div data-panel="history" class="hidden">
  <section class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
    <h2 class="mb-1 text-[18px] font-semibold text-ink-900">Change History</h2>
    <p class="mb-6 text-[14px] text-ink-500">Every edit is recorded with who made it, what changed, and the complete previous version of the order.</p>

    <?php if (! $history): ?>
    <p class="py-6 text-center text-[14px] text-ink-400">No history recorded for this order yet.</p>
    <?php endif; ?>

    <ol class="relative space-y-6 border-l border-surface-line pl-6">
      <?php foreach ($history as $h):
          $changes = json_decode($h['changes_json'] ?? '[]', true) ?: [];
          $before  = $h['before_json'] ? json_decode($h['before_json'], true) : null; ?>
      <li class="relative">
        <span class="absolute -left-[31px] top-1 grid h-4 w-4 place-items-center rounded-full border-2 border-surface-card <?= $h['action'] === 'created' ? 'bg-success-600' : ($h['action'] === 'status' ? 'bg-warning-600' : 'bg-brand-600') ?>"></span>
        <div class="flex flex-wrap items-baseline justify-between gap-2">
          <p class="text-[15px] font-semibold text-ink-900"><?= esc($h['summary']) ?></p>
          <p class="text-[13px] text-ink-400"><?= esc(date('d M Y, H:i', strtotime($h['created_at']))) ?> · <?= esc($h['admin_name'] ?: 'System') ?></p>
        </div>

        <?php if ($changes): ?>
        <div class="mt-2 overflow-hidden rounded-base border border-surface-line">
          <table class="w-full text-left text-[13px]">
            <thead class="bg-surface-body text-ink-400"><tr><th class="px-3 py-2 font-semibold">What</th><th class="px-3 py-2 font-semibold">Previous</th><th class="px-3 py-2 font-semibold">New</th></tr></thead>
            <tbody>
              <?php foreach ($changes as $c): ?>
              <tr class="border-t border-surface-line">
                <td class="px-3 py-2 font-medium text-ink-700"><?= esc($c['label']) ?></td>
                <td class="px-3 py-2 text-ink-500"><?= $c['old'] !== null ? '<span class="line-through decoration-danger-500/50">' . esc($c['old']) . '</span>' : '—' ?></td>
                <td class="px-3 py-2 font-medium text-ink-900"><?= $c['new'] !== null ? esc($c['new']) : '—' ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php endif; ?>

        <?php if ($before): ?>
        <details class="mt-2 text-[13px]">
          <summary class="cursor-pointer font-semibold text-brand-600">View the full previous version</summary>
          <div class="mt-2 rounded-base bg-surface-body p-4 text-ink-700">
            <p><strong>Status:</strong> <?= esc(ucfirst($before['status'])) ?> · <strong>Payment:</strong> <?= esc($methods[$before['payment_method']] ?? $before['payment_method']) ?> (<?= esc($before['payment_status']) ?>)</p>
            <p class="mt-1"><strong>Customer:</strong> <?= esc($before['name']) ?> · <?= esc($before['email']) ?> · <?= esc($before['phone']) ?></p>
            <p class="mt-1"><strong>Address:</strong> <?= esc($before['address']) ?>, <?= esc($before['city']) ?>, <?= esc($before['province']) ?> <?= esc($before['postal_code']) ?></p>
            <p class="mt-1"><strong>Courier / tracking:</strong> <?= esc(($before['carrier'] ?: '—') . ' / ' . ($before['tracking_number'] ?: '—')) ?></p>
            <?php if (! empty($before['notes'])): ?><p class="mt-1"><strong>Notes:</strong> <?= esc($before['notes']) ?></p><?php endif; ?>
            <ul class="mt-2 list-disc pl-5">
              <?php foreach ($before['items'] as $it): ?><li><?= esc($it['name']) ?><?= $it['size'] ? ' (' . esc($it['size']) . ')' : '' ?> — <?= (int) $it['qty'] ?> × <?= Cart::money($it['unit_price']) ?> = <?= Cart::money($it['line_total']) ?></li><?php endforeach; ?>
            </ul>
            <p class="mt-2"><strong>Subtotal</strong> <?= Cart::money($before['subtotal']) ?> + <strong>Delivery</strong> <?= Cart::money($before['shipping']) ?> = <strong><?= Cart::money($before['total']) ?></strong></p>
          </div>
        </details>
        <?php endif; ?>
      </li>
      <?php endforeach; ?>
    </ol>
  </section>
</div>

<script>
(function () {
  var tabs = document.querySelectorAll('[data-tab]'), panels = document.querySelectorAll('[data-panel]');
  function show(name) {
    panels.forEach(function (p) { p.classList.toggle('hidden', p.getAttribute('data-panel') !== name); });
    tabs.forEach(function (t) {
      var on = t.getAttribute('data-tab') === name;
      t.classList.toggle('border-brand-600', on); t.classList.toggle('text-brand-600', on); t.classList.toggle('font-semibold', on);
      t.classList.toggle('border-transparent', !on); t.classList.toggle('text-ink-500', !on); t.classList.toggle('font-medium', !on);
    });
    try { history.replaceState(null, '', location.pathname + (name === 'history' ? '#history' : '')); } catch (e) {}
  }
  tabs.forEach(function (t) { t.addEventListener('click', function () { show(t.getAttribute('data-tab')); }); });
  show(location.hash === '#history' ? 'history' : 'summary');
})();
</script>
<?= $this->endSection() ?>
