<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6">
  <p class="mb-1 text-[13px] font-semibold uppercase text-brand-600">Staff</p>
  <h1 class="text-[24px] font-semibold text-ink-900"><?= $user ? 'Edit Admin User' : 'Add Admin User' ?></h1>
  <p class="mt-1 text-[14px] text-ink-500">Create an admin account and assign a role.</p>
</div>

<form method="post" action="<?= $user ? site_url('admin/users/' . $user['id']) : site_url('admin/users') ?>" class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_280px]">
  <?= csrf_field() ?>
  <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
    <h2 class="mb-5 text-[17px] font-semibold text-ink-900">Profile Information</h2>
    <div class="grid gap-5 md:grid-cols-2">
      <label class="block">
        <span class="text-[13px] font-semibold text-ink-700">Full Name <span class="text-danger-500">*</span></span>
        <input required name="name" value="<?= esc(old('name', $user['name'] ?? '')) ?>" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600" />
      </label>
      <label class="block">
        <span class="text-[13px] font-semibold text-ink-700">Email <span class="text-danger-500">*</span></span>
        <input <?= ! empty($lockRole) ? 'readonly' : '' ?> required type="email" name="email" value="<?= esc(old('email', $user['email'] ?? '')) ?>" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600" />
      </label>
      <label class="block">
        <span class="text-[13px] font-semibold text-ink-700">Phone</span>
        <input type="tel" name="phone" value="<?= esc(old('phone', $user['phone'] ?? '')) ?>" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600" />
      </label>
      <label class="block">
        <span class="text-[13px] font-semibold text-ink-700">Role</span>
        <?php if (! empty($lockRole)): ?>
          <input type="hidden" name="role_id" value="<?= (int) ($user['role_id'] ?? 0) ?>" />
          <input disabled value="Super Admin" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-muted px-3 text-[14px] text-ink-500" />
          <p class="mt-1 text-[12px] text-ink-400">This account is the only Super Admin. The role cannot be changed.</p>
        <?php else: ?>
        <select name="role_id" required class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700 focus:border-brand-600">
          <?php foreach ($roles as $role): ?>
          <option value="<?= (int) $role['id'] ?>" <?= (string) old('role_id', $user['role_id'] ?? '') === (string) $role['id'] ? 'selected' : '' ?>><?= esc($role['name']) ?></option>
          <?php endforeach; ?>
        </select>
        <?php endif; ?>
      </label>
      <label class="block md:col-span-2">
        <span class="text-[13px] font-semibold text-ink-700"><?= $user ? 'New password (optional)' : 'Password' ?> <?= $user ? '' : '<span class="text-danger-500">*</span>' ?></span>
        <input <?= $user ? '' : 'required' ?> type="password" name="password" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600" />
      </label>
    </div>
  </article>
  <aside class="space-y-5">
    <article class="rounded-card border border-surface-line bg-surface-card p-5 shadow-card">
      <h3 class="mb-3 text-[15px] font-semibold text-ink-900">Account Status</h3>
      <select <?= ! empty($lockRole) ? 'disabled' : '' ?> name="status" class="h-11 w-full rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700 focus:border-brand-600">
        <option value="active" <?= old('status', $user['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= old('status', $user['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
      </select>
      <?php if (! empty($lockRole)): ?>
        <input type="hidden" name="status" value="active" />
        <p class="mt-2 text-[12px] text-ink-400">Super Admin cannot be deactivated.</p>
      <?php endif; ?>
    </article>
    <button type="submit" class="h-11 w-full rounded-base bg-brand-600 text-[14px] font-semibold text-white hover:bg-brand-700">Save Admin</button>
  </aside>
</form>
<?= $this->endSection() ?>
