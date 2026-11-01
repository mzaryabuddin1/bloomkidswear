<?php
use App\Libraries\AdminNotify;

$qs = static fn (array $o = []) => '?' . http_build_query(array_filter(array_merge(['show' => $filter === 'unread' ? 'unread' : null], $o), static fn ($v) => $v !== null));
?>
<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <div>
    <p class="mb-1 text-[13px] font-semibold uppercase text-brand-600">Inbox</p>
    <h1 class="text-[24px] font-semibold text-ink-900">Notifications</h1>
    <p class="mt-1 text-[14px] text-ink-500">New orders and other activity on your store. <?= (int) $unread ?> unread.</p>
  </div>
  <?php if ($unread > 0): ?>
  <form method="post" action="<?= site_url('admin/notifications/read-all') ?>">
    <?= csrf_field() ?>
    <button type="submit" class="inline-flex h-11 items-center gap-2 rounded-base border border-surface-line bg-surface-card px-4 text-[14px] font-semibold text-ink-700 hover:bg-surface-muted"><i data-lucide="check-check" class="h-4 w-4"></i> Mark all as read</button>
  </form>
  <?php endif; ?>
</div>

<?php if (session()->getFlashdata('success')): ?>
<div class="mb-4 rounded-base bg-success-50 px-4 py-3 text-[14px] text-success-700"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif; ?>

<section class="rounded-card border border-surface-line bg-surface-card shadow-card">
  <div class="flex gap-6 border-b border-surface-line px-6 pt-4 text-[14px]">
    <a href="<?= site_url('admin/notifications') ?>" class="pb-3 font-semibold <?= $filter === 'all' ? 'border-b-2 border-brand-600 text-brand-600' : 'text-ink-500' ?>">All</a>
    <a href="<?= site_url('admin/notifications?show=unread') ?>" class="pb-3 font-semibold <?= $filter === 'unread' ? 'border-b-2 border-brand-600 text-brand-600' : 'text-ink-500' ?>">Unread</a>
  </div>

  <?php if (! $rows): ?>
  <p class="px-6 py-12 text-center text-[14px] text-ink-400"><?= $filter === 'unread' ? 'You are all caught up.' : 'No notifications yet. New orders will appear here.' ?></p>
  <?php endif; ?>

  <?php foreach ($rows as $n): ?>
  <a href="<?= site_url('admin/notifications/' . $n['id'] . '/open') ?>" class="flex items-start gap-4 border-b border-surface-line px-6 py-4 last:border-0 hover:bg-surface-muted" style="<?= $n['is_read'] ? '' : 'background:rgba(35,59,97,.05)' ?>">
    <span class="mt-0.5 grid h-10 w-10 shrink-0 place-items-center rounded-full bg-brand-50 text-brand-700"><i data-lucide="shopping-bag" class="h-5 w-5"></i></span>
    <span class="min-w-0 flex-1">
      <span class="block text-[14px] <?= $n['is_read'] ? 'font-medium' : 'font-semibold' ?> text-ink-900"><?= esc($n['title']) ?></span>
      <span class="block text-[13px] text-ink-500"><?= esc($n['body']) ?></span>
    </span>
    <span class="flex shrink-0 items-center gap-2 text-[12px] text-ink-400">
      <?= esc(AdminNotify::ago($n['created_at'])) ?>
      <?php if (! $n['is_read']): ?><span class="h-2 w-2 rounded-full bg-danger-500"></span><?php endif; ?>
    </span>
  </a>
  <?php endforeach; ?>
</section>

<?php if ($pages > 1): ?>
<div class="mt-5 flex flex-wrap items-center gap-2 text-[14px]">
  <?php for ($i = 1; $i <= $pages; $i++): ?>
  <a href="<?= $qs(['page' => $i > 1 ? $i : null]) ?>" class="rounded-base border px-3 py-1.5 <?= $i === $page ? 'border-brand-600 bg-brand-600 text-white' : 'border-surface-line text-ink-700' ?>"><?= $i ?></a>
  <?php endfor; ?>
  <span class="ml-2 text-ink-400"><?= (int) $total ?> notifications</span>
</div>
<?php endif; ?>
<?= $this->endSection() ?>
