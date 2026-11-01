<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <div>
    <p class="mb-1 text-[13px] font-semibold uppercase text-brand-600">Storefront</p>
    <h1 class="text-[24px] font-semibold text-ink-900">Customers &amp; Registrations</h1>
    <p class="mt-1 text-[14px] text-ink-500"><?= count($customers) ?> account<?= count($customers) === 1 ? '' : 's' ?> &middot; sign-ups from the storefront appear here.</p>
  </div>
  <?php if (admin_can('customers.manage')): ?>
  <a href="<?= site_url('admin/customers/create') ?>" class="inline-flex h-11 items-center gap-2 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700">
    <i data-lucide="plus" class="h-4 w-4"></i>
    Add Customer
  </a>
  <?php endif; ?>
</div>

<section class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
  <form method="get" class="mb-4 flex gap-2">
    <input type="search" name="q" value="<?= esc($q ?? '') ?>" placeholder="Search name, email or phone" class="h-11 w-full max-w-sm rounded-base border border-surface-line bg-surface-card px-4 text-[14px] text-ink-900">
    <button type="submit" class="h-11 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700">Search</button>
  </form>
  <div class="dashboard-scrollbar overflow-x-auto">
    <table class="w-full min-w-[1000px] text-left">
      <thead>
        <tr class="border-b border-surface-line text-[13px] uppercase text-ink-400">
          <th class="pb-3 pr-4 font-semibold">Customer</th>
          <th class="pb-3 pr-4 font-semibold">Phone</th>
          <th class="pb-3 pr-4 font-semibold">Location</th>
          <th class="pb-3 pr-4 font-semibold">Joined with</th>
          <th class="pb-3 pr-4 font-semibold">Verified</th>
          <th class="pb-3 pr-4 font-semibold">Registered</th>
          <th class="pb-3 pr-4 font-semibold">Type</th>
          <th class="pb-3 pr-4 font-semibold">Status</th>
          <th class="pb-3 text-right font-semibold">Action</th>
        </tr>
      </thead>
      <tbody class="text-[14px]">
        <?php if (! $customers): ?>
        <tr><td colspan="9" class="py-8 text-center text-ink-400">No customers found.</td></tr>
        <?php endif; ?>
        <?php foreach ($customers as $customer): ?>
        <?php $place = trim(($customer['city'] ?? '') . ' ' . ($customer['country'] ?? '')); ?>
        <tr class="border-b border-surface-line last:border-0">
          <td class="py-4 pr-4">
            <p class="font-semibold text-ink-900"><?= esc($customer['name']) ?></p>
            <p class="text-[13px] text-ink-400"><?= esc($customer['email']) ?></p>
          </td>
          <td class="py-4 pr-4 text-ink-700"><?= esc($customer['phone'] ?: '—') ?></td>
          <td class="py-4 pr-4 text-ink-700"><?= esc($place ?: '—') ?></td>
          <td class="py-4 pr-4 text-ink-700"><?= ($customer['signup_method'] ?? 'email') === 'google' ? 'Google' : 'Email' ?></td>
          <td class="py-4 pr-4 text-ink-700"><?= ! empty($customer['email_verified_at']) ? 'Yes' : 'No' ?></td>
          <td class="py-4 pr-4 text-ink-500"><?= esc(date('M d, Y', strtotime($customer['created_at']))) ?></td>
          <td class="py-4 pr-4"><span class="badge <?= ($customer['type'] ?? '') === 'guest' ? 'bg-warning-50 text-warning-600' : 'bg-brand-50 text-brand-700' ?>"><?= esc(ucfirst($customer['type'] ?? 'registered')) ?></span></td>
          <td class="py-4 pr-4"><span class="badge <?= ($customer['status'] ?? 'active') === 'active' ? 'bg-success-50 text-success-700' : 'bg-danger-50 text-danger-500' ?>"><?= esc(ucfirst($customer['status'] ?? 'active')) ?></span></td>
          <td class="py-4 text-right">
            <?php if (admin_can('customers.manage')): ?>
              <a href="<?= site_url('admin/customers/' . $customer['id'] . '/edit') ?>" class="text-[13px] font-semibold text-brand-600">Edit</a>
              <form action="<?= site_url('admin/customers/' . $customer['id'] . '/delete') ?>" method="post" class="inline">
                <?= csrf_field() ?>
                <button type="submit" class="ml-3 text-[13px] font-semibold text-danger-500" onclick="return confirm('Delete this customer?')">Delete</button>
              </form>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
<?= $this->endSection() ?>
