<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <div>
    <p class="mb-1 text-[13px] font-semibold uppercase text-brand-600">Access Control</p>
    <h1 class="text-[24px] font-semibold text-ink-900">Roles</h1>
    <p class="mt-1 text-[14px] text-ink-500">Control dashboard permissions for admins and staff members.</p>
  </div>
  <?php if (admin_can('roles.manage')): ?>
  <a href="<?= site_url('admin/roles/create') ?>" class="inline-flex h-11 items-center gap-2 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700">
    <i data-lucide="plus" class="h-4 w-4"></i>
    Create Role
  </a>
  <?php endif; ?>
</div>

<section class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
  <div class="dashboard-scrollbar overflow-x-auto">
    <table class="w-full min-w-[820px] text-left">
      <thead>
        <tr class="border-b border-surface-line text-[13px] uppercase text-ink-400">
          <th class="pb-3 pr-4 font-semibold">Role</th>
          <th class="pb-3 pr-4 font-semibold">Users</th>
          <th class="pb-3 pr-4 font-semibold">Permissions</th>
          <th class="pb-3 pr-4 font-semibold">Status</th>
          <th class="pb-3 text-right font-semibold">Action</th>
        </tr>
      </thead>
      <tbody class="text-[14px]">
        <?php foreach ($roles as $role): ?>
        <tr class="border-b border-surface-line last:border-0">
          <td class="py-4 pr-4">
            <p class="font-semibold text-ink-900"><?= esc($role['name']) ?></p>
            <p class="text-[13px] text-ink-400"><?= esc($role['description'] ?? '') ?></p>
          </td>
          <td class="py-4 pr-4 text-ink-700"><?= (int) $role['user_count'] ?></td>
          <td class="py-4 pr-4 text-ink-700"><?= $role['slug'] === 'super-admin' ? 'All' : (int) $role['permission_count'] ?></td>
          <td class="py-4 pr-4">
            <span class="badge <?= ($role['status'] ?? 'active') === 'active' ? 'bg-success-50 text-success-700' : 'bg-warning-50 text-warning-600' ?>"><?= esc(ucfirst($role['status'] ?? 'active')) ?></span>
          </td>
          <td class="py-4 text-right">
            <?php if (admin_can('roles.manage') && ($role['slug'] ?? '') !== 'super-admin'): ?>
              <a href="<?= site_url('admin/roles/' . $role['id'] . '/edit') ?>" class="text-[13px] font-semibold text-brand-600 hover:text-brand-700">Edit</a>
              <?php if (empty($role['is_system'])): ?>
              <form action="<?= site_url('admin/roles/' . $role['id'] . '/delete') ?>" method="post" class="inline">
                <?= csrf_field() ?>
                <button type="submit" class="ml-3 text-[13px] font-semibold text-danger-500" onclick="return confirm('Delete this role?')">Delete</button>
              </form>
              <?php endif; ?>
            <?php elseif (($role['slug'] ?? '') === 'super-admin'): ?>
              <span class="text-[13px] text-ink-400">Locked</span>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
<?= $this->endSection() ?>
