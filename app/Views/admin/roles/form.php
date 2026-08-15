<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6">
  <p class="mb-1 text-[13px] font-semibold uppercase text-brand-600">Access Control</p>
  <h1 class="text-[24px] font-semibold text-ink-900"><?= $role ? 'Edit Role' : 'Create Role' ?></h1>
  <p class="mt-1 text-[14px] text-ink-500">Define role details and dashboard permissions.</p>
</div>

<form method="post" action="<?= $role ? site_url('admin/roles/' . $role['id']) : site_url('admin/roles') ?>" class="space-y-6">
  <?= csrf_field() ?>
  <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
    <h2 class="mb-5 text-[17px] font-semibold text-ink-900">Role Details</h2>
    <div class="grid gap-5 md:grid-cols-2">
      <label class="block">
        <span class="text-[13px] font-semibold text-ink-700">Role Name <span class="text-danger-500">*</span></span>
        <input required name="name" value="<?= esc(old('name', $role['name'] ?? '')) ?>" placeholder="Store Manager" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600" />
      </label>
      <label class="block">
        <span class="text-[13px] font-semibold text-ink-700">Status</span>
        <select name="status" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700 focus:border-brand-600">
          <option value="active" <?= old('status', $role['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
          <option value="draft" <?= old('status', $role['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
        </select>
      </label>
      <label class="block md:col-span-2">
        <span class="text-[13px] font-semibold text-ink-700">Description</span>
        <textarea name="description" rows="4" class="mt-1.5 min-h-[110px] w-full resize-y rounded-base border border-surface-line bg-surface-body px-3 py-3 text-[14px] focus:border-brand-600"><?= esc(old('description', $role['description'] ?? '')) ?></textarea>
      </label>
    </div>
  </article>

  <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
    <h2 class="mb-5 text-[17px] font-semibold text-ink-900">Permissions</h2>
    <?php if (($role['slug'] ?? '') === 'super-admin'): ?>
      <p class="text-[14px] text-ink-500">Super Admin always has full access.</p>
    <?php else: ?>
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
      <?php foreach ($permissions as $permission): ?>
      <label class="flex items-center gap-3 rounded-base border border-surface-line px-4 py-3 text-[14px] font-semibold text-ink-700">
        <input type="checkbox" name="permissions[]" value="<?= (int) $permission['id'] ?>" class="h-4 w-4 rounded border-surface-line text-brand-600 focus:ring-brand-600" <?= in_array((int) $permission['id'], array_map('intval', $assigned), true) ? 'checked' : '' ?> />
        <?= esc($permission['label']) ?>
      </label>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </article>

  <div class="flex justify-end gap-3">
    <a href="<?= site_url('admin/roles') ?>" class="inline-flex h-11 items-center rounded-base border border-surface-line px-4 text-[14px] font-semibold text-ink-700">Cancel</a>
    <button type="submit" class="inline-flex h-11 items-center rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700">Save Role</button>
  </div>
</form>
<?= $this->endSection() ?>
