<?php
use App\Libraries\Cart;

$badge = static fn (string $s) => match ($s) {
    'delivered'  => 'bg-success-50 text-success-700',
    'cancelled'  => 'bg-danger-50 text-danger-500',
    'shipped'    => 'bg-brand-50 text-brand-700',
    'processing' => 'bg-warning-50 text-warning-600',
    default      => 'bg-surface-muted text-ink-700',
};
$qs = static fn (array $o = []) => '?' . http_build_query(array_filter(array_merge(['status' => $status, 'payment' => $payment, 'q' => $q], $o), static fn ($v) => $v !== '' && $v !== null));
?>
<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6 flex flex-wrap items-center justify-between gap-3"><div>
  <p class="mb-1 text-[13px] font-semibold uppercase text-brand-600">Sales</p>
  <h1 class="text-[24px] font-semibold text-ink-900">Orders</h1>
  <p class="mt-1 text-[14px] text-ink-500">Every order placed on the storefront or added by your team.</p>
</div>
  <?php if (admin_can('orders.manage')): ?>
  <a href="<?= site_url('admin/orders/create') ?>" class="inline-flex h-11 items-center gap-2 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700"><i data-lucide="plus" class="h-4 w-4"></i> Add Order</a>
  <?php endif; ?>
</div>

<div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
  <?php foreach ([['All orders', array_sum($counts), ''], ['Placed', $counts['placed'] ?? 0, 'placed'], ['Processing', $counts['processing'] ?? 0, 'processing'], ['Shipped', $counts['shipped'] ?? 0, 'shipped'], ['Delivered', $counts['delivered'] ?? 0, 'delivered']] as [$label, $n, $key]): ?>
  <a href="<?= site_url('admin/orders') . ($key ? '?status=' . $key : '') ?>" class="rounded-card border bg-surface-card p-4 shadow-card <?= $status === $key ? 'border-brand-600' : 'border-surface-line' ?>">
    <p class="text-[13px] text-ink-500"><?= $label ?></p>
    <p class="mt-1 text-[24px] font-semibold text-ink-900"><?= (int) $n ?></p>
  </a>
  <?php endforeach; ?>
</div>
<p class="mb-4 text-[14px] text-ink-500">Revenue (excluding cancelled): <strong class="text-ink-900"><?= Cart::money($revenue) ?></strong></p>

<section class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
  <form method="get" class="mb-4 flex flex-wrap gap-2">
    <input type="search" name="q" value="<?= esc($q) ?>" placeholder="Order no., name, email or phone" class="h-11 w-full max-w-xs rounded-base border border-surface-line bg-surface-card px-4 text-[14px] text-ink-900">
    <select name="status" class="h-11 rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700">
      <option value="">All statuses</option>
      <?php foreach ($statuses as $k => $label): ?><option value="<?= $k ?>" <?= $status === $k ? 'selected' : '' ?>><?= $label ?></option><?php endforeach; ?>
    </select>
    <select name="payment" class="h-11 rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700">
      <option value="">All payments</option>
      <?php foreach ($methods as $k => $label): ?><option value="<?= $k ?>" <?= $payment === $k ? 'selected' : '' ?>><?= $label ?></option><?php endforeach; ?>
    </select>
    <button type="submit" class="h-11 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700">Filter</button>
  </form>

  <div class="dashboard-scrollbar overflow-x-auto">
    <table class="w-full min-w-[900px] text-left">
      <thead>
        <tr class="border-b border-surface-line text-[13px] uppercase text-ink-400">
          <th class="pb-3 pr-4 font-semibold">Order</th>
          <th class="pb-3 pr-4 font-semibold">Date</th>
          <th class="pb-3 pr-4 font-semibold">Customer</th>
          <th class="pb-3 pr-4 font-semibold">Items</th>
          <th class="pb-3 pr-4 font-semibold">Payment</th>
          <th class="pb-3 pr-4 font-semibold">Total</th>
          <th class="pb-3 pr-4 font-semibold">Status</th>
          <th class="pb-3 text-right font-semibold">Action</th>
        </tr>
      </thead>
      <tbody class="text-[14px]">
        <?php if (! $orders): ?><tr><td colspan="8" class="py-8 text-center text-ink-400">No orders found.</td></tr><?php endif; ?>
        <?php foreach ($orders as $o): ?>
        <tr class="border-b border-surface-line last:border-0">
          <td class="py-4 pr-4 font-semibold text-ink-900">#<?= esc($o['order_number']) ?></td>
          <td class="py-4 pr-4 text-ink-500"><?= esc(date('M d, Y H:i', strtotime($o['created_at']))) ?></td>
          <td class="py-4 pr-4"><p class="font-semibold text-ink-900"><?= esc($o['name'] ?: '—') ?></p><p class="text-[13px] text-ink-400"><?= esc($o['email']) ?></p></td>
          <td class="py-4 pr-4 text-ink-700"><?= (int) $o['items_count'] ?></td>
          <td class="py-4 pr-4 text-ink-700"><?= esc($methods[$o['payment_method']] ?? $o['payment_method']) ?><?= $o['card_last4'] ? ' ••' . esc($o['card_last4']) : '' ?><br><span class="text-[13px] <?= $o['payment_status'] === 'paid' ? 'text-success-700' : 'text-ink-400' ?>"><?= esc(ucfirst($o['payment_status'])) ?></span></td>
          <td class="py-4 pr-4 font-semibold text-ink-900"><?= Cart::money($o['total']) ?></td>
          <td class="py-4 pr-4"><span class="badge <?= $badge($o['status']) ?>"><?= esc(ucfirst($o['status'])) ?></span></td>
          <td class="py-4 text-right whitespace-nowrap">
            <a href="<?= site_url('admin/orders/' . $o['id']) ?>" class="text-[13px] font-semibold text-brand-600">View</a>
            <?php if (admin_can('orders.manage') && $o['status'] !== 'cancelled'): ?><a href="<?= site_url('admin/orders/' . $o['id'] . '/edit') ?>" class="ml-3 text-[13px] font-semibold text-success-700">Edit</a><?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php if ($pages > 1): ?>
  <div class="mt-5 flex flex-wrap items-center gap-2 text-[14px]">
    <?php for ($n = 1; $n <= $pages; $n++): ?>
    <a href="<?= $qs(['page' => $n > 1 ? $n : null]) ?>" class="rounded-base border px-3 py-1.5 <?= $n === $page ? 'border-brand-600 bg-brand-600 text-white' : 'border-surface-line text-ink-700' ?>"><?= $n ?></a>
    <?php endfor; ?>
    <span class="ml-2 text-ink-400"><?= (int) $total ?> orders</span>
  </div>
  <?php endif; ?>
</section>
<?= $this->endSection() ?>
