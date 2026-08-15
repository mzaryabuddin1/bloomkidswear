<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <div>
    <p class="mb-1 text-[13px] font-semibold uppercase text-brand-600">Staff</p>
    <h1 class="text-[24px] font-semibold text-ink-900">Admin Users</h1>
    <p class="mt-1 text-[14px] text-ink-500">Assign roles so staff only see the admin pages they need.</p>
  </div>
  <?php if (admin_can('admins.manage')): ?>
  <a href="<?= site_url('admin/users/create') ?>" class="inline-flex h-11 items-center gap-2 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700">
    <i data-lucide="plus" class="h-4 w-4"></i>
    Add Admin
  </a>
  <?php endif; ?>
</div>

<section class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
  <div class="dashboard-scrollbar overflow-x-auto">
    <table class="w-full min-w-[820px] text-left">
      <thead>
        <tr class="border-b border-surface-line text-[13px] uppercase text-ink-400">
          <th class="pb-3 pr-4 font-semibold">Admin</th>
          <th class="pb-3 pr-4 font-semibold">Role</th>
          <th class="pb-3 pr-4 font-semibold">Status</th>
          <th class="pb-3 text-right font-semibold">Action</th>
        </tr>
      </thead>
      <tbody class="text-[14px]">
        <?php foreach ($admins as $admin): ?>
        <tr class="border-b border-surface-line last:border-0">
          <td class="py-4 pr-4">
            <p class="font-semibold text-ink-900"><?= esc($admin['name']) ?></p>
            <p class="text-[13px] text-ink-400"><?= esc($admin['email']) ?></p>
          </td>
          <td class="py-4 pr-4 text-ink-700"><?= esc($admin['role_name'] ?? 'Unassigned') ?></td>
          <td class="py-4 pr-4"><span class="badge <?= ($admin['status'] ?? 'active') === 'active' ? 'bg-success-50 text-success-700' : 'bg-danger-50 text-danger-500' ?>"><?= esc(ucfirst($admin['status'] ?? 'active')) ?></span></td>
          <td class="py-4 text-right">
            <?php if (admin_can('admins.manage')): ?>
              <?php if (is_protected_super_admin_user($admin) && (int) session()->get('admin_id') !== (int) $admin['id']): ?>
                <span class="text-[13px] text-ink-400">Locked</span>
              <?php else: ?>
              <a href="<?= site_url('admin/users/' . $admin['id'] . '/edit') ?>" class="text-[13px] font-semibold text-brand-600">Edit</a>
              <?php if (! is_protected_super_admin_user($admin) && (int) session()->get('admin_id') !== (int) $admin['id']): ?>
              <form action="<?= site_url('admin/users/' . $admin['id'] . '/delete') ?>" method="post" class="inline">
                <?= csrf_field() ?>
                <button type="submit" class="ml-3 text-[13px] font-semibold text-danger-500" onclick="return confirm('Delete this admin?')">Delete</button>
              </form>
              <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
<?= $this->endSection() ?>
