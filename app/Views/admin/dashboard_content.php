<?php
$cards = [
    ['Total customers', $stats['total'], 'users', 'All shoppers and registered accounts'],
    ['New this week', $stats['this_week'], 'user-plus', 'Registrations in the last 7 days'],
    ['Email verified', $stats['verified'], 'badge-check', 'Confirmed through OTP or Google'],
    ['Joined with Google', $stats['google'], 'mail', 'Signed up using Google'],
    ['Wishlist items', $stats['wishlists'], 'heart', 'Saved on customer accounts'],
    ['Orders', $stats['orders'], 'package', 'Placed through the storefront'],
];
?>
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <div>
    <h1 class="text-[24px] font-semibold text-ink-900">Welcome back, <?= esc($adminName) ?> 👋</h1>
    <p class="mt-1 text-[14px] text-ink-500">Here is how Bloom Kidswear is growing.</p>
  </div>
  <?php if (admin_can('customers.view')): ?>
  <a href="<?= site_url('admin/customers') ?>" class="inline-flex h-11 items-center gap-2 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white transition-colors hover:bg-brand-700">
    <i data-lucide="users" class="h-4 w-4"></i>
    View all registrations
  </a>
  <?php endif; ?>
</div>

<div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
  <?php foreach ($cards as [$label, $value, $icon, $hint]): ?>
  <section class="rounded-card border border-surface-line bg-surface-card p-5 shadow-card">
    <div class="flex items-center justify-between">
      <p class="text-[14px] font-semibold text-ink-500"><?= esc($label) ?></p>
      <span class="flex h-10 w-10 items-center justify-center rounded-base bg-brand-50 text-brand-600"><i data-lucide="<?= $icon ?>" class="h-5 w-5"></i></span>
    </div>
    <p class="mt-3 text-[32px] font-semibold leading-none text-ink-900"><?= number_format((int) $value) ?></p>
    <p class="mt-2 text-[13px] text-ink-400"><?= esc($hint) ?></p>
  </section>
  <?php endforeach; ?>
</div>

<?php if (admin_can('customers.view')): ?>
<section class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
  <div class="mb-4 flex items-center justify-between">
    <h2 class="text-[18px] font-semibold text-ink-900">Latest registrations</h2>
    <a href="<?= site_url('admin/customers') ?>" class="text-[13px] font-semibold text-brand-600">See all</a>
  </div>
  <div class="dashboard-scrollbar overflow-x-auto">
    <table class="w-full min-w-[640px] text-left">
      <thead>
        <tr class="border-b border-surface-line text-[13px] uppercase text-ink-400">
          <th class="pb-3 pr-4 font-semibold">Customer</th>
          <th class="pb-3 pr-4 font-semibold">Joined with</th>
          <th class="pb-3 pr-4 font-semibold">Verified</th>
          <th class="pb-3 font-semibold">Registered</th>
        </tr>
      </thead>
      <tbody class="text-[14px]">
        <?php if (! $recent): ?>
        <tr><td colspan="4" class="py-8 text-center text-ink-400">No registrations yet.</td></tr>
        <?php endif; ?>
        <?php foreach ($recent as $c): ?>
        <tr class="border-b border-surface-line last:border-0">
          <td class="py-3 pr-4">
            <p class="font-semibold text-ink-900"><?= esc($c['name']) ?></p>
            <p class="text-[13px] text-ink-400"><?= esc($c['email']) ?></p>
          </td>
          <td class="py-3 pr-4"><?= ($c['signup_method'] ?? 'email') === 'google' ? 'Google' : 'Email' ?></td>
          <td class="py-3 pr-4"><?= ! empty($c['email_verified_at']) ? 'Yes' : 'No' ?></td>
          <td class="py-3 text-ink-500"><?= esc(date('M d, Y H:i', strtotime($c['created_at']))) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
<?php endif; ?>
