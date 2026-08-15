<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6">
  <p class="mb-1 text-[13px] font-semibold uppercase text-brand-600">Storefront</p>
  <h1 class="text-[24px] font-semibold text-ink-900"><?= $customer ? 'Edit Customer' : 'Add Customer' ?></h1>
  <p class="mt-1 text-[14px] text-ink-500">Guest customers have no password. Registered customers can sign in on the shop.</p>
</div>

<form method="post" action="<?= $customer ? site_url('admin/customers/' . $customer['id']) : site_url('admin/customers') ?>" class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_280px]">
  <?= csrf_field() ?>
  <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
    <h2 class="mb-5 text-[17px] font-semibold text-ink-900">Profile Information</h2>
    <div class="grid gap-5 md:grid-cols-2">
      <label class="block">
        <span class="text-[13px] font-semibold text-ink-700">Full Name <span class="text-danger-500">*</span></span>
        <input required name="name" value="<?= esc(old('name', $customer['name'] ?? '')) ?>" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600" />
      </label>
      <label class="block">
        <span class="text-[13px] font-semibold text-ink-700">Email <span class="text-danger-500">*</span></span>
        <input required type="email" name="email" value="<?= esc(old('email', $customer['email'] ?? '')) ?>" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600" />
      </label>
      <label class="block">
        <span class="text-[13px] font-semibold text-ink-700">Phone</span>
        <input type="tel" name="phone" value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600" />
      </label>
      <label class="block">
        <span class="text-[13px] font-semibold text-ink-700">Type</span>
        <select name="type" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700 focus:border-brand-600">
          <option value="registered" <?= old('type', $customer['type'] ?? 'registered') === 'registered' ? 'selected' : '' ?>>Registered</option>
          <option value="guest" <?= old('type', $customer['type'] ?? '') === 'guest' ? 'selected' : '' ?>>Guest</option>
        </select>
      </label>
      <label class="block md:col-span-2">
        <span class="text-[13px] font-semibold text-ink-700">Address</span>
        <textarea name="address" rows="4" class="mt-1.5 min-h-[110px] w-full resize-y rounded-base border border-surface-line bg-surface-body px-3 py-3 text-[14px] focus:border-brand-600"><?= esc(old('address', $customer['address'] ?? '')) ?></textarea>
      </label>
      <label class="block md:col-span-2">
        <span class="text-[13px] font-semibold text-ink-700">Password (required for new registered customers)</span>
        <input type="password" name="password" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600" />
      </label>
    </div>
  </article>
  <aside class="space-y-5">
    <article class="rounded-card border border-surface-line bg-surface-card p-5 shadow-card">
      <h3 class="mb-3 text-[15px] font-semibold text-ink-900">Account Status</h3>
      <select name="status" class="h-11 w-full rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700 focus:border-brand-600">
        <option value="active" <?= old('status', $customer['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= old('status', $customer['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
      </select>
    </article>
    <button type="submit" class="h-11 w-full rounded-base bg-brand-600 text-[14px] font-semibold text-white hover:bg-brand-700">Save Customer</button>
  </aside>
</form>
<?= $this->endSection() ?>
