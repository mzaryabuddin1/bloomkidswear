<?php
$inp = 'mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600';
?>
<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6">
  <a href="<?= site_url('admin/categories') ?>" class="text-[13px] font-semibold text-brand-600">&larr; All categories</a>
  <h1 class="mt-1 text-[24px] font-semibold text-ink-900"><?= $category ? 'Edit Category' : 'Add Category' ?></h1>
</div>
<form method="post" action="<?= $category ? site_url('admin/categories/' . $category['id']) : site_url('admin/categories') ?>" class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_280px]">
  <?= csrf_field() ?>
  <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
    <div class="grid gap-5 md:grid-cols-2">
      <label class="block"><span class="text-[13px] font-semibold text-ink-700">Name <span class="text-danger-500">*</span></span>
        <input required name="name" value="<?= esc(old('name', $category['name'] ?? ''), 'attr') ?>" class="<?= $inp ?>"></label>
      <label class="block"><span class="text-[13px] font-semibold text-ink-700">Parent category</span>
        <select name="parent_id" class="mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700">
          <option value="">None (top-level)</option>
          <?php $cur = (int) old('parent_id', $category['parent_id'] ?? 0); foreach ($parents as $p): if ($category && (int) $p['id'] === (int) $category['id']) continue; ?>
          <option value="<?= $p['id'] ?>" <?= $cur === (int) $p['id'] ? 'selected' : '' ?>><?= esc($p['name']) ?></option>
          <?php endforeach; ?>
        </select></label>
      <label class="block"><span class="text-[13px] font-semibold text-ink-700">Sort order</span>
        <input type="number" min="0" name="sort_order" value="<?= esc(old('sort_order', $category['sort_order'] ?? 0), 'attr') ?>" class="<?= $inp ?>"></label>
      <label class="block md:col-span-2"><span class="text-[13px] font-semibold text-ink-700">Description</span>
        <textarea name="description" rows="4" class="mt-1.5 w-full resize-y rounded-base border border-surface-line bg-surface-body px-3 py-3 text-[14px] focus:border-brand-600"><?= esc(old('description', $category['description'] ?? '')) ?></textarea></label>
    </div>
  </article>
  <aside class="space-y-5">
    <article class="rounded-card border border-surface-line bg-surface-card p-5 shadow-card">
      <label class="flex items-center gap-2 text-[14px] text-ink-700"><input type="checkbox" name="is_active" value="1" <?= ! $category || old('is_active', $category['is_active'] ?? 1) ? 'checked' : '' ?>> Active (shown in shop)</label>
    </article>
    <button type="submit" class="h-11 w-full rounded-base bg-brand-600 text-[14px] font-semibold text-white hover:bg-brand-700">Save Category</button>
  </aside>
</form>
<?= $this->endSection() ?>
