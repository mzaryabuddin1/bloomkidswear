<div class="rbt-breadcrumb-two rbt-bg-color-gray-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="rbt-breadcrumb-inner text-left">
                    <ul class="rbt-breadcrumb-page-list justify-content-start mt--0">
                        <li class="rbt-breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
                        <?php foreach ($crumbs ?? [] as $label => $href): ?>
                        <li><div class="icon-right"><i class="fa-solid fa-chevron-right"></i></div></li>
                        <?php if ($href): ?>
                        <li class="rbt-breadcrumb-item"><a href="<?= esc($href, 'attr') ?>"><?= esc($label) ?></a></li>
                        <?php else: ?>
                        <li class="rbt-breadcrumb-item active"><?= esc($label) ?></li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
