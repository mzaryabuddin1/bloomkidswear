<?= $this->include('storefront/partials/head') ?>
<?= $this->include('storefront/partials/header') ?>
<?= view('storefront/partials/breadcrumb', ['crumbs' => [$title => null]]) ?>

<div class="rbt-component-area rbt-section-gapBottom rbt-bg-color-white pt--40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10">
                <h1 class="h2 mb--24"><?= esc($title) ?></h1>
                <div class="bloom-page-content">
                    <?= $this->include($body) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .bloom-page-content h2 { font-size: 20px; margin: 28px 0 10px; }
    .bloom-page-content p, .bloom-page-content li { font-size: 15px; line-height: 1.8; }
    .bloom-page-content ul { padding-left: 20px; margin-bottom: 14px; list-style: disc; }
</style>

<?= $this->include('storefront/partials/footer') ?>
<?= $this->include('storefront/partials/auth_modal') ?>
<?= $this->include('storefront/partials/scripts') ?>
