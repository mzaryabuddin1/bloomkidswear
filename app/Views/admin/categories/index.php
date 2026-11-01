<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?php
$row = static function (array $c, bool $child) {
    ob_start(); ?>
    <tr class="border-b border-surface-line last:border-0">
      <td class="py-3 pr-4 <?= $child ? 'pl-8 text-ink-700' : 'font-semibold text-ink-900' ?>"><?= $child ? '— ' : '' ?><?= esc($c['name']) ?></td>
      <td class="py-3 pr-4 text-[13px] text-ink-400"><?= esc($c['slug']) ?></td>
      <td class="py-3 pr-4 text-ink-700"><?= (int) $c['product_count'] ?></td>
      <td class="py-3 pr-4"><span class="badge <?= $c['is_active'] ? 'bg-success-50 text-success-700' : 'bg-surface-muted text-ink-500' ?>"><?= $c['is_active'] ? 'Active' : 'Hidden' ?></span></td>
      <td class="py-3 text-right whitespace-nowrap">
        <?php if (admin_can('categories.manage')): ?>
        <a href="<?= site_url('admin/categories/' . $c['id'] . '/edit') ?>" class="text-[13px] font-semibold text-brand-600">Edit</a>
        <form action="<?= site_url('admin/categories/' . $c['id'] . '/delete') ?>" method="post" class="inline"><?= csrf_field() ?><button type="submit" class="ml-3 text-[13px] font-semibold text-danger-500" onclick="return confirm('Delete this category?')">Delete</button></form>
        <?php endif; ?>
      </td>
    </tr>
    <?php return ob_get_clean();
};
?>
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <div>
    <p class="mb-1 text-[13px] font-semibold uppercase text-brand-600">Catalogue</p>
    <h1 class="text-[24px] font-semibold text-ink-900">Categories</h1>
    <p class="mt-1 text-[14px] text-ink-500">These power the Shop menu and the shop filters.</p>
  </div>
  <?php if (admin_can('categories.manage')): ?>
  <a href="<?= site_url('admin/categories/create') ?>" class="inline-flex h-11 items-center gap-2 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700"><i data-lucide="plus" class="h-4 w-4"></i> Add Category</a>
  <?php endif; ?>
</div>
<section class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
  <div class="dashboard-scrollbar overflow-x-auto">
    <table class="w-full min-w-[640px] text-left">
      <thead><tr class="border-b border-surface-line text-[13px] uppercase text-ink-400"><th class="pb-3 pr-4 font-semibold">Name</th><th class="pb-3 pr-4 font-semibold">Slug</th><th class="pb-3 pr-4 font-semibold">Products</th><th class="pb-3 pr-4 font-semibold">Status</th><th class="pb-3 text-right font-semibold">Action</th></tr></thead>
      <tbody class="text-[14px]">
        <?php if (! $tree): ?><tr><td colspan="5" class="py-8 text-center text-ink-400">No categories yet.</td></tr><?php endif; ?>
        <?php foreach ($tree as $parent): ?>
          <?= $row($parent, false) ?>
          <?php foreach ($parent['children'] as $child): ?><?= $row($child, true) ?><?php endforeach; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
<?= $this->endSection() ?>
