<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= esc($pageTitle ?? "Bloom Kidswear") ?></title>
    <meta name="robots" content="index, follow">
    <meta name="description"
        content="<?= esc($pageDescription ?? "Bloom Kidswear - stylish, comfortable clothing for kids.") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&family=Caveat:wght@400;500;600;700&family=Bebas+Neue&family=Caprasimo&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&family=Caveat:wght@400;500;600;700&family=Bebas+Neue&family=Caprasimo&display=swap">
    </noscript>
    <link rel="preload" href="<?php echo base_url('assets/frontend/'); ?>fonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo base_url('assets/frontend/'); ?>fonts/fa-regular-400.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo base_url('assets/frontend/'); ?>fonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url("assets/frontend/images/favicon-32.png") ?>">
    <link rel="icon" type="image/png" sizes="256x256" href="<?= base_url("assets/frontend/images/favicon.png") ?>">
    <link rel="apple-touch-icon" href="<?= base_url("assets/frontend/images/apple-touch-icon.png") ?>">
    <meta name="csrf-token" content="<?= csrf_hash() ?>" data-name="<?= csrf_token() ?>">
    <meta name="base-url" content="<?= base_url("/") ?>">
    <meta name="bloom-auth" content="<?= session("customer_id") ? 1 : 0 ?>">

    <!-- CSS
	============================================ -->
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/vendor/bootstrap.min.css">
    <link rel="preload" href="<?php echo base_url('assets/frontend/'); ?>css/plugins/fontawesome-all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/plugins/fontawesome-all.min.css">
    </noscript>
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/plugins/swiper.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/plugins/fancybox.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/plugins/mavo.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/plugins/odometer.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/plugins/animation.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/plugins/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/plugins/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/'); ?>css/style.min.css">
    <style>
        :root {
            --color-primary: #233b61;
            --color-brand-50: #f2f4f8;
            --color-brand-100: #e6eaf1;
            --color-brand-200: #cfd7e4;
            --color-brand-300: #a8b6cb;
            --color-brand-400: #7a90b0;
            --color-brand-500: #556f93;
            --color-brand-600: #3a557a;
            --color-brand-700: #233b61;
        }

        .rbt-header .logo img,
        .rbt-popup-mobile-menu .logo img {
            max-height: 48px;
            width: auto;
        }

        .bloom-size-pills { display: flex; flex-wrap: wrap; gap: 6px; }
        .bloom-pill { appearance: none; -webkit-appearance: none; margin: 0; cursor: pointer; min-width: 44px; padding: 5px 12px; text-align: center; font-size: 13px; line-height: 1.2; border: 1px solid #d9dee8; border-radius: 999px; background: #fff; color: #233b61; transition: all .2s ease; }
        .bloom-pill:hover { border-color: #233b61; }
        .bloom-pill.is-on, .bloom-pill[aria-pressed="true"] { background: #233b61; border-color: #233b61; color: #fff; }
        .bloom-pill:focus-visible { outline: 2px solid #7a90b0; outline-offset: 2px; }
        .rbt-catagories-area .rbt-cat-box .rbt-image-portion { width: 120px; height: 120px; margin: 0 auto; border-radius: 50%; overflow: hidden; }
        .rbt-catagories-area .rbt-cat-box .rbt-image-portion img { width: 100%; height: 100%; object-fit: cover; }
        .bloom-size-pills.bloom-need { animation: bloomShake .4s; }
        .bloom-size-pills.bloom-need .bloom-pill { border-color: #dc3545; }
        @keyframes bloomShake { 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }
    </style>
<?= $headExtra ?? "" ?>
</head>
