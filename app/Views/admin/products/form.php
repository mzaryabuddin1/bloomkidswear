<?php
$v   = static fn (string $k, $d = '') => old($k, $d);
$inp = 'mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-body px-3 text-[14px] focus:border-brand-600';
$sel = 'mt-1.5 h-11 w-full rounded-base border border-surface-line bg-surface-card px-3 text-[14px] text-ink-700 focus:border-brand-600';
?>
<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6">
  <a href="<?= site_url('admin/products') ?>" class="text-[13px] font-semibold text-brand-600">&larr; All products</a>
  <h1 class="mt-1 text-[24px] font-semibold text-ink-900"><?= $product ? 'Edit Product' : 'Add Product' ?></h1>
  <p class="mt-1 text-[14px] text-ink-500">Each design is sold in a single colour. Leave images empty to generate a placeholder.</p>
</div>

<form method="post" enctype="multipart/form-data" action="<?= $product ? site_url('admin/products/' . $product['id']) : site_url('admin/products') ?>" class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_320px]">
  <?= csrf_field() ?>
  <div class="space-y-6">
    <article class="rounded-card border border-surface-line bg-surface-card p-6 shadow-card">
      <h2 class="mb-5 text-[17px] font-semibold text-ink-900">Product details</h2>
      <div class="grid gap-5 md:grid-cols-2">
        <label class="block md:col-span-2"><span class="text-[13px] font-semibold text-ink-700">Name <span class="text-danger-500">*</span></span>
          <input required name="name" value="<?= esc($v('name', $product['name'] ?? ''), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Category <span class="text-danger-500">*</span></span>
          <select required name="category_id" class="<?= $sel ?>">
            <option value="">Select category</option>
            <?php $cur = (int) $v('category_id', $product['category_id'] ?? 0); foreach ($categories as $pid => $parent): ?>
            <optgroup label="<?= esc($parent['name'], 'attr') ?>">
              <option value="<?= $pid ?>" <?= $cur === $pid ? 'selected' : '' ?>>All <?= esc($parent['name']) ?></option>
              <?php foreach ($parent['children'] as $cid => $cname): ?><option value="<?= $cid ?>" <?= $cur === $cid ? 'selected' : '' ?>><?= esc($cname) ?></option><?php endforeach; ?>
            </optgroup>
            <?php endforeach; ?>
          </select></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">SKU</span>
          <input name="sku" value="<?= esc($v('sku', $product['sku'] ?? ''), 'attr') ?>" placeholder="Auto-generated if empty" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Regular price (PKR) <span class="text-danger-500">*</span></span>
          <input required type="number" min="1" step="1" name="price" value="<?= esc($v('price', isset($product['price']) ? (int) $product['price'] : ''), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Sale price (PKR)</span>
          <input type="number" min="1" step="1" name="sale_price" value="<?= esc($v('sale_price', isset($product['sale_price']) ? (int) $product['sale_price'] : ''), 'attr') ?>" placeholder="Optional" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Stock <span class="text-danger-500">*</span></span>
          <input required type="number" min="0" step="1" name="stock" value="<?= esc($v('stock', $product['stock'] ?? 0), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Colour <span class="text-danger-500">*</span></span>
          <select required name="color" class="<?= $sel ?>">
            <?php $col = $v('color', $product['colors'] ?? 'pink'); foreach ($colors as $c): ?><option value="<?= $c ?>" <?= $col === $c ? 'selected' : '' ?>><?= esc(ucfirst($c)) ?></option><?php endforeach; ?>
          </select></label>
        <label class="block md:col-span-2"><span class="text-[13px] font-semibold text-ink-700">Sizes <span class="text-danger-500">*</span> <span class="font-normal text-ink-400">(comma separated, e.g. 2-3Y,4-5Y,6-7Y)</span></span>
          <input required name="sizes" value="<?= esc($v('sizes', $product['sizes'] ?? '2-3Y,4-5Y,6-7Y,8-9Y,10-12Y'), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Age group</span>
          <select name="age_group" class="<?= $sel ?>">
            <option value="">—</option>
            <?php $age = $v('age_group', $product['age_group'] ?? ''); foreach ($ages as $k => $label): ?><option value="<?= $k ?>" <?= $age === $k ? 'selected' : '' ?>><?= esc($label) ?></option><?php endforeach; ?>
          </select></label>
        <label class="block"><span class="text-[13px] font-semibold text-ink-700">Material</span>
          <input name="material" value="<?= esc($v('material', $product['material'] ?? ''), 'attr') ?>" placeholder="e.g. 100% cotton" class="<?= $inp ?>"></label>
        <label class="block md:col-span-2"><span class="text-[13px] font-semibold text-ink-700">Short description</span>
          <input name="short_description" maxlength="300" value="<?= esc($v('short_description', $product['short_description'] ?? ''), 'attr') ?>" class="<?= $inp ?>"></label>
        <label class="block md:col-span-2"><span class="text-[13px] font-semibold text-ink-700">Full description</span>
          <textarea name="description" rows="5" class="mt-1.5 w-full resize-y rounded-base border border-surface-line bg-surface-body px-3 py-3 text-[14px] focus:border-brand-600"><?= esc($v('description', $product['description'] ?? '')) ?></textarea></label>
      </div>
    </article>
  </div>

  <aside class="space-y-5">
    <article class="rounded-card border border-surface-line bg-surface-card p-5 shadow-card">
      <h3 class="mb-3 text-[15px] font-semibold text-ink-900">Images</h3>
      <?php if (! empty($product['image'])): ?><img src="<?= base_url($product['image']) ?>" alt="" class="mb-3 h-40 w-full rounded-base object-cover"><?php endif; ?>
      <label class="block"><span class="text-[13px] font-semibold text-ink-700">Main image</span>
        <input type="file" name="image" accept="image/png,image/jpeg,image/webp" class="mt-1.5 block w-full text-[13px]"></label>
      <label class="mt-3 block"><span class="text-[13px] font-semibold text-ink-700">Hover image</span>
        <input type="file" name="hover_image" accept="image/png,image/jpeg,image/webp" class="mt-1.5 block w-full text-[13px]"></label>
      <p class="mt-2 text-[12px] text-ink-400">PNG, JPG or WebP, up to 3 MB.</p>
    </article>
    <article class="rounded-card border border-surface-line bg-surface-card p-5 shadow-card">
      <h3 class="mb-3 text-[15px] font-semibold text-ink-900">Display</h3>
      <label class="block"><span class="text-[13px] font-semibold text-ink-700">Badge</span>
        <select name="badge" class="<?= $sel ?>">
          <option value="">None</option>
          <?php $bd = $v('badge', $product['badge'] ?? ''); foreach ($badges as $b): ?><option value="<?= $b ?>" <?= $bd === $b ? 'selected' : '' ?>><?= $b ?></option><?php endforeach; ?>
        </select></label>
      <label class="mt-3 flex items-center gap-2 text-[14px] text-ink-700"><input type="checkbox" name="is_featured" value="1" <?= $v('is_featured', $product['is_featured'] ?? 0) ? 'checked' : '' ?>> Featured product</label>
      <label class="mt-2 flex items-center gap-2 text-[14px] text-ink-700"><input type="checkbox" name="is_active" value="1" <?= ! $product || old('is_active', $product['is_active'] ?? 1) ? 'checked' : '' ?>> Visible in shop</label>
    </article>
    <button type="submit" class="h-11 w-full rounded-base bg-brand-600 text-[14px] font-semibold text-white hover:bg-brand-700">Save Product</button>
  </aside>
</form>
<?= $this->endSection() ?>
