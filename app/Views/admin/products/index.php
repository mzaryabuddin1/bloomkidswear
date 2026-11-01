<?php
use App\Libraries\Cart;

$qs = static fn (array $o = []) => '?' . http_build_query(array_filter(array_merge(['q' => $q, 'category' => $category ?: null, 'stock' => $stock], $o), static fn ($v) => $v !== '' && $v !== null));
?>
<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <div>
    <p class="mb-1 text-[13px] font-semibold uppercase text-brand-600">Catalogue</p>
    <h1 class="text-[24px] font-semibold text-ink-900">Products</h1>
    <p class="mt-1 text-[14px] text-ink-500"><?= (int) $total ?> product<?= $total === 1 ? '' : 's' ?> in your store.</p>
  </div>
  <?php if (admin_can('products.manage')): ?>
  <a href="<?= site_url('admin/products/create') ?>" class="inline-flex h-11 items-center gap-2 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700"><i data-lucide="plus" class="h-4 w-4"></i> Add Product</a>
  <?php endif; ?>
</div>

<section class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
  <form method="get" class="mb-4 flex flex-wrap gap-2">
    <input type="search" name="q" value="<?= esc($q) ?>" placeholder="Search name or SKU" class="h-11 w-full max-w-xs rounded-base border border-surface-line bg-surface-card px-4 text-[14px] text-ink-900">
    <select name="category" class="h-11 rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700">
      <option value="">All categories</option>
      <?php foreach ($categories as $pid => $parent): ?>
      <option value="<?= $pid ?>" <?= $category === $pid ? 'selected' : '' ?>><?= esc($parent['name']) ?></option>
      <?php foreach ($parent['children'] as $cid => $cname): ?><option value="<?= $cid ?>" <?= $category === $cid ? 'selected' : '' ?>>&nbsp;&nbsp;— <?= esc($cname) ?></option><?php endforeach; ?>
      <?php endforeach; ?>
    </select>
    <select name="stock" class="h-11 rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700">
      <option value="">Any stock</option>
      <option value="low" <?= $stock === 'low' ? 'selected' : '' ?>>Low stock (&lt; 10)</option>
      <option value="out" <?= $stock === 'out' ? 'selected' : '' ?>>Out of stock</option>
      <option value="hidden" <?= $stock === 'hidden' ? 'selected' : '' ?>>Hidden</option>
    </select>
    <button type="submit" class="h-11 rounded-base bg-brand-600 px-4 text-[14px] font-semibold text-white hover:bg-brand-700">Filter</button>
  </form>

  <div class="dashboard-scrollbar overflow-x-auto">
    <table class="w-full min-w-[900px] text-left">
      <thead>
        <tr class="border-b border-surface-line text-[13px] uppercase text-ink-400">
          <th class="pb-3 pr-4 font-semibold">Product</th>
          <th class="pb-3 pr-4 font-semibold">Category</th>
          <th class="pb-3 pr-4 font-semibold">Colour</th>
          <th class="pb-3 pr-4 font-semibold">Price</th>
          <th class="pb-3 pr-4 font-semibold">Stock</th>
          <th class="pb-3 pr-4 font-semibold">Sold</th>
          <th class="pb-3 pr-4 font-semibold">Status</th>
          <th class="pb-3 text-right font-semibold">Action</th>
        </tr>
      </thead>
      <tbody class="text-[14px]">
        <?php if (! $products): ?><tr><td colspan="8" class="py-8 text-center text-ink-400">No products found.</td></tr><?php endif; ?>
        <?php foreach ($products as $p): $onSale = $p['sale_price'] !== null && (float) $p['sale_price'] < (float) $p['price']; ?>
        <tr class="border-b border-surface-line last:border-0">
          <td class="py-3 pr-4">
            <div class="flex items-center gap-3">
              <?php if ($p['image']): ?><img src="<?= base_url($p['image']) ?>" alt="" class="h-12 w-12 rounded-base object-cover"><?php endif; ?>
              <div><p class="font-semibold text-ink-900"><?= esc($p['name']) ?></p><p class="text-[13px] text-ink-400"><?= esc($p['sku']) ?></p></div>
            </div>
          </td>
          <td class="py-3 pr-4 text-ink-700"><?= esc($p['category_name'] ?: '—') ?></td>
          <td class="py-3 pr-4 text-ink-700"><?= esc(ucfirst((string) $p['colors'])) ?></td>
          <td class="py-3 pr-4"><span class="font-semibold text-ink-900"><?= Cart::money($onSale ? $p['sale_price'] : $p['price']) ?></span><?php if ($onSale): ?><br><del class="text-[13px] text-ink-400"><?= Cart::money($p['price']) ?></del><?php endif; ?></td>
          <td class="py-3 pr-4"><span class="badge <?= (int) $p['stock'] < 1 ? 'bg-danger-50 text-danger-500' : ((int) $p['stock'] < 10 ? 'bg-warning-50 text-warning-600' : 'bg-success-50 text-success-700') ?>"><?= (int) $p['stock'] ?></span></td>
          <td class="py-3 pr-4 text-ink-700"><?= (int) $p['sold_count'] ?></td>
          <td class="py-3 pr-4"><span class="badge <?= $p['is_active'] ? 'bg-success-50 text-success-700' : 'bg-surface-muted text-ink-500' ?>"><?= $p['is_active'] ? 'Visible' : 'Hidden' ?></span></td>
          <td class="py-3 text-right whitespace-nowrap">
            <?php if (admin_can('products.manage')): ?>
            <a href="<?= site_url('admin/products/' . $p['id'] . '/edit') ?>" class="text-[13px] font-semibold text-brand-600">Edit</a>
            <form action="<?= site_url('admin/products/' . $p['id'] . '/toggle') ?>" method="post" class="inline"><?= csrf_field() ?><button type="submit" class="ml-3 text-[13px] font-semibold text-ink-500"><?= $p['is_active'] ? 'Hide' : 'Show' ?></button></form>
            <form action="<?= site_url('admin/products/' . $p['id'] . '/delete') ?>" method="post" class="inline"><?= csrf_field() ?><button type="submit" class="ml-3 text-[13px] font-semibold text-danger-500" onclick="return confirm('Delete this product?')">Delete</button></form>
            <?php endif; ?>
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
  </div>
  <?php endif; ?>
</section>
<?= $this->endSection() ?>
