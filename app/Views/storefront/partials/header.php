
<body class="rbt-header-sticky">
    <header class="rbt-header rbt-header-3">

    <div
    class="rbt-header-wrapper rbt-header-sticky-activation rbt-header-wrapper-three rbt-header-wrapper-one header-space-between rbt-bg-color-white header-not-transparent header-sticky plr--0">
    <?php if (! session('customer_id')): ?>
    <div class="rbt-header-campaign rbt-header-campaign-1 rbt-header-top-news rbt-topbar-bg-img rbt-topbar-bg-one w-100">
        <div class="rbt-corner-portion-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="inner justify-content-center">
                            <div class="rbt-text-swiper-container rbt-arrow-vertical">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="rbt-fancy-item fancy-menu-text fancy-menu-start">
                                            <p class="rbt-fancy-text rbt-text-color-white">Register now &amp; earn Bloom loyalty points on every order.
                                                <a class="rbt-text-color-white" href="#!" data-bs-toggle="modal" data-bs-target="#authModal" data-auth-view="signin">Sign Up / Sign In</a>
                                            </p>
                                        </div>
                                    </div><div class="swiper-slide">
                                        <div class="rbt-fancy-item fancy-menu-text fancy-menu-start">
                                            <p class="rbt-fancy-text rbt-text-color-white">Members unlock exclusive discounts and early access to sales.
                                                <a class="rbt-text-color-white" href="#!" data-bs-toggle="modal" data-bs-target="#authModal" data-auth-view="signin">Join Free</a>
                                            </p>
                                        </div>
                                    </div><div class="swiper-slide">
                                        <div class="rbt-fancy-item fancy-menu-text fancy-menu-start">
                                            <p class="rbt-fancy-text rbt-text-color-white">Create your account, collect reward points and save more on kids' fashion.
                                                <a class="rbt-text-color-white" href="#!" data-bs-toggle="modal" data-bs-target="#authModal" data-auth-view="signin">Get Started</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="rbt-verticle-arrow rbt-text-color-white rbt-arrow-prev">
                                    <i class="fa-regular fa-chevron-up"></i>
                                </div>
                                <div class="rbt-verticle-arrow rbt-text-color-white rbt-arrow-next">
                                    <i class="fa-regular fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="icon-close position-right">
            <button class="rbt-round-btn btn-white-off bgsection-activation" aria-label="Close Button">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
    <?php endif; ?>
    <div class="rbt-wrapper-middle rbt-header-middle-one position-relative">
        <div class="container">

            <div class="mainbar-row @@navigationEnd align-items-center">

                <div
                    class="rbt-header-sec-col rbt-header-right rbt-fancy-item fancy-menu-address fancy-menu-end d-none d-xl-block">
                    <div class="rbt-header-content">
                        <ul class="rbt-quick-access d-none d-lg-flex">
                            <li class="rbt-access-box">
                                
                                <div class="header-info">
                                    <a href="<?= site_url('track-order') ?>" class="rbt-access-link">Track Your Order</a>
                                </div>
                                <!-- Currency & Language dropdowns (hidden for now)
                                <div class="header-info">
                                    <ul class="rbt-dropdown-menu rbt-dropdown-menu-elastic currency-menu">
                                        <li class="has-child-menu">
                                            <a href="#">
                                                <span class="menu-item">$ USD</span>
                                                <i class="right-icon fa-regular fa-chevron-down"></i>
                                            </a>
                                            <ul class="sub-menu hover-reverse">
                                                <li>
                                                    <a href="#" class="active">
                                                        <span class="menu-item">$ USD</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="menu-item">£ GBP</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="menu-item">€ EUR</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="header-info">
                                    <ul class="rbt-dropdown-menu rbt-dropdown-menu-elastic switcher-language">
                                        <li class="has-child-menu">
                                            <a href="#">
                                                <img class="left-image" src="<?php echo base_url('assets/frontend/'); ?>images/icons/eng.webp"
                                                    alt="Language Images">
                                                <span class="menu-item">Eniglish</span>
                                                <i class="right-icon fa-regular fa-chevron-down"></i>
                                            </a>
                                            <ul class="sub-menu ">
                                                <li>
                                                    <a href="#" class="active">
                                                        <img class="left-image" src="<?php echo base_url('assets/frontend/'); ?>images/icons/eng.webp"
                                                            alt="Language Images">
                                                        <span class="menu-item">Eniglish</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="left-image" src="<?php echo base_url('assets/frontend/'); ?>images/icons/den.webp"
                                                            alt="Language Images">
                                                        <span class="menu-item">Danish</span>
                                                    </a>
                                                    <a href="#">
                                                        <img class="left-image" src="<?php echo base_url('assets/frontend/'); ?>images/icons/italic.webp"
                                                            alt="Language Images">
                                                        <span class="menu-item">Italic</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                -->
                            </li>
                        </ul>
                    </div>
                </div>



                <!-- Start Mobile-Menu-Bar -->
                <div class="mobile-menu-bar d-block d-xl-none">
                    <div class="hamberger">
                        <button class="hamberger-button rbt-round-btn">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                    </div>
                </div>
                <!-- Start Mobile-Menu-Bar -->

                <div class="rbt-header-content">
                    <div class="header-info">
                        <div class="logo">
                            <a href="<?= site_url('home') ?>">
                                <img src="<?php echo base_url('assets/frontend/'); ?>images/logo/bloom-logo-header.png" alt="Bloom Kids Wear">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="header-right rbt-gap--32">

                    <!-- Navbar Icons -->
                    <ul class="rbt-quick-access">
                        <li class="rbt-access-box rbt-scroll-trigger fade_in animation-order-3 tooltips tooltip-distance-lg d-none d-lg-flex"
                            data-tooltip="Search" data-tooltip-position="bottom">
                            <a class="search-trigger-active rbt-round-btn rbt-bg-static-gray rbt-modern-close-btn"
                                href="#">
                                <i class="fa-regular fa-search search-icon"></i>
                                <div class="modern-close-wrapper"></div>
                            </a>
                        </li>

                        <li class="rbt-access-box rbt-scroll-trigger fade_in animation-order-3 d-none d-lg-flex position-relative bloom-account-li">
                        <?php if (session('customer_id')): ?>
                        <div>
                            <a class="rbt-round-btn rbt-bg-static-gray" href="#!" role="button" data-bloom-account-toggle aria-expanded="false" aria-label="My account">
                                <i class="fa-regular fa-user"></i>
                            </a>
                            <ul class="bloom-account-menu list-unstyled m-0">
                                <li class="bloom-account-menu-head"><strong><?= esc(session('customer_name')) ?></strong><small><?= esc(session('customer_email')) ?></small></li>
                                <li><a class="dropdown-item" href="<?= site_url('account') ?>"><i class="fa-regular fa-user-vneck"></i> Account Information</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('account/orders') ?>"><i class="fa-regular fa-cart-shopping-fast"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('wishlist') ?>"><i class="fa-regular fa-heart"></i> Wishlist</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('track-order') ?>"><i class="fa-regular fa-location-dot"></i> Track Order</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= site_url('account/logout') ?>"><i class="fa-regular fa-right-from-bracket"></i> Log out</a></li>
                            </ul>
                        </div>
                        <?php else: ?>
                        <a class="rbt-round-btn rbt-bg-static-gray" href="#!" data-bs-toggle="modal" data-bs-target="#authModal" data-auth-view="signin" aria-label="Sign in">
                            <i class="fa-regular fa-user"></i>
                        </a>
                        <?php endif; ?>
                    </li>

                        
                        <li class="rbt-access-box rbt-scroll-trigger fade_in animation-order-5 rbt-wishlist d-none d-lg-flex tooltips tooltip-distance-lg" data-tooltip="Wishlist" data-tooltip-position="bottom">
                            <a class="rbt-round-btn rbt-bg-static-gray" href="<?= site_url('wishlist') ?>">
                                <i class="fa-regular fa-heart"></i>
                                <div class="access-box-count bloom-wishlist-count" style="display:none">0</div>
                            </a>
                        </li>

                        <li class="rbt-access-box rbt-scroll-trigger fade_in animation-order-5 rbt-mini-cart d-none d-lg-flex tooltips tooltip-distance-lg"
                            data-tooltip="Cart" data-tooltip-position="bottom">
                            <a class="rbt-cart-sidenav-activation rbt-round-btn rbt-bg-static-gray" href="#">
                                <i class="fa-regular fa-bag-shopping"></i>
                                <span class="access-box-count rbt-shiny bloom-cart-count" style="display:none">0</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <!-- Start Search Dropdown  -->
<div class="rbt-search-dropdown rbt-search-dropdown-activation">
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="rbt-component-section-title border-0 p-0 text-center">
                    <h2 class="rbt-title h4"><span class="rbt-bold--text">Search For Products</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form class="rbt-search-form">
                    <div class="input-sectition position-relative w-100 mr--12 mr_sm--4">
                        <input class="search-input" type="text" placeholder="What Are You Looking For?">
                        <i class="fa-sharp fa-regular inner-search-icon fa-magnifying-glass"></i>
                        <button class="media-search-btn media-search-popupactivation">
                            <i class="fa-sharp fa-regular fa-camera"></i>
                        </button>
                    </div>
                    <div class="submit-btn">
                        <a class="rbt-btn btn-md" href="#">Search</a>
                    </div>
                    <div class="rbt-media-search-section">
                        <div class="rbt-media-wrapper">
                            <div class="section-title"><span class="title b1">Find product inspiration with Image
                                    Search</span></div>
                            <div class="rbt-file-upload-container">
                                <input type="file" class="fileInput" multiple hidden>
                                <div class="file-upload-area fileUploadArea">
                                    <div class="file-upload-content">
                                        <span class="rbt-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                                        <p class="rbt-title">Drag & Drop Files Here <span
                                                class="rbt-text-color-gray-400">Or</span></p>
                                        <button class="browseFilesButton rbt-btn rbt-btn-sm">Browse Files</button>
                                    </div>
                                    <div class="fileList file-list"></div>
                                </div>
                                <p class="fileCount">0 of 10</p>
                            </div>
                            <div class="rbt-copy-link-part rbt-text-copy-activation">
                                <input class="rbt-copy-value-field" type="text"
                                    value="https://unimart.template/wishlist" readonly>
                                <button class="rbt-btn rbt-btn-xs has-left-icon rbt-copy-btn" data-tooltip="Copy">
                                    <i class="fa-regular fa-copy"></i>
                                    <span class="rbt-btn-text">Copy</span>
                                </button>
                            </div>
                            <button type="button" class="rbt-round-btn rbt-ms-dismiss-btn">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="rbt-ms-dismiss-outsider"></a>
                </form>
            </div>
        </div>

        <div class="rbt-search-scroll-vertical-wrapper rbt-scroll-vertical">
            <div class="inner">
                <div class="row row--0">
                    <div class="col-lg-12">
                        <div class="border-0 p-0 text-left title-sm-fsize">
                            <h2 class="title"><span class="rbt-bold--text">Popular searches</span></h2>
                        </div>
                    </div>

                    <div class="rbt-search-list-wrapper rbt-tag-list rbt-tag-list-rounded-lg">
                        <a href="#">Fashion</a>
                        <a href="#">Interior</a>
                        <a href="#">Nature</a>
                        <a href="#">Jewellery</a>
                        <a href="#">Art</a>
                        <a href="#">Aliexpress</a>
                        <a href="#">Technology</a>
                        <a href="#">Texture</a>
                        <a href="#">Architecture</a>
                        <a href="#">Business</a>
                        <a href="#">Jewellery</a>
                        <a href="#">Aliexpress</a>
                    </div>
                </div>

                <div class="rbt-separator-mid ptb_sm--12 ptb--24">
                    <hr class="rbt-separator m-0">
                </div>

                <!-- Start Card Area -->
                <div class="row row--0">
                    <div class="col-lg-12">
                        <div class="border-0 p-0 text-left title-sm-fsize">
                            <h2 class="title"><span class="rbt-bold--text">Trending Products</span></h2>
                        </div>
                    </div>
                </div>

                <div class="row row--12 m--0 mt_dec--24">

                    <!-- Start Single Card  -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mt--24 mt_sm--16">
                        <div class="rbt-card rbt-product-card">
                            <div class="inner rbt-scroll-trigger fade_in animation-order-1">
                                <div class="rbt-card-img rbt-has-hover-img rbt-bg-color-default">
                                    <a href="product-single-default.html">
                                        <img class="rbt-prd-img"
                                            src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-01-a-1.webp"
                                            alt="Card Image">
                                        <img class="rbt-hover-img"
                                            src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-01-a-1-hover.webp"
                                            alt="Card Image">
                                    </a>
                                    <div
                                        class="rbt-product-badge rbt-product-badge-bg-danger border-rounded rbt-content-top-left">
                                        Hot
                                    </div>
                                    <div
                                        class="rbt-product-badge rbt-product-badge-bg-secondary-gradient border-rounded rbt-content-top-left">
                                        Best Seller</div>
                                    <div class="rbt-quick-btn-grp has-mixup-midlayer bottom-right--position">
                                        <button class="rbt-search-btn rbt-quick-btn tooltips" type="button"
                                            data-bs-toggle="modal" data-bs-target="#quickviewModal"
                                            data-tooltip="Quick View" data-tooltip-position="left"><i
                                                class="fa-regular fa-magnifying-glass-plus"></i></button>
                                        <button class="rbt-wishlisted-btn rbt-quick-btn tooltips" type="button"
                                            data-bs-toggle="modal" data-bs-target="#wishlistModal"
                                            data-tooltip="Add to wishlist" data-tooltip-position="left"><i
                                                class="fa-regular fa-heart"></i></button>
                                    </div>
                                </div>
                                <div class="rbt-card-body">
                                    <div class="rbt-color-select-area">
                                        <ul class="rbt-switcher-color-list product-switcher-activation">
                                            <li class="active"><a class="rbt-switcher--color tooltips"
                                                    data-switcher-color="#2B2B2B"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-01-a-1.webp"
                                                    data-tooltip="Black" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                            <li><a class="rbt-switcher--color tooltips " data-switcher-color="#a09fa4"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-01-a-2.webp"
                                                    data-tooltip="Red" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                            <li><a class="rbt-switcher--color tooltips" data-switcher-color="#cc999d"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-01-a-3.webp"
                                                    data-tooltip="Pink" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                        </ul>
                                        <a class="prd-link-text" href="product-single-default.html">+12 More Items</a>
                                    </div>
                                    <a href="shop-by-categories.html"
                                        class="rbt-card-subtitle rbt-card-catagories-text">Headphones &
                                        Music</a>
                                    <h3 class="rbt-card-title h6"><a href="product-single-default.html">Samsung Quiet
                                            Comfort Noise
                                            Cancelling
                                            Earbuds - Black</a></h3>
                                    <div class="rbt-card-rating">
                                        <ul class="rbt-rating-icon-list">
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                        </ul>
                                        <p class="rating-digit">(30)</p>
                                        <div class="rbt-text-swiper-container rbt-arrow-vertical">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                class="fa-solid fa-bag-shopping"></i></span>
                                                        90+ Sold Recently
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                class="fa-solid fa-truck"></i></span>
                                                        Free shipping
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                class="fa-solid fa-rotate-left"></i></span>
                                                        7 Days Return Plicy
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rbt-verticle-arrow rbt-arrow-prev">
                                                <i class="fa-regular fa-chevron-up"></i>
                                            </div>
                                            <div class="rbt-verticle-arrow rbt-arrow-next">
                                                <i class="fa-regular fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pricing-part">
                                        <del class="price-text">PKR 295.00</del>
                                        <span class="price-text">PKR 179.98</span>
                                        <span class="rbt-offer-badge">-30%</span>
                                        <div
                                            class="rbt-badge rbt-badge-bg-green rbt-badge-border rbt-badge-small rbt-badge-rounded">
                                            12
                                            in
                                            Stock</div>
                                    </div>
                                    <div class="rbt-prd-qty-area">
                                        <p class="prd-qty-txt">Only <strong>97</strong> pc left</p>
                                        <div class="progress" role="progressbar" aria-label="Shipping-progress"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar w-50"></div>
                                        </div>
                                    </div>
                                    <div class="prd-btn-grp">
                                        <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block has-left-icon rbt-cart-sidenav-activation"
                                            href="#"><i class="fa-regular fa-cart-shopping"></i> Add To Cart</a>
                                        <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block rbt-btn-transparent has-left-icon rbt-compare-btn-activation rbt-compare-bottom-sidenav-activation"
                                            href="#"><i class="fa-regular fa-file-plus-minus"></i>Add To Compare</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Card  -->

                    <!-- Start Single Card  -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mt--24 mt_sm--16">
                        <div class="rbt-card rbt-product-card">
                            <div class="inner rbt-scroll-trigger fade_in animation-order-2">
                                <div class="rbt-card-img rbt-has-hover-img rbt-bg-color-default">
                                    <a href="product-single-default.html">
                                        <img class="rbt-prd-img"
                                            src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-04-a-1.webp"
                                            alt="Card Image">
                                        <img class="rbt-hover-img"
                                            src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-04-a-1-hover.webp"
                                            alt="Card Image">
                                    </a>
                                    <div
                                        class="rbt-product-badge rbt-product-badge-bg-secondary-gradient border-rounded rbt-content-top-left">
                                        Best Seller</div>
                                    <div class="rbt-quick-btn-grp has-mixup-midlayer bottom-right--position">
                                        <button class="rbt-search-btn rbt-quick-btn tooltips" type="button"
                                            data-bs-toggle="modal" data-bs-target="#quickviewModal"
                                            data-tooltip="Quick View" data-tooltip-position="left"><i
                                                class="fa-regular fa-magnifying-glass-plus"></i></button>
                                        <button class="rbt-wishlisted-btn rbt-quick-btn tooltips" type="button"
                                            data-bs-toggle="modal" data-bs-target="#wishlistModal"
                                            data-tooltip="Add to wishlist" data-tooltip-position="left"><i
                                                class="fa-regular fa-heart"></i></button>
                                    </div>
                                </div>
                                <div class="rbt-card-body">
                                    <div class="rbt-color-select-area">
                                        <ul class="rbt-switcher-color-list product-switcher-activation">
                                            <li class="active"><a class="rbt-switcher--color tooltips"
                                                    data-switcher-color="#bdb6d6"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-04-a-1.webp"
                                                    data-tooltip="Purple" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                            <li><a class="rbt-switcher--color tooltips " data-switcher-color="#486788"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-04-a-2.webp"
                                                    data-tooltip="Blue" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                            <li><a class="rbt-switcher--color tooltips" data-switcher-color="#1a1a1a"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-04-a-3.webp"
                                                    data-tooltip="Black" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                        </ul>
                                        <a class="prd-link-text" href="product-single-default.html">+12 More Items</a>
                                    </div>
                                    <a href="shop-by-categories.html"
                                        class="rbt-card-subtitle rbt-card-catagories-text">Headphones &
                                        Music</a>
                                    <h3 class="rbt-card-title h6"><a href="product-single-default.html">Keurig K-Duo
                                            Bose
                                            Noise Cancelling
                                            Headphones 700 </a></h3>
                                    <div class="rbt-card-rating">
                                        <ul class="rbt-rating-icon-list">
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                        </ul>
                                        <p class="rating-digit">(10)</p>
                                        <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                    class="fa-solid fa-bag-shopping"></i></span>
                                            90+ Sold Recently
                                        </div>
                                    </div>
                                    <div class="pricing-part">
                                        <del class="price-text">PKR 295.00</del>
                                        <span class="price-text">PKR 179.98</span>
                                    </div>
                                    <div class="rbt-prd-qty-area">
                                        <p class="prd-qty-txt">Only <strong>97</strong> pc left</p>
                                        <div class="progress" role="progressbar" aria-label="Shipping-progress"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar w-50"></div>
                                        </div>
                                    </div>
                                    <div class="prd-btn-grp">
                                        <button
                                            class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block has-left-icon rbt-cart-sidenav-activation"><i
                                                class="fa-regular fa-cart-shopping"></i> Add To Cart</button>
                                        <button
                                            class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block rbt-btn-transparent has-left-icon rbt-compare-btn-activation"
                                            type="button" data-bs-toggle="modal"
                                            data-bs-target="#addedcomparisonModal"><i
                                                class="fa-regular fa-file-plus-minus"></i>Add To Compare</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Card  -->

                    <!-- Start Single Card  -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mt--24 mt_sm--16">
                        <div class="rbt-card rbt-product-card">
                            <div class="inner rbt-scroll-trigger fade_in animation-order-4">
                                <div class="rbt-card-img rbt-has-hover-img rbt-bg-color-default">
                                    <a href="product-single-default.html">
                                        <img class="rbt-prd-img"
                                            src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-08-a-1.webp"
                                            alt="Card Image">
                                        <img class="rbt-hover-img"
                                            src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-08-a-1-hover.webp"
                                            alt="Card Image">
                                    </a>
                                    <div
                                        class="rbt-product-badge rbt-product-badge-bg-green border-rounded rbt-content-top-left">
                                        New
                                    </div>
                                    <div class="rbt-quick-btn-grp has-mixup-midlayer bottom-right--position">
                                        <button class="rbt-search-btn rbt-quick-btn tooltips" type="button"
                                            data-bs-toggle="modal" data-bs-target="#quickviewModal"
                                            data-tooltip="Quick View" data-tooltip-position="left"><i
                                                class="fa-regular fa-magnifying-glass-plus"></i></button>
                                        <button class="rbt-wishlisted-btn rbt-quick-btn tooltips" type="button"
                                            data-bs-toggle="modal" data-bs-target="#wishlistModal"
                                            data-tooltip="Add to wishlist" data-tooltip-position="left"><i
                                                class="fa-regular fa-heart"></i></button>
                                    </div>
                                </div>
                                <div class="rbt-card-body">
                                    <div class="rbt-color-select-area">
                                        <ul class="rbt-switcher-color-list product-switcher-activation">
                                            <li class="active"><a class="rbt-switcher--color tooltips"
                                                    data-switcher-color="#202020"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-08-a-1.webp"
                                                    data-tooltip="Black" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                            <li><a class="rbt-switcher--color tooltips " data-switcher-color="#9e9e9e"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-08-a-2.webp"
                                                    data-tooltip="Gray" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                            <li><a class="rbt-switcher--color tooltips" data-switcher-color="#171717"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-08-a-3.webp"
                                                    data-tooltip="Light Black" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                        </ul>
                                        <a class="prd-link-text" href="product-single-default.html">+12 More Items</a>
                                    </div>
                                    <a href="shop-by-categories.html"
                                        class="rbt-card-subtitle rbt-card-catagories-text">Electronics &
                                        Camera</a>
                                    <h3 class="rbt-card-title h6"><a href="product-single-default.html">GoPro HERO 11 4K
                                            Action Camera with
                                            SD
                                            Card</a></h3>
                                    <div class="rbt-card-rating">
                                        <ul class="rbt-rating-icon-list">
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                        </ul>
                                        <p class="rating-digit">(16)</p>
                                        <div class="rbt-text-swiper-container rbt-arrow-vertical">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                class="fa-solid fa-bag-shopping"></i></span>
                                                        90+ Sold Recently
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                class="fa-solid fa-truck"></i></span>
                                                        Free shipping
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                class="fa-solid fa-rotate-left"></i></span>
                                                        7 Days Return Plicy
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rbt-verticle-arrow rbt-arrow-prev">
                                                <i class="fa-regular fa-chevron-up"></i>
                                            </div>
                                            <div class="rbt-verticle-arrow rbt-arrow-next">
                                                <i class="fa-regular fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pricing-part">
                                        <del class="price-text">PKR 295.00</del>
                                        <span class="price-text">PKR 179.98</span>
                                        <span class="rbt-offer-badge">-30%</span>
                                        <div
                                            class="rbt-badge rbt-badge-bg-green rbt-badge-border rbt-badge-small rbt-badge-rounded">
                                            12
                                            in
                                            Stock</div>
                                    </div>
                                    <div class="rbt-prd-qty-area">
                                        <p class="prd-qty-txt">Only <strong>97</strong> pc left</p>
                                        <div class="progress" role="progressbar" aria-label="Shipping-progress"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar w-50"></div>
                                        </div>
                                    </div>
                                    <div class="prd-btn-grp">
                                        <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block has-left-icon rbt-cart-sidenav-activation"
                                            href="#"><i class="fa-regular fa-cart-shopping"></i> Add To Cart</a>
                                        <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block rbt-btn-transparent has-left-icon rbt-compare-btn-activation"
                                            href="#"><i class="fa-regular fa-file-plus-minus"></i>Add To Compare</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Card  -->

                    <!-- Start Single Card  -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mt--24 mt_sm--16">
                        <div class="rbt-card rbt-product-card">
                            <div class="inner rbt-scroll-trigger fade_in animation-order-4">
                                <div class="rbt-card-img rbt-has-hover-img rbt-bg-color-default">
                                    <a href="product-single-default.html">
                                        <img class="rbt-prd-img"
                                            src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-07-a-1.webp"
                                            alt="Card Image">
                                        <img class="rbt-hover-img"
                                            src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-07-a-1-hover.webp"
                                            alt="Card Image">
                                    </a>
                                    <div
                                        class="rbt-product-badge rbt-product-badge-bg-yellow border-rounded rbt-content-top-left">
                                        Trending
                                    </div>
                                    <div class="rbt-quick-btn-grp has-mixup-midlayer bottom-right--position">
                                        <button class="rbt-search-btn rbt-quick-btn tooltips" type="button"
                                            data-bs-toggle="modal" data-bs-target="#quickviewModal"
                                            data-tooltip="Quick View" data-tooltip-position="left"><i
                                                class="fa-regular fa-magnifying-glass-plus"></i></button>
                                        <button class="rbt-wishlisted-btn rbt-quick-btn tooltips" type="button"
                                            data-bs-toggle="modal" data-bs-target="#wishlistModal"
                                            data-tooltip="Add to wishlist" data-tooltip-position="left"><i
                                                class="fa-regular fa-heart"></i></button>
                                    </div>
                                </div>
                                <div class="rbt-card-body">
                                    <div class="rbt-color-select-area">
                                        <ul class="rbt-switcher-color-list product-switcher-activation">
                                            <li class="active"><a class="rbt-switcher--color tooltips"
                                                    data-switcher-color="#afb1b3"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-07-a-1.webp"
                                                    data-tooltip="Gray" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                            <li><a class="rbt-switcher--color tooltips " data-switcher-color="#7796b9"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-07-a-2.webp"
                                                    data-tooltip="Sky Blue" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                            <li><a class="rbt-switcher--color tooltips" data-switcher-color="#b84a5f"
                                                    data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-07-a-3.webp"
                                                    data-tooltip="Pink Red" data-tooltip-position="top" href="#">
                                                    <div class="rbt-color-circle"></div>
                                                </a></li>
                                        </ul>
                                        <a class="prd-link-text" href="product-single-default.html">+12 More Items</a>
                                    </div>
                                    <a href="shop-by-categories.html"
                                        class="rbt-card-subtitle rbt-card-catagories-text">Tablets &
                                        Accessories</a>
                                    <h3 class="rbt-card-title h6"><a href="product-single-default.html">Samsung Galaxy
                                            N-569 Tab S7 with
                                            Stylish – 8GB/128GB</a></h3>
                                    <div class="rbt-card-rating">
                                        <ul class="rbt-rating-icon-list">
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                        </ul>
                                        <p class="rating-digit">(25)</p>
                                        <diV class="rbt-text-group"> <span class="icon mr--4"><i
                                                    class="fa-solid fa-bag-shopping"></i></span>
                                            90+ Sold Recently
                                        </diV>
                                    </div>
                                    <div class="pricing-part">
                                        <del class="price-text">PKR 295.00</del>
                                        <span class="price-text">PKR 179.98</span>
                                    </div>
                                    <div class="rbt-prd-qty-area">
                                        <p class="prd-qty-txt">Only <strong>97</strong> pc left</p>
                                        <div class="progress" role="progressbar" aria-label="Shipping-progress"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar w-50"></div>
                                        </div>
                                    </div>
                                    <div class="prd-btn-grp">
                                        <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block has-left-icon rbt-cart-sidenav-activation"
                                            href="#"><i class="fa-regular fa-cart-shopping"></i> Add To Cart</a>
                                        <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block rbt-btn-transparent has-left-icon rbt-compare-btn-activation"
                                            href="#"><i class="fa-regular fa-file-plus-minus"></i>Add To Compare</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Card  -->

                </div>
                <!-- End Card Area -->
            </div>
        </div>

    </div>
    <a href="javascript:void(0);" class="media-upload-close-area"></a>
</div>
<!-- End Search Dropdown  -->
<a href="javascript:void(0);" class="close_search_dropdown"></a>
    </div>
</div>
    <!-- Start Header Mid -->
<div class="rbt-header-middle position-relative rbt-header-mid-3 rbt-bg-color-white d-none d-xl-block">
    <div class="container">
        <div class="rbt-header-sec align-items-center @@flexDirection">

            <div class="rbt-main-navigation d-none d-xl-block">
                <nav class="rbt-mainmenu-nav">
    <ul class="mainmenu has-nav-bg-shape-hover">
        <?php if (false) : // Demos nav tab hidden for now ?>
<li class="with-rbt-megamenu has-menu-child-item position-static rbt-initial-odo-count">
            <a href="#!">Demos <i class="fa-regular fa-chevron-down"></i></a>
            <!-- Start Mega Menu  -->
<div class="rbt-megamenu rbt-prsentation-megamenu rbt-width-fullscreen">
    <div class="rbt-megamenu-wrapper">
        <div class="container p_sm--0 p_md--0 p_lg--0">
            <div class="row row--12 home-plesentation-wrapper single-dropdown-menu-presentation mt_dec--24 mb_sm--0">

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-1">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-electronics.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-1.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-electronics.html">Electronics One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-2">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="<?php echo site_url('/'); ?>"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-5.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="<?php echo site_url('/'); ?>">Fashion One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-3">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-furniture.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-8.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-furniture.html">Furniture One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-4">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-printing-service.html"><img
                                        src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-6.webp" alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-printing-service.html">Print Service One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-5">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-cosmetic-beauty.html"><img
                                        src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-2.webp" alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-cosmetic-beauty.html">Cosmetic Beauty One</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-6">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-sports.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-9.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-sports.html">Sports One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-7">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-glass.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-3.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-glass.html">Glass One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-8">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-phone-case.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-4.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-phone-case.html">Phone One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-9">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-accessories.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-10.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-accessories.html">Accessories One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-10">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-jewellery.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-11.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-jewellery.html">jewellery One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

            </div>

            <div class="load-demo-btn text-center pt--24 pt_sm--0 pt_lg--0 position-relative">
                <a href="<?= site_url('home') ?>"
                    class="rbt-btn-grp rbt-has-separator-shape justify-content-center rbt-scroll-trigger fade_in animation-order-2 pb_sm--0">
                    <span
                        class="rbt-btn rbt-btn-single rbt-btn rbt-marquee-btn marquee-auto rbt-btn-md has-primary-overlay has-no-hover-transform">
                        <span data-text="View All The Trending Collection">
                            VIEW ALL DEMOS (81+) New drops every month 🔥
                        </span>
                    </span>
                    <span class="rbt-btn rbt-btn-single animated-icon-btn round-sm defalt-primary-bg p--0">
                        <span class="animated-icon">
                            <svg class="icon_external" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.5 15.5">
                                <g class="icon-wrapper">
                                    <path class="icon-rectangle"
                                        d="m7.75,0c.41,0,.75.34.75.75s-.34.75-.75.75H3.08c-.87,0-1.58.71-1.58,1.58v9.33c0,.87.71,1.58,1.58,1.58h9.33c.87,0,1.58-.71,1.58-1.58v-4.67c0-.41.34-.75.75-.75s.75.34.75.75v4.67c0,1.7-1.38,3.08-3.08,3.08H3.08c-1.7,0-3.08-1.38-3.08-3.08V3.08C0,1.38,1.38,0,3.08,0h4.67Z"
                                        stroke-width="0">
                                    </path>
                                    <path class="icon-arrow-el-one"
                                        d="m15.5,0v4.29c0,.41-.34.75-.75.75s-.75-.34-.75-.75V1.5h-2.75c-.38,0-.69-.28-.74-.65v-.1c0-.41.33-.75.74-.75h4.25Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.5 0" transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                    <path class="icon-arrow-line-one"
                                        d="m14.22.22c.29-.29.77-.29,1.06,0,.29.29.29.77,0,1.06L5.95,10.61c-.29.29-.77.29-1.06,0-.29-.29-.29-.77,0-1.06.4-.4.76-.76,1.09-1.09l.47-.47c.37-.37.7-.7,1-1l.34-.34.46-.46.41-.41c.74-.74,1.29-1.29,2.09-2.09l.61-.61c.17-.17.34-.34.53-.53.13-.13.25-.25.36-.36l.59-.59c.08-.08.16-.16.23-.23l.36-.36c.1-.1.19-.19.26-.26l.42-.42s.07-.07.11-.11Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.4975004196167 0.002499997615814209"
                                        transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                    <path class="icon-arrow-el-two"
                                        d="m15.5,0v4.29c0,.41-.34.75-.75.75s-.75-.34-.75-.75V1.5h-2.75c-.38,0-.69-.28-.74-.65v-.1c0-.41.33-.75.74-.75h4.25Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.5 0" transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                    <path class="icon-arrow-line-two"
                                        d="m14.22.22c.29-.29.77-.29,1.06,0,.29.29.29.77,0,1.06L5.95,10.61c-.29.29-.77.29-1.06,0-.29-.29-.29-.77,0-1.06.4-.4.76-.76,1.09-1.09l.47-.47c.37-.37.7-.7,1-1l.34-.34.46-.46.41-.41c.74-.74,1.29-1.29,2.09-2.09l.61-.61c.17-.17.34-.34.53-.53.13-.13.25-.25.36-.36l.59-.59c.08-.08.16-.16.23-.23l.36-.36c.1-.1.19-.19.26-.26l.42-.42s.07-.07.11-.11Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.4975004196167 0.002499997615814209"
                                        transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                </g>
                            </svg>
                        </span>
                    </span>
                </a>
                <span class="rbt-overlay-counter counter-md rbt-scroll-trigger fade_in animation-order-4">
                    <span class="odometer" data-count="100">00</span>
                    <span class="counter-suffix">+</span>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- End Mega Menu  -->
        </li>
<?php endif; ?>


        <?= $this->include('storefront/partials/shop_menu') ?>
        <?= $this->include('storefront/partials/main_menu_links') ?>
    </ul>
</nav>
            </div>

            <div class="rbt-header-sec-col rbt-header-right">
            </div>
        </div>
    </div>
</div>
<!-- End Header Top -->


     
    
    <!-- Start Header Bottom -->
<div class="rbt-header-bottom position-relative rbt-header-bottom-2 rbt-bg-color-gray-light d-none d-xl-flex ptb--16">
    <div class="container">
        <div class="rbt-inf-box-wrapper">
            <ul class="rbt-inf-box-wrapper-list justify-content-center">
    <li>
        <div class="rbt-inf-box  rbt-scroll-trigger fade_in animation-order-1">
            <div class="rbt-inf-box-icon">
                <i class="fa-light fa-truck-fast"></i>
            </div>
            <div class="rbt-inf-box-content">
                <h2 class="rbt-inf-box-title">Free Shipping</h2>
                <p class="rbt-inf-box-desc">On orders over PKR 10,000</p>
            </div>
        </div>
    </li>
    <li>
        <div class="rbt-inf-box  rbt-scroll-trigger fade_in animation-order-2">
            <div class="rbt-inf-box-icon">
                <i class="fa-light fa-headset"></i>
            </div>
            <div class="rbt-inf-box-content">
                <h2 class="rbt-inf-box-title">Quality Support</h2>
                <p class="rbt-inf-box-desc">24/7 online feedback</p>
            </div>
        </div>
    </li>
    <li>
        <div class="rbt-inf-box  rbt-scroll-trigger fade_in animation-order-3">
            <div class="rbt-inf-box-icon">
                <i class="fa-light fa-box"></i>
            </div>
            <div class="rbt-inf-box-content">
                <h2 class="rbt-inf-box-title">Return & Refund</h2>
                <p class="rbt-inf-box-desc">Return money within 30 days</p>
            </div>
        </div>
    </li>
    <li>
        <div class="rbt-inf-box  rbt-scroll-trigger fade_in animation-order-4">
            <div class="rbt-inf-box-icon">
                <i class="fa-light fa-ticket"></i>
            </div>
            <div class="rbt-inf-box-content">
                <h2 class="rbt-inf-box-title">Loyalty Discounts</h2>
                <p class="rbt-inf-box-desc">Sign up to avail loyalty discounts</p>
            </div>
        </div>
    </li>
</ul>
        </div>
    </div>
</div>
<!-- End Header Bottom -->



    <div class="rbt-header-common-sticky-activation rbt-header-wrapper-common justify-content-between rbt-bg-color-white">
    <?php if (! session('customer_id')): ?>
    <div class="rbt-header-campaign rbt-header-campaign-1 rbt-header-top-news rbt-topbar-bg-img rbt-topbar-bg-one w-100">
        <div class="rbt-corner-portion-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="inner justify-content-center">
                            <div class="rbt-text-swiper-container rbt-arrow-vertical">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="rbt-fancy-item fancy-menu-text fancy-menu-start">
                                            <p class="rbt-fancy-text rbt-text-color-white">Register now &amp; earn Bloom loyalty points on every order.
                                                <a class="rbt-text-color-white" href="#!" data-bs-toggle="modal" data-bs-target="#authModal" data-auth-view="signin">Sign Up / Sign In</a>
                                            </p>
                                        </div>
                                    </div><div class="swiper-slide">
                                        <div class="rbt-fancy-item fancy-menu-text fancy-menu-start">
                                            <p class="rbt-fancy-text rbt-text-color-white">Members unlock exclusive discounts and early access to sales.
                                                <a class="rbt-text-color-white" href="#!" data-bs-toggle="modal" data-bs-target="#authModal" data-auth-view="signin">Join Free</a>
                                            </p>
                                        </div>
                                    </div><div class="swiper-slide">
                                        <div class="rbt-fancy-item fancy-menu-text fancy-menu-start">
                                            <p class="rbt-fancy-text rbt-text-color-white">Create your account, collect reward points and save more on kids' fashion.
                                                <a class="rbt-text-color-white" href="#!" data-bs-toggle="modal" data-bs-target="#authModal" data-auth-view="signin">Get Started</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="rbt-verticle-arrow rbt-text-color-white rbt-arrow-prev">
                                    <i class="fa-regular fa-chevron-up"></i>
                                </div>
                                <div class="rbt-verticle-arrow rbt-text-color-white rbt-arrow-next">
                                    <i class="fa-regular fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="icon-close position-right">
            <button class="rbt-round-btn btn-white-off bgsection-activation" aria-label="Close Button">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="mainbar-row rbt-mainbar-row-md-height @@navigationEnd align-items-center">
            <div class="header-left">
                <div class="rbt-header-content d-flex">
                    <div class="header-info p-0 d-none d-xxl-flex mr--24">
                        <a class="rbt-offcanvas-trigger-btn rbt-cat-offcanvas-activation rbt-burger-menu-bar" href="#!">
                            <div class="rbt-burger-menu-bar-wrapper">
                                <i class="rbt-line-btn">
                                    <span class="rbt-lines"></span>
                                </i>
                                <i class="rbt-line-btn rbt-hover-effect">
                                    <span class="rbt-lines"></span>
                                </i>
                            </div>
                        </a>
                    </div>
                    <div class="header-info d-xl-block d-none">
                        <div class="logo rbt-logo-height-sm">
                            <a href="<?= site_url('home') ?>">
                                <img src="<?php echo base_url('assets/frontend/'); ?>images/logo/bloom-logo-header.png" alt="Bloom Kids Wear">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Start Mobile-Menu-Bar -->
                <div class="mobile-menu-bar d-block d-xl-none">
                    <div class="hamberger">
                        <button class="hamberger-button rbt-round-btn">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                    </div>
                </div>
                <!-- Start Mobile-Menu-Bar -->
            </div>

            <div class="header-info d-xl-none d-block">
                <div class="logo">
                    <a href="<?= site_url('home') ?>">
                        <img src="<?php echo base_url('assets/frontend/'); ?>images/logo/bloom-logo-header.png" alt="Bloom Kids Wear">
                    </a>
                </div>
            </div>

            <div class="rbt-header-content d-none d-xl-block">
                <div class="header-info">
                    <nav class="rbt-mainmenu-nav">
    <ul class="mainmenu mainmenu has-nav-bg-shape-hover">
        <?php if (false) : // Demos nav tab hidden for now ?>
<li class="with-rbt-megamenu has-menu-child-item position-static rbt-initial-odo-count">
            <a href="#!">Demos <i class="fa-regular fa-chevron-down"></i></a>
            <!-- Start Mega Menu  -->
<div class="rbt-megamenu rbt-prsentation-megamenu rbt-width-fullscreen">
    <div class="rbt-megamenu-wrapper">
        <div class="container p_sm--0 p_md--0 p_lg--0">
            <div class="row row--12 home-plesentation-wrapper single-dropdown-menu-presentation mt_dec--24 mb_sm--0">

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-1">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-electronics.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-1.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-electronics.html">Electronics One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-2">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="<?php echo site_url('/'); ?>"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-5.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="<?php echo site_url('/'); ?>">Fashion One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-3">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-furniture.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-8.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-furniture.html">Furniture One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-4">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-printing-service.html"><img
                                        src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-6.webp" alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-printing-service.html">Print Service One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-5">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-cosmetic-beauty.html"><img
                                        src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-2.webp" alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-cosmetic-beauty.html">Cosmetic Beauty One</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-6">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-sports.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-9.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-sports.html">Sports One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-7">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-glass.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-3.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-glass.html">Glass One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-8">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-phone-case.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-4.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-phone-case.html">Phone One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-9">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-accessories.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-10.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-accessories.html">Accessories One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-10">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-jewellery.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-11.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-jewellery.html">jewellery One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

            </div>

            <div class="load-demo-btn text-center pt--24 pt_sm--0 pt_lg--0 position-relative">
                <a href="<?= site_url('home') ?>"
                    class="rbt-btn-grp rbt-has-separator-shape justify-content-center rbt-scroll-trigger fade_in animation-order-2 pb_sm--0">
                    <span
                        class="rbt-btn rbt-btn-single rbt-btn rbt-marquee-btn marquee-auto rbt-btn-md has-primary-overlay has-no-hover-transform">
                        <span data-text="View All The Trending Collection">
                            VIEW ALL DEMOS (81+) New drops every month 🔥
                        </span>
                    </span>
                    <span class="rbt-btn rbt-btn-single animated-icon-btn round-sm defalt-primary-bg p--0">
                        <span class="animated-icon">
                            <svg class="icon_external" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.5 15.5">
                                <g class="icon-wrapper">
                                    <path class="icon-rectangle"
                                        d="m7.75,0c.41,0,.75.34.75.75s-.34.75-.75.75H3.08c-.87,0-1.58.71-1.58,1.58v9.33c0,.87.71,1.58,1.58,1.58h9.33c.87,0,1.58-.71,1.58-1.58v-4.67c0-.41.34-.75.75-.75s.75.34.75.75v4.67c0,1.7-1.38,3.08-3.08,3.08H3.08c-1.7,0-3.08-1.38-3.08-3.08V3.08C0,1.38,1.38,0,3.08,0h4.67Z"
                                        stroke-width="0">
                                    </path>
                                    <path class="icon-arrow-el-one"
                                        d="m15.5,0v4.29c0,.41-.34.75-.75.75s-.75-.34-.75-.75V1.5h-2.75c-.38,0-.69-.28-.74-.65v-.1c0-.41.33-.75.74-.75h4.25Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.5 0" transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                    <path class="icon-arrow-line-one"
                                        d="m14.22.22c.29-.29.77-.29,1.06,0,.29.29.29.77,0,1.06L5.95,10.61c-.29.29-.77.29-1.06,0-.29-.29-.29-.77,0-1.06.4-.4.76-.76,1.09-1.09l.47-.47c.37-.37.7-.7,1-1l.34-.34.46-.46.41-.41c.74-.74,1.29-1.29,2.09-2.09l.61-.61c.17-.17.34-.34.53-.53.13-.13.25-.25.36-.36l.59-.59c.08-.08.16-.16.23-.23l.36-.36c.1-.1.19-.19.26-.26l.42-.42s.07-.07.11-.11Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.4975004196167 0.002499997615814209"
                                        transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                    <path class="icon-arrow-el-two"
                                        d="m15.5,0v4.29c0,.41-.34.75-.75.75s-.75-.34-.75-.75V1.5h-2.75c-.38,0-.69-.28-.74-.65v-.1c0-.41.33-.75.74-.75h4.25Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.5 0" transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                    <path class="icon-arrow-line-two"
                                        d="m14.22.22c.29-.29.77-.29,1.06,0,.29.29.29.77,0,1.06L5.95,10.61c-.29.29-.77.29-1.06,0-.29-.29-.29-.77,0-1.06.4-.4.76-.76,1.09-1.09l.47-.47c.37-.37.7-.7,1-1l.34-.34.46-.46.41-.41c.74-.74,1.29-1.29,2.09-2.09l.61-.61c.17-.17.34-.34.53-.53.13-.13.25-.25.36-.36l.59-.59c.08-.08.16-.16.23-.23l.36-.36c.1-.1.19-.19.26-.26l.42-.42s.07-.07.11-.11Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.4975004196167 0.002499997615814209"
                                        transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                </g>
                            </svg>
                        </span>
                    </span>
                </a>
                <span class="rbt-overlay-counter counter-md rbt-scroll-trigger fade_in animation-order-4">
                    <span class="odometer" data-count="100">00</span>
                    <span class="counter-suffix">+</span>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- End Mega Menu  -->
        </li>
<?php endif; ?>


        <?= $this->include('storefront/partials/shop_menu') ?>
        <?= $this->include('storefront/partials/main_menu_links') ?>
    </ul>
</nav>
                </div>
            </div>

            <div class="header-right">
                <!-- Navbar Icons -->
                <ul class="rbt-quick-access rbt-gap--12">

                    <li class="rbt-access-box rbt-scroll-trigger fade_in animation-order-3 tooltips tooltip-distance-lg"
                        data-tooltip="Search" data-tooltip-position="bottom">
                        <a class="rbt-round-btn has-rbt-md-fsize rbt-common-search-trigger-active rbt-modern-close-btn"
                            href="#">
                            <i class="fa-regular fa-search search-icon"></i>
                            <div class="modern-close-wrapper"></div>
                        </a>
                    </li>

                    <li class="rbt-access-box rbt-scroll-trigger fade_in animation-order-3 d-none d-lg-flex position-relative bloom-account-li">
                        <?php if (session('customer_id')): ?>
                        <div>
                            <a class="rbt-round-btn rbt-bg-static-gray" href="#!" role="button" data-bloom-account-toggle aria-expanded="false" aria-label="My account">
                                <i class="fa-regular fa-user"></i>
                            </a>
                            <ul class="bloom-account-menu list-unstyled m-0">
                                <li class="bloom-account-menu-head"><strong><?= esc(session('customer_name')) ?></strong><small><?= esc(session('customer_email')) ?></small></li>
                                <li><a class="dropdown-item" href="<?= site_url('account') ?>"><i class="fa-regular fa-user-vneck"></i> Account Information</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('account/orders') ?>"><i class="fa-regular fa-cart-shopping-fast"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('wishlist') ?>"><i class="fa-regular fa-heart"></i> Wishlist</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('track-order') ?>"><i class="fa-regular fa-location-dot"></i> Track Order</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= site_url('account/logout') ?>"><i class="fa-regular fa-right-from-bracket"></i> Log out</a></li>
                            </ul>
                        </div>
                        <?php else: ?>
                        <a class="rbt-round-btn rbt-bg-static-gray" href="#!" data-bs-toggle="modal" data-bs-target="#authModal" data-auth-view="signin" aria-label="Sign in">
                            <i class="fa-regular fa-user"></i>
                        </a>
                        <?php endif; ?>
                    </li>

                    


                    <li class="rbt-access-box rbt-scroll-trigger fade_in animation-order-5 rbt-wishlist d-none d-lg-flex tooltips tooltip-distance-lg" data-tooltip="Wishlist" data-tooltip-position="bottom">
                            <a class="rbt-round-btn rbt-bg-static-gray" href="<?= site_url('wishlist') ?>">
                                <i class="fa-regular fa-heart"></i>
                                <div class="access-box-count bloom-wishlist-count" style="display:none">0</div>
                            </a>
                        </li>


                    <li class="rbt-access-box rbt-scroll-trigger fade_in animation-order-5 rbt-access-box-has-bg-hover rbt-mini-cart tooltips tooltip-distance-lg"
                        data-tooltip="Cart" data-tooltip-position="bottom">
                        <a class="rbt-cart-sidenav-activation" href="#!">
                            <span class="rbt-round-btn has-rbt-md-fsize">
                                <i class="fa-regular fa-bag-shopping"></i>
                                <span class="access-box-count rbt-shiny bloom-cart-count" style="display:none">0</span>
                            </span>
                            <div class="content ml--4">
                                <span class="title-text bloom-cart-total">PKR 0</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <!-- Start Search Dropdown  -->
    <div class="rbt-search-dropdown rbt-common-search-dropdown-activation">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rbt-component-section-title border-0 p-0 text-center">
                        <h2 class="rbt-title text-start text-md-center"><span class="rbt-bold--text">Search For
                                Products</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form class="rbt-search-form">
                        <div class="input-sectition position-relative w-100 mr--12 mr_sm--4">
                            <input class="search-input" type="text" placeholder="What Are You Looking For?">
                            <i class="fa-sharp fa-regular inner-search-icon fa-magnifying-glass"></i>
                            <button class="media-search-btn media-search-popupactivation">
                                <i class="fa-sharp fa-regular fa-camera"></i>
                            </button>
                        </div>
                        <div class="submit-btn">
                            <a class="rbt-btn btn-md" href="#">Search</a>
                        </div>
                        <div class="rbt-media-search-section">
                            <div class="rbt-media-wrapper">
                                <div class="section-title"><span class="title b1">Find product inspiration with Image
                                        Search</span></div>
                                <div class="rbt-file-upload-container">
                                    <input type="file" class="fileInput" multiple hidden>
                                    <div class="file-upload-area fileUploadArea">
                                        <div class="file-upload-content">
                                            <span class="rbt-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                                            <p class="rbt-title">Drag & Drop Files Here <span
                                                    class="rbt-text-color-gray-400">Or</span></p>
                                            <button class="browseFilesButton rbt-btn rbt-btn-sm">Browse Files</button>
                                        </div>
                                        <div class="fileList file-list"></div>
                                    </div>
                                    <p class="fileCount">0 of 10</p>
                                </div>
                                <div class="rbt-copy-link-part rbt-text-copy-activation">
                                    <input class="rbt-copy-value-field" type="text"
                                        value="https://unimart.template/wishlist" readonly>
                                    <button class="rbt-btn rbt-btn-xs has-left-icon rbt-copy-btn" data-tooltip="Copy">
                                        <i class="fa-regular fa-copy"></i>
                                        <span class="rbt-btn-text">Copy</span>
                                    </button>
                                </div>
                                <button type="button" class="rbt-round-btn rbt-ms-dismiss-btn">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="rbt-ms-dismiss-outsider"></a>
                    </form>
                </div>
            </div>
            <div class="rbt-search-scroll-vertical-wrapper rbt-scroll-vertical">
                <div class="inner">
                    <div class="row row--0">
                        <div class="col-lg-12">
                            <div class="border-0 p-0 text-left title-sm-fsize">
                                <h2 class="title"><span class="rbt-bold--text">Popular searches</span></h2>
                            </div>
                        </div>

                        <div class="rbt-search-list-wrapper rbt-tag-list rbt-tag-list-rounded-lg">
                            <a href="#">Fashion</a>
                            <a href="#">Interior</a>
                            <a href="#">Nature</a>
                            <a href="#">Jewellery</a>
                            <a href="#">Art</a>
                            <a href="#">Aliexpress</a>
                            <a href="#">Technology</a>
                            <a href="#">Texture</a>
                            <a href="#">Architecture</a>
                            <a href="#">Business</a>
                            <a href="#">Jewellery</a>
                            <a href="#">Aliexpress</a>
                        </div>
                    </div>

                    <div class="rbt-separator-mid ptb--24">
                        <hr class="rbt-separator m-0">
                    </div>

                    <!-- Start Card Area -->
                    <div class="row row--0">
                        <div class="col-lg-12">
                            <div class="border-0 p-0 text-left title-sm-fsize">
                                <h2 class="title"><span class="rbt-bold--text">Trending Products</span></h2>
                            </div>
                        </div>
                    </div>

                    <div class="row row--12 m--0 mt_dec--24">

                        <!-- Start Single Card  -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mt--24 mt_sm--16">
                            <div class="rbt-card rbt-product-card">
                                <div class="inner rbt-scroll-trigger fade_in animation-order-1">
                                    <div class="rbt-card-img rbt-has-hover-img rbt-bg-color-default">
                                        <a href="product-single-default.html">
                                            <img class="rbt-prd-img"
                                                src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-01-a-1.webp"
                                                alt="Card Image">
                                            <img class="rbt-hover-img"
                                                src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-01-a-1-hover.webp"
                                                alt="Card Image">
                                        </a>
                                        <div
                                            class="rbt-product-badge rbt-product-badge-bg-danger border-rounded rbt-content-top-left">
                                            Hot</div>
                                        <div
                                            class="rbt-product-badge rbt-product-badge-bg-secondary-gradient border-rounded rbt-content-top-left">
                                            Best Seller</div>
                                        <div class="rbt-quick-btn-grp has-mixup-midlayer bottom-right--position">
                                            <button class="rbt-search-btn rbt-quick-btn tooltips" type="button"
                                                data-bs-toggle="modal" data-bs-target="#quickviewModal"
                                                data-tooltip="Quick View" data-tooltip-position="left"><i
                                                    class="fa-regular fa-magnifying-glass-plus"></i></button>
                                            <button class="rbt-wishlisted-btn rbt-quick-btn tooltips" type="button"
                                                data-bs-toggle="modal" data-bs-target="#wishlistModal"
                                                data-tooltip="Add to wishlist" data-tooltip-position="left"><i
                                                    class="fa-regular fa-heart"></i></button>
                                        </div>
                                    </div>
                                    <div class="rbt-card-body">
                                        <div class="rbt-color-select-area">
                                            <ul class="rbt-switcher-color-list product-switcher-activation">
                                                <li class="active"><a class="rbt-switcher--color tooltips"
                                                        data-switcher-color="#2B2B2B"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-01-a-1.webp"
                                                        data-tooltip="Black" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                                <li><a class="rbt-switcher--color tooltips "
                                                        data-switcher-color="#a09fa4"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-01-a-2.webp"
                                                        data-tooltip="Red" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                                <li><a class="rbt-switcher--color tooltips"
                                                        data-switcher-color="#cc999d"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-01-a-3.webp"
                                                        data-tooltip="Pink" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                            </ul>
                                            <a class="prd-link-text" href="product-single-default.html">+12 More
                                                Items</a>
                                        </div>
                                        <a href="shop-by-categories.html"
                                            class="rbt-card-subtitle rbt-card-catagories-text">Headphones &
                                            Music</a>
                                        <h2 class="rbt-card-title h6"><a href="product-single-default.html">Samsung
                                                Quiet
                                                Comfort Noise Cancelling
                                                Earbuds - Black</a></h2>
                                        <div class="rbt-card-rating">
                                            <div class="rbt-text-swiper-container rbt-arrow-vertical">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                    class="fa-solid fa-bag-shopping"></i></span>
                                                            90+ Sold Recently
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                    class="fa-solid fa-truck"></i></span>
                                                            Free shipping
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                    class="fa-solid fa-rotate-left"></i></span>
                                                            7 Days Return Plicy
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="rbt-verticle-arrow rbt-arrow-prev">
                                                    <i class="fa-regular fa-chevron-up"></i>
                                                </div>
                                                <div class="rbt-verticle-arrow rbt-arrow-next">
                                                    <i class="fa-regular fa-chevron-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pricing-part">
                                            <del class="price-text">PKR 295.00</del>
                                            <span class="price-text">PKR 179.98</span>
                                            <span class="rbt-offer-badge">-30%</span>
                                        </div>
                                        <div class="prd-btn-grp">
                                            <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block has-left-icon rbt-cart-sidenav-activation"
                                                href="#"><i class="fa-regular fa-cart-shopping"></i> Add To Cart</a>
                                            <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block rbt-btn-transparent has-left-icon rbt-compare-btn-activation rbt-compare-bottom-sidenav-activation"
                                                href="#"><i class="fa-regular fa-file-plus-minus"></i>Add To Compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Card  -->

                        <!-- Start Single Card  -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mt--24 mt_sm--16">
                            <div class="rbt-card rbt-product-card">
                                <div class="inner rbt-scroll-trigger fade_in animation-order-2">
                                    <div class="rbt-card-img rbt-has-hover-img rbt-bg-color-default">
                                        <a href="product-single-default.html">
                                            <img class="rbt-prd-img"
                                                src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-04-a-1.webp"
                                                alt="Card Image">
                                            <img class="rbt-hover-img"
                                                src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-04-a-1-hover.webp"
                                                alt="Card Image">
                                        </a>
                                        <div
                                            class="rbt-product-badge rbt-product-badge-bg-secondary-gradient border-rounded rbt-content-top-left">
                                            Best Seller</div>
                                        <div class="rbt-quick-btn-grp has-mixup-midlayer bottom-right--position">
                                            <button class="rbt-search-btn rbt-quick-btn tooltips" type="button"
                                                data-bs-toggle="modal" data-bs-target="#quickviewModal"
                                                data-tooltip="Quick View" data-tooltip-position="left"><i
                                                    class="fa-regular fa-magnifying-glass-plus"></i></button>
                                            <button class="rbt-wishlisted-btn rbt-quick-btn tooltips" type="button"
                                                data-bs-toggle="modal" data-bs-target="#wishlistModal"
                                                data-tooltip="Add to wishlist" data-tooltip-position="left"><i
                                                    class="fa-regular fa-heart"></i></button>
                                        </div>
                                    </div>
                                    <div class="rbt-card-body">
                                        <div class="rbt-color-select-area">
                                            <ul class="rbt-switcher-color-list product-switcher-activation">
                                                <li class="active"><a class="rbt-switcher--color tooltips"
                                                        data-switcher-color="#bdb6d6"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-04-a-1.webp"
                                                        data-tooltip="Purple" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                                <li><a class="rbt-switcher--color tooltips "
                                                        data-switcher-color="#486788"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-04-a-2.webp"
                                                        data-tooltip="Blue" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                                <li><a class="rbt-switcher--color tooltips"
                                                        data-switcher-color="#1a1a1a"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-04-a-3.webp"
                                                        data-tooltip="Black" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                            </ul>
                                            <a class="prd-link-text" href="product-single-default.html">+12 More
                                                Items</a>
                                        </div>
                                        <a href="shop-by-categories.html"
                                            class="rbt-card-subtitle rbt-card-catagories-text">Headphones &
                                            Music</a>
                                        <h2 class="rbt-card-title h6"><a href="product-single-default.html">Keurig K-Duo
                                                Bose Noise Cancelling
                                                Headphones 700 </a></h2>
                                        <div class="rbt-card-rating">
                                            <ul class="rbt-rating-icon-list">
                                                <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                                <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                                <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                                <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                                <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                            </ul>
                                            <p class="rating-digit">(10)</p>
                                        </div>
                                        <div class="pricing-part">
                                            <del class="price-text">PKR 295.00</del>
                                            <span class="price-text">PKR 179.98</span>
                                        </div>
                                        <div class="prd-btn-grp">
                                            <button
                                                class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block has-left-icon rbt-cart-sidenav-activation"><i
                                                    class="fa-regular fa-cart-shopping"></i> Add To Cart</button>
                                            <button
                                                class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block rbt-btn-transparent has-left-icon rbt-compare-btn-activation"
                                                type="button" data-bs-toggle="modal"
                                                data-bs-target="#addedcomparisonModal"><i
                                                    class="fa-regular fa-file-plus-minus"></i>Add To Compare</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Card  -->

                        <!-- Start Single Card  -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mt--24 mt_sm--16">
                            <div class="rbt-card rbt-product-card">
                                <div class="inner rbt-scroll-trigger fade_in animation-order-4">
                                    <div class="rbt-card-img rbt-has-hover-img rbt-bg-color-default">
                                        <a href="product-single-default.html">
                                            <img class="rbt-prd-img"
                                                src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-08-a-1.webp"
                                                alt="Card Image">
                                            <img class="rbt-hover-img"
                                                src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-08-a-1-hover.webp"
                                                alt="Card Image">
                                        </a>
                                        <div
                                            class="rbt-product-badge rbt-product-badge-bg-green border-rounded rbt-content-top-left">
                                            New</div>
                                        <div class="rbt-quick-btn-grp has-mixup-midlayer bottom-right--position">
                                            <button class="rbt-search-btn rbt-quick-btn tooltips" type="button"
                                                data-bs-toggle="modal" data-bs-target="#quickviewModal"
                                                data-tooltip="Quick View" data-tooltip-position="left"><i
                                                    class="fa-regular fa-magnifying-glass-plus"></i></button>
                                            <button class="rbt-wishlisted-btn rbt-quick-btn tooltips" type="button"
                                                data-bs-toggle="modal" data-bs-target="#wishlistModal"
                                                data-tooltip="Add to wishlist" data-tooltip-position="left"><i
                                                    class="fa-regular fa-heart"></i></button>
                                        </div>
                                    </div>
                                    <div class="rbt-card-body">
                                        <div class="rbt-color-select-area">
                                            <ul class="rbt-switcher-color-list product-switcher-activation">
                                                <li class="active"><a class="rbt-switcher--color tooltips"
                                                        data-switcher-color="#202020"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-08-a-1.webp"
                                                        data-tooltip="Black" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                                <li><a class="rbt-switcher--color tooltips "
                                                        data-switcher-color="#9e9e9e"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-08-a-2.webp"
                                                        data-tooltip="Gray" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                                <li><a class="rbt-switcher--color tooltips"
                                                        data-switcher-color="#171717"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-08-a-3.webp"
                                                        data-tooltip="Light Black" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                            </ul>
                                            <a class="prd-link-text" href="product-single-default.html">+12 More
                                                Items</a>
                                        </div>
                                        <a href="shop-by-categories.html"
                                            class="rbt-card-subtitle rbt-card-catagories-text">Electronics &
                                            Camera</a>
                                        <h2 class="rbt-card-title h6"><a href="product-single-default.html">GoPro HERO
                                                11
                                                4K Action Camera with SD
                                                Card</a></h2>
                                        <div class="rbt-card-rating">
                                            <div class="rbt-text-swiper-container rbt-arrow-vertical">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                    class="fa-solid fa-bag-shopping"></i></span>
                                                            90+ Sold Recently
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                    class="fa-solid fa-truck"></i></span>
                                                            Free shipping
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="rbt-text-group"> <span class="icon mr--4"><i
                                                                    class="fa-solid fa-rotate-left"></i></span>
                                                            7 Days Return Plicy
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="rbt-verticle-arrow rbt-arrow-prev">
                                                    <i class="fa-regular fa-chevron-up"></i>
                                                </div>
                                                <div class="rbt-verticle-arrow rbt-arrow-next">
                                                    <i class="fa-regular fa-chevron-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pricing-part">
                                            <del class="price-text">PKR 295.00</del>
                                            <span class="price-text">PKR 179.98</span>
                                            <div
                                                class="rbt-badge rbt-badge-bg-green rbt-badge-border rbt-badge-small rbt-badge-rounded">
                                                12 in
                                                Stock</div>
                                        </div>
                                        <div class="prd-btn-grp">
                                            <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block has-left-icon rbt-cart-sidenav-activation"
                                                href="#"><i class="fa-regular fa-cart-shopping"></i> Add To Cart</a>
                                            <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block rbt-btn-transparent has-left-icon rbt-compare-btn-activation"
                                                href="#"><i class="fa-regular fa-file-plus-minus"></i>Add To Compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Card  -->

                        <!-- Start Single Card  -->
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6 mt--24 mt_sm--16">
                            <div class="rbt-card rbt-product-card">
                                <div class="inner rbt-scroll-trigger fade_in animation-order-4">
                                    <div class="rbt-card-img rbt-has-hover-img rbt-bg-color-default">
                                        <a href="product-single-default.html">
                                            <img class="rbt-prd-img"
                                                src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-07-a-1.webp"
                                                alt="Card Image">
                                            <img class="rbt-hover-img"
                                                src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-07-a-1-hover.webp"
                                                alt="Card Image">
                                        </a>
                                        <div
                                            class="rbt-product-badge rbt-product-badge-bg-yellow border-rounded rbt-content-top-left">
                                            Trending
                                        </div>
                                        <div class="rbt-quick-btn-grp has-mixup-midlayer bottom-right--position">
                                            <button class="rbt-search-btn rbt-quick-btn tooltips" type="button"
                                                data-bs-toggle="modal" data-bs-target="#quickviewModal"
                                                data-tooltip="Quick View" data-tooltip-position="left"><i
                                                    class="fa-regular fa-magnifying-glass-plus"></i></button>
                                            <button class="rbt-wishlisted-btn rbt-quick-btn tooltips" type="button"
                                                data-bs-toggle="modal" data-bs-target="#wishlistModal"
                                                data-tooltip="Add to wishlist" data-tooltip-position="left"><i
                                                    class="fa-regular fa-heart"></i></button>
                                        </div>
                                    </div>
                                    <div class="rbt-card-body">
                                        <div class="rbt-color-select-area">
                                            <ul class="rbt-switcher-color-list product-switcher-activation">
                                                <li class="active"><a class="rbt-switcher--color tooltips"
                                                        data-switcher-color="#afb1b3"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-07-a-1.webp"
                                                        data-tooltip="Gray" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                                <li><a class="rbt-switcher--color tooltips "
                                                        data-switcher-color="#7796b9"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-07-a-2.webp"
                                                        data-tooltip="Sky Blue" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                                <li><a class="rbt-switcher--color tooltips"
                                                        data-switcher-color="#b84a5f"
                                                        data-src="<?php echo base_url('assets/frontend/'); ?>images/product-img/electronics/electronics-bg-trans-07-a-3.webp"
                                                        data-tooltip="Pink Red" data-tooltip-position="top" href="#">
                                                        <div class="rbt-color-circle"></div>
                                                    </a></li>
                                            </ul>
                                            <a class="prd-link-text" href="product-single-default.html">+12 More
                                                Items</a>
                                        </div>
                                        <a href="shop-by-categories.html"
                                            class="rbt-card-subtitle rbt-card-catagories-text">Tablets &
                                            Accessories</a>
                                        <h2 class="rbt-card-title h6"><a href="product-single-default.html">Samsung
                                                Galaxy
                                                N-569 Tab S7 with
                                                Stylish – 8GB/128GB</a></h2>
                                        <div class="rbt-card-rating">
                                            <ul class="rbt-rating-icon-list">
                                                <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                                <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                                <li><i class="fa-solid fa-star rbt-rated-icon"></i></li>
                                                <li><i class="fa-solid fa-star"></i></li>
                                                <li><i class="fa-solid fa-star"></i></li>
                                            </ul>
                                            <p class="rating-digit">(25)</p>
                                        </div>
                                        <div class="pricing-part">
                                            <del class="price-text">PKR 295.00</del>
                                            <span class="price-text">PKR 179.98</span>
                                        </div>
                                        <div class="prd-btn-grp">
                                            <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block has-left-icon rbt-cart-sidenav-activation"
                                                href="#"><i class="fa-regular fa-cart-shopping"></i> Add To Cart</a>
                                            <a class="rbt-btn rbt-btn-border rbt-btn-sm rbt-square-btn d-block rbt-btn-transparent has-left-icon rbt-compare-btn-activation"
                                                href="#"><i class="fa-regular fa-file-plus-minus"></i>Add To Compare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Card  -->

                    </div>
                    <!-- End Card Area -->
                </div>
            </div>

        </div>
    </div>
    <!-- End Search Dropdown  -->
</div>
</header>

<!-- Start Preloader Area  -->
<div class="rbt-preloader">
    <div class="rbt-preloader-inner">
        <svg class="rbt-preloader-cart" role="img" aria-label="Shopping cart line animation" viewBox="0 0 128 128"
            width="128px" height="128px" xmlns="http://www.w3.org/2000/svg">
            <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="8">
                <g class="rbt-preloader-cart-track" stroke="hsla(0,10%,10%,0.1)">
                    <polyline points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80" />
                    <circle cx="43" cy="111" r="13" />
                    <circle cx="102" cy="111" r="13" />
                </g>
                <g class="rbt-preloader-cart-lines" stroke="currentColor">
                    <polyline class="rbt-preloader-cart-top" points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80"
                        stroke-dasharray="338 338" stroke-dashoffset="-338" />
                    <g class="rbt-preloader-cart-wheel1" transform="rotate(-90,43,111)">
                        <circle class="rbt-preloader-cart-wheel-stroke" cx="43" cy="111" r="13"
                            stroke-dasharray="81.68 81.68" stroke-dashoffset="81.68" />
                    </g>
                    <g class="rbt-preloader-cart-wheel2" transform="rotate(90,102,111)">
                        <circle class="rbt-preloader-cart-wheel-stroke" cx="102" cy="111" r="13"
                            stroke-dasharray="81.68 81.68" stroke-dashoffset="81.68" />
                    </g>
                </g>
            </g>
        </svg>
        <div class="preloader-text">
            <p class="preloader-msg">Gearing up something amazing for you…</p>
            <p class="preloader-msg preloader-msg--last">Still waiting? Magic takes a moment! ✨</p>
        </div>
    </div>
</div>
<!-- End Preloader Area -->
 
<!-- Mobile Menu Section -->
<div class="popup-mobile-menu">
    <div class="inner-wrapper">
        <div class="mobile-menu-top">
            <div class="inner-top">
                <div class="content">
                    <div class="logo">
                        <a href="<?= site_url('home') ?>">
                            <img src="<?php echo base_url('assets/frontend/'); ?>images/logo/bloom-logo-header.png" alt="Bloom Kids Wear">
                        </a>
                    </div>
                    <div class="rbt-btn-close">
                        <button class="close-button rbt-round-btn"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
                <p class="description">Unimart is a E-commerce Template. Worldwide electronics store since 1978.</p>
                <div class="rbt-inner-search-field style-one rbt-search-field-rounded rbt-search-field-sm-width">
                    <input type="text" placeholder="Search for products">
                    <button class="rbt-round-btn search-btn rbt-text-color-gray-500" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
            <div class="rbt-tab rbt-round-shape-tab">
                <ul class="nav nav-tabs mb--0" id="mobile-menuTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="rbt-tab-mobilemenu-1" data-bs-toggle="tab"
                            data-bs-target="#rbt-tab-pane-mobilemenu-1" type="button" role="tab"
                            aria-controls="rbt-tab-pane-mobilemenu-1" aria-selected="true">
                            <i class="fa-solid fa-bars-sort"></i>
                            Menu
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rbt-tab-mobilemenu-2" data-bs-toggle="tab"
                            data-bs-target="#rbt-tab-pane-mobilemenu-2" type="button" role="tab"
                            aria-controls="rbt-tab-pane-mobilemenu-2" aria-selected="false">
                            <i class="fa-sharp fa-regular fa-layer-group"></i>
                            Catagories
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="mobile-menuTabContent">
                    <div class="tab-pane fade show active" id="rbt-tab-pane-mobilemenu-1" role="tabpanel"
                        aria-labelledby="rbt-tab-mobilemenu-1" tabindex="0">
                        <nav class="rbt-mainmenu-nav">
    <ul class="mainmenu">
        <li class="with-rbt-megamenu has-menu-child-item position-static">
            <a href="#!">Home <i class="fa-regular fa-chevron-down"></i></a>
            <!-- Start Mega Menu  -->
<div class="rbt-megamenu rbt-prsentation-megamenu rbt-width-fullscreen">
    <div class="rbt-megamenu-wrapper">
        <div class="container p_sm--0 p_md--0 p_lg--0">
            <div class="row row--12 home-plesentation-wrapper single-dropdown-menu-presentation mt_dec--24 mb_sm--0">

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-1">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-electronics.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-1.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-electronics.html">Electronics One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-2">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="<?php echo site_url('/'); ?>"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-5.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="<?php echo site_url('/'); ?>">Fashion One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-3">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-furniture.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-8.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-furniture.html">Furniture One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-4">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-printing-service.html"><img
                                        src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-6.webp" alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-printing-service.html">Print Service One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-5">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-cosmetic-beauty.html"><img
                                        src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-2.webp" alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-cosmetic-beauty.html">Cosmetic Beauty One</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-6">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-sports.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-9.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-sports.html">Sports One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-7">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-glass.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-3.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-glass.html">Glass One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-8">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-phone-case.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-4.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-phone-case.html">Phone One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-9">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-accessories.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-10.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-accessories.html">Accessories One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

                <!-- Start Single Demo  -->
                <div
                    class="col-lg-1-5 col-md-12 col-sm-12 col-12 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                    <div class="demo-single rbt-scroll-trigger zoom_in animation-order-10">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="home-jewellery.html"><img src="<?php echo base_url('assets/frontend/'); ?>images/splash/demo-pages/demo-11.webp"
                                        alt="Demo Images"></a>
                            </div>
                            <div class="content">
                                <h2 class="rbt-title h4"><a href="home-jewellery.html">jewellery One</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Demo  -->

            </div>

            <div class="load-demo-btn text-center pt--24 pt_sm--0 pt_lg--0 position-relative">
                <a href="<?= site_url('home') ?>"
                    class="rbt-btn-grp rbt-has-separator-shape justify-content-center rbt-scroll-trigger fade_in animation-order-2 pb_sm--0">
                    <span
                        class="rbt-btn rbt-btn-single rbt-btn rbt-marquee-btn marquee-auto rbt-btn-md has-primary-overlay has-no-hover-transform">
                        <span data-text="View All The Trending Collection">
                            VIEW ALL DEMOS (81+) New drops every month 🔥
                        </span>
                    </span>
                    <span class="rbt-btn rbt-btn-single animated-icon-btn round-sm defalt-primary-bg p--0">
                        <span class="animated-icon">
                            <svg class="icon_external" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.5 15.5">
                                <g class="icon-wrapper">
                                    <path class="icon-rectangle"
                                        d="m7.75,0c.41,0,.75.34.75.75s-.34.75-.75.75H3.08c-.87,0-1.58.71-1.58,1.58v9.33c0,.87.71,1.58,1.58,1.58h9.33c.87,0,1.58-.71,1.58-1.58v-4.67c0-.41.34-.75.75-.75s.75.34.75.75v4.67c0,1.7-1.38,3.08-3.08,3.08H3.08c-1.7,0-3.08-1.38-3.08-3.08V3.08C0,1.38,1.38,0,3.08,0h4.67Z"
                                        stroke-width="0">
                                    </path>
                                    <path class="icon-arrow-el-one"
                                        d="m15.5,0v4.29c0,.41-.34.75-.75.75s-.75-.34-.75-.75V1.5h-2.75c-.38,0-.69-.28-.74-.65v-.1c0-.41.33-.75.74-.75h4.25Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.5 0" transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                    <path class="icon-arrow-line-one"
                                        d="m14.22.22c.29-.29.77-.29,1.06,0,.29.29.29.77,0,1.06L5.95,10.61c-.29.29-.77.29-1.06,0-.29-.29-.29-.77,0-1.06.4-.4.76-.76,1.09-1.09l.47-.47c.37-.37.7-.7,1-1l.34-.34.46-.46.41-.41c.74-.74,1.29-1.29,2.09-2.09l.61-.61c.17-.17.34-.34.53-.53.13-.13.25-.25.36-.36l.59-.59c.08-.08.16-.16.23-.23l.36-.36c.1-.1.19-.19.26-.26l.42-.42s.07-.07.11-.11Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.4975004196167 0.002499997615814209"
                                        transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                    <path class="icon-arrow-el-two"
                                        d="m15.5,0v4.29c0,.41-.34.75-.75.75s-.75-.34-.75-.75V1.5h-2.75c-.38,0-.69-.28-.74-.65v-.1c0-.41.33-.75.74-.75h4.25Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.5 0" transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                    <path class="icon-arrow-line-two"
                                        d="m14.22.22c.29-.29.77-.29,1.06,0,.29.29.29.77,0,1.06L5.95,10.61c-.29.29-.77.29-1.06,0-.29-.29-.29-.77,0-1.06.4-.4.76-.76,1.09-1.09l.47-.47c.37-.37.7-.7,1-1l.34-.34.46-.46.41-.41c.74-.74,1.29-1.29,2.09-2.09l.61-.61c.17-.17.34-.34.53-.53.13-.13.25-.25.36-.36l.59-.59c.08-.08.16-.16.23-.23l.36-.36c.1-.1.19-.19.26-.26l.42-.42s.07-.07.11-.11Z"
                                        stroke-width="0"
                                        style="translate: none; rotate: none; scale: none; transform-origin: 0px 0px 0px;"
                                        data-svg-origin="15.4975004196167 0.002499997615814209"
                                        transform="matrix(1,0,0,1,0,0)">
                                    </path>
                                </g>
                            </svg>
                        </span>
                    </span>
                </a>
                <span class="rbt-overlay-counter counter-md rbt-scroll-trigger fade_in animation-order-4">
                    <span class="odometer" data-count="100">00</span>
                    <span class="counter-suffix">+</span>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- End Mega Menu  -->
        </li>

        <?= $this->include('storefront/partials/shop_menu') ?>
        <?= $this->include('storefront/partials/main_menu_links') ?>
    </ul>
</nav>
                    </div>
                    <div class="tab-pane fade" id="rbt-tab-pane-mobilemenu-2" role="tabpanel"
                        aria-labelledby="rbt-tab-mobilemenu-2" tabindex="0">
                        <nav class="rbt-mainmenu-nav">
    <ul class="mainmenu">
        <li class="with-rbt-megamenu has-menu-child-item position-static">
            <a href="shop-by-categories.html">
                <span><i class="rbt-catagories-icon mr--8 fa-regular fa-house-chimney"></i></span>Home & Garden
                <span class="rbt-chevron-right"><i class="fa-regular fa-chevron-right"></i></span>
            </a>
            <!-- Start Mega Menu  -->
            <div class="rbt-megamenu grid-item-5 pl_sm--0 pl_md--0 pl_lg--0">
                <div class="container p_sm--0 p_md--0 p_lg--0">
                    <div class="rbt-megamenu-wrapper">
                        <!-- Start Card Area -->
                        <div class="row row--12">
                            <div
                                class="col-lg-12 col-xl-3 col-xxl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                                <p class="rbt-short-title h5">Home & Garden</p>
                                <ul class="mega-menu-item">
                                    <li><a href="shop-by-category.html">Furniture</a></li>
                                    <li><a href="shop-by-category.html">Living Room Sets</a></li>
                                    <li><a href="shop-by-category.html">Sofas & Couches</a></li>
                                    <li><a href="shop-by-category.html">Coffee Tables</a></li>
                                    <li><a href="shop-by-category.html">Bedroom Furniture</a></li>
                                    <li><a href="shop-by-category.html">Mattresses & Bedding</a></li>
                                    <li><a href="shop-by-category.html">Wardrobes & Storage</a></li>
                                </ul>
                            </div>
                            <div
                                class="col-lg-12 col-xl-3 col-xxl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                                <p class="rbt-short-title h5">More Home & Garden</p>
                                <ul class="mega-menu-item">
                                    <li><a href="shop-by-category.html">Home Decor</a></li>
                                    <li><a href="shop-by-category.html">Clocks & Mirrors</a></li>
                                    <li><a href="shop-by-category.html">Curtains & Blinds</a></li>
                                    <li><a href="shop-by-category.html">Rugs & Carpets</a></li>
                                    <li><a href="shop-by-category.html">Lighting & Lamps</a></li>
                                    <li><a href="shop-by-category.html">Outdoor Furniture</a></li>
                                    <li><a href="shop-by-category.html">BBQ & Grills</a></li>
                                </ul>
                            </div>
                            <div
                                class="col-lg-12 col-xl-3 col-xxl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                                <div class="rbt-menu-offer-card">
                                    <div class="mega-top-banner rbt-bg-color-extra-six">
                                        <div
                                            class="rbt-banner-inner flex-column justify-content-center rbt-gap--8 align-items-center text-center">
                                            <div class="rbt-banner-content">
                                                <h2 class="title">All For Garden</h2>
                                                <p class="b3 desc">Send your idea, appear Unimart.</p>
                                            </div>
                                            <a class="rbt-btn rbt-btn-sm rbt-btn-black"
                                                href="product-single-default.html">View Details</a>
                                            <a href="#" class="product-img position-bottom mt--24"><img
                                                    src="<?php echo base_url('assets/frontend/'); ?>images/splash/menu-banner/menu-prd-garden.webp"
                                                    alt="Eccommerce Product"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card Area -->
                    </div>
                </div>
            </div>
            <!-- End Mega Menu  -->
        </li>

        <li class="with-rbt-megamenu has-menu-child-item position-static">
            <a href="shop-by-categories.html">
                <span><i class="rbt-catagories-icon mr--8 fa-regular fa-mobile-notch"></i></span>Smart Phones
                <span class="rbt-chevron-right"><i class="fa-regular fa-chevron-right"></i></span>
            </a>
            <!-- Start Mega Menu  -->
            <div class="rbt-megamenu grid-item-5 pl_sm--0 pl_md--0 pl_lg--0">
                <div class="container p_sm--0 p_md--0 p_lg--0">
                    <div class="rbt-megamenu-wrapper">
                        <!-- Start Card Area -->
                        <div class="row row--12">
                            <div
                                class="col-lg-12 col-xl-3 col-xxl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                                <p class="rbt-short-title h5">Smart Phones</p>
                                <ul class="mega-menu-item">
                                    <li><a href="shop-by-category.html">Latest Models</a></li>
                                    <li><a href="shop-by-category.html">5G Phones</a></li>
                                    <li><a href="shop-by-category.html">Android Phones</a></li>
                                    <li><a href="shop-by-category.html">iPhones</a></li>
                                    <li><a href="shop-by-category.html">Gaming Phones</a></li>
                                    <li><a href="shop-by-category.html">Budget Phones</a></li>
                                    <li><a href="shop-by-category.html">Accessories</a></li>
                                </ul>
                            </div>
                            <div
                                class="col-lg-12 col-xl-3 col-xxl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                                <p class="rbt-short-title h5">Tablets & Accessories</p>
                                <ul class="mega-menu-item">
                                    <li><a href="shop-by-category.html">Latest Tablets</a></li>
                                    <li><a href="shop-by-category.html">Android Tablets</a></li>
                                    <li><a href="shop-by-category.html">iPads</a></li>
                                    <li><a href="shop-by-category.html">Tablet Keyboards</a></li>
                                    <li><a href="shop-by-category.html">Stylus Pens</a></li>
                                    <li><a href="shop-by-category.html">Screen Protectors</a></li>
                                    <li><a href="shop-by-category.html">Tablet Cases</a></li>
                                </ul>
                            </div>
                            <div
                                class="col-lg-12 col-xl-3 col-xxl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                                <div class="rbt-menu-offer-card rbt-bg-style-box rbt-bg-two">
                                    <div class="mega-top-banner">
                                        <div
                                            class="rbt-banner-inner flex-column justify-content-center rbt-gap--8 align-items-center text-center">
                                            <div class="rbt-banner-content">
                                                <h2 class="title rbt-text-color-white">Apple 16 Pro</h2>
                                                <p class="b3 desc rbt-text-color-gray-200">Send your idea,
                                                    appear Unimart.</p>
                                            </div>
                                            <a class="rbt-btn rbt-btn-sm" href="#">View Details</a>
                                            <a href="#" class="product-img position-bottom mt--24"><img
                                                    src="<?php echo base_url('assets/frontend/'); ?>images/splash/menu-banner/menu-prd-apple.webp"
                                                    alt="Eccommerce Product"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card Area -->
                    </div>
                </div>
            </div>
            <!-- End Mega Menu  -->
        </li>
        <li class="with-rbt-megamenu has-menu-child-item position-static">
            <a href="shop-by-categories.html">
                <span><i class="rbt-catagories-icon mr--8 fa-regular fa-desktop"></i></span>Electronics Gadgets
                <span class="rbt-chevron-right"><i class="fa-regular fa-chevron-right"></i></span>
            </a>
            <!-- Start Mega Menu  -->
            <div class="rbt-megamenu grid-item-5 pl_sm--0 pl_md--0 pl_lg--0">
                <div class="container p_sm--0 p_md--0 p_lg--0">
                    <div class="rbt-megamenu-wrapper">
                        <!-- Start Card Area -->
                        <div class="row row--12">
                            <div
                                class="col-lg-12 col-xl-3 col-xxl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                                <p class="rbt-short-title h5">Wearable Tech</p>
                                <ul class="mega-menu-item">
                                    <li><a href="shop-by-category.html">Smartwatches</a></li>
                                    <li><a href="shop-by-category.html">Fitness Trackers</a></li>
                                    <li><a href="shop-by-category.html">VR & AR Headsets</a></li>
                                    <li><a href="shop-by-category.html">Smart Glasses</a></li>
                                    <li><a href="shop-by-category.html">Sleep Trackers</a></li>
                                    <li><a href="shop-by-category.html">Wearable Cameras</a></li>
                                    <li><a href="shop-by-category.html">Wireless Earbuds</a></li>
                                </ul>
                            </div>
                            <div
                                class="col-lg-12 col-xl-3 col-xxl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                                <p class="rbt-short-title h5">Smart Home & Office</p>
                                <ul class="mega-menu-item">
                                    <li><a href="shop-by-category.html">Smart Speakers</a></li>
                                    <li><a href="shop-by-category.html">Smart Plugs & Lights</a></li>
                                    <li><a href="shop-by-category.html">Home Security Systems</a></li>
                                    <li><a href="shop-by-category.html">Streaming Devices</a></li>
                                    <li><a href="shop-by-category.html">External Monitors</a></li>
                                    <li><a href="shop-by-category.html">Portable Projectors</a></li>
                                </ul>
                            </div>
                            <div
                                class="col-lg-12 col-xl-3 col-xxl-3 single-mega-item rbt-scroll-trigger fade_in animation-order-1">
                                <div class="rbt-menu-offer-card rbt-bg-color-brand-50 rbt-rounded--12">
                                    <div class="mega-top-banner">
                                        <div
                                            class="rbt-banner-inner flex-column justify-content-center rbt-gap--8 align-items-center text-center">
                                            <div class="rbt-banner-content">
                                                <h2 class="title">Straps of Colors</h2>
                                                <p class="b3 desc">Send your idea, appear Unimart.</p>
                                            </div>
                                            <a class="rbt-btn rbt-btn-sm rbt-btn-black"
                                                href="product-single-default.html">View Details</a>
                                            <a href="#" class="product-img position-bottom mt--24"><img
                                                    src="<?php echo base_url('assets/frontend/'); ?>images/splash/menu-banner/menu-prd-02-lg.webp"
                                                    alt="Eccommerce Product"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card Area -->
                    </div>
                </div>
            </div>
            <!-- End Mega Menu  -->
        </li>
        <li>
            <a href="shop-by-categories.html">
                <span><i class="rbt-catagories-icon mr--8 fa-regular fa-shirt"></i></span>Fashion Wear
            </a>
        </li>
        <li>
            <a href="shop-by-categories.html">
                <span><i class="rbt-catagories-icon mr--8 fa-regular fa-camera"></i></span>Cameras &amp; Photo
            </a>
        </li>
        <li>
            <a href="shop-by-categories.html">
                <span><i class="rbt-catagories-icon mr--8 fa-regular fa-cauldron"></i></span>Cooking Items
            </a>
        </li>
        <li>
            <a href="shop-by-categories.html">
                <span><i class="rbt-catagories-icon mr--8 fa-regular fa-heart-pulse"></i></span>Health &amp; Beauty
            </a>
        </li>
        <li>
            <a href="categories-list.html">
                View All Categories
            </a>
        </li>
    </ul>
</nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu-bottom">
            <div class="social-share-wrapper">
                <span class="rbt-short-title d-block">Find With Us</span>
                <ul class="rbt-social-icon-list mt--12">
                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-telegram"></i></a></li>
                </ul>
            </div>
            <ul class="navbar-top-left rbt-information-list justify-content-center">
                <li>
                    <a href="mailto:hello@example.com"><i class="fa-light fa-envelope"></i>example@gmail.com</a>
                </li>
                <li>
                    <a href="tel:+302555-0107"><i class="fa-regular fa-phone"></i>(302) 555-0107</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Start Side Nav -->
<div class="rbt-cart-side-menu rbt-sidebar-cart">
    <div class="inner-wrapper">
        <div class="inner-top">
            <div class="rbt-cart-header">
                <div class="title-section">
                    <h2 class="title mb--0 h6"><i class="fa-sharp fa-regular fa-cart-shopping mr--12"></i> Your cart
                    </h2>
                </div>
                <div class="rbt-quick-info-tag d-flex mt--16 rbt-flash-animation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M18.9706 14.9359C18.8148 18.8649 15.7493 22 11.9891 22C8.12909 22 5 18.5858 5 14.6221C5 14.0924 4.99101 13.0336 5.74352 11.2472C6.19387 10.1781 6.47633 9.50646 6.63574 8.89253C6.72333 8.55511 6.89367 8.01904 7.37926 8.89253C7.66559 9.40757 7.67666 10.1483 7.67666 10.1483C7.67666 10.1483 8.74197 9.28536 9.4611 7.63673C10.5153 5.21985 9.67419 3.77512 9.38675 2.77048C9.28727 2.42294 9.22481 1.79833 9.90721 2.06409C10.6025 2.33495 12.4408 3.69334 13.4017 5.12512C14.7732 7.16855 15.2605 9.128 15.2605 9.128C15.2605 9.128 15.6997 8.55268 15.8553 7.95068C16.0312 7.27089 16.0338 6.59763 16.5988 7.32285C17.1361 8.01253 17.9341 9.3086 18.3833 10.5408C19.1989 12.7784 18.9706 14.9359 18.9706 14.9359Z"
                            fill="url(#paint0_linear_47_2365484)" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.9999 22C9.23852 22 7 19.7944 7 17.0735C7 15.4318 7.67145 14.435 9.0689 13.0833C9.96366 12.2179 10.8011 11.1549 11.157 10.4311C11.2271 10.2886 11.3866 9.54605 12.0014 10.4155C12.3239 10.8714 12.8296 11.6823 13.1538 12.3744C13.7127 13.5676 13.8461 14.7239 13.8461 14.7239C13.8461 14.7239 14.3938 14.4059 14.7692 13.5871C14.8902 13.3232 15.1348 12.3241 15.8186 13.323C16.3204 14.0561 17.0097 15.3741 16.9999 17.0735C16.9999 19.7944 14.7613 22 11.9999 22Z"
                            fill="#FC9502" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12.1019 16C12.8497 16 12.8497 17.4475 13.7996 19.3803C14.4321 20.6672 13.486 22 12.1019 22C10.7178 22 10 20.8271 10 19.3803C10 17.9335 11.3541 16 12.1019 16Z"
                            fill="#FCE202" />
                        <defs>
                            <linearGradient id="paint0_linear_47_2365484" x1="11.9995" y1="22.0148" x2="11.9995"
                                y2="2.01511" gradientUnits="userSpaceOnUse">
                                <stop offset="1" stop-color="#FF4C0D" />
                                <stop offset="1" stop-color="#FC9502" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <p>Limited Item, <strong>checkout within <span class="rbt-countdown-cart">10m 00s</span></strong>
                    </p>
                </div>
                <div class="rbt-btn-close" id="btn_sideNavClose">
                    <button class="minicart-close-button rbt-round-btn"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
            <nav class="side-nav w-100">
                <ul class="rbt-minicart-wrapper" id="bloom-mini-items"></ul>
                <div id="bloom-mini-empty" class="text-center ptb--40" style="display:none">
                    <i class="fa-regular fa-bag-shopping" style="font-size:44px;color:#a8b6cb"></i>
                    <h3 class="h6 mt--16">Your cart is empty</h3>
                    <p class="b3">Add something lovely for your little one.</p>
                    <a href="<?= site_url('shop') ?>" class="rbt-btn rbt-btn-sm mt--8">Start shopping</a>
                </div>
            </nav>
        </div>
        <div class="rbt-minicart-footer" id="bloom-mini-footer" style="display:none">
            <hr class="mb--0 mt--16">
            <div class="rbt-cart-subttotal">
                <p>Subtotal (<span data-cart="count">0</span> items)</p>
                <p class="price" data-cart="subtotal">PKR 0</p>
            </div>
            <div class="rbt-cart-subttotal">
                <p>Delivery</p>
                <p class="price" data-cart="shipping">PKR 0</p>
            </div>
            <hr class="mb--0">
            <div class="rbt-cart-subttotal">
                <p class="subtotal"><strong>Total</strong></p>
                <p class="price" data-cart="total">PKR 0</p>
            </div>
            <div class="offer-progress-area">
                <p class="offer-text" data-cart="offer"></p>
                <div class="progress" role="progressbar" aria-label="Free delivery progress" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" data-cart="progress" style="width:0"></div>
                </div>
            </div>
            <div class="rbt-minicart-bottom mt--24">
                <div class="checkout-btn mt--20">
                    <a class="rbt-btn w-100 text-center" href="<?= site_url('checkout') ?>"><span class="btn-text">Checkout</span></a>
                </div>
                <div class="share-btn-grp rbt-link-hover">
                    <a href="<?= site_url('cart') ?>" class="share-btn"><i class="fa-regular fa-pen mr--4"></i> View Cart</a>
                </div>
            </div>
        </div>
    </div>
    <a href="#!" class="rbt-close-inner-popup rbt-popup-close-btn"></a>
    <div class="rbt-offcanvas-inner-popup">
    <div class="rbt-offcanvas-inner-popup-card note-popup">
        <div class="rbt-offcanvas-card-inner">
            <h3 class="rbt-title rbt-text-bold h6">
                <span class="mr--4"><i class="fa-regular fa-pen"></i></span>
                Add note for seller
            </h3>
            <form>
                <div class="rbt-input-field-grp mb--12">
                    <textarea class="rbt-text-field" name="message"
                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                </div>
                <div class="rbt-btn-group mt--16">
                    <button class="rbt-btn rbt-btn-md rbt-btn-primary d-block w-100">Apply</button>
                    <button
                        class="rbt-btn rbt-btn-md rbt-btn-naked d-block w-100 mt--8 mb--8 rbt-popup-close-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="rbt-offcanvas-inner-popup">
    <div class="rbt-offcanvas-inner-popup-card shipping-popup">
        <div class="rbt-offcanvas-card-inner">
            <h3 class="rbt-title rbt-text-bold h6">
                <span class="mr--4"><i class="fa-light fa-truck-fast"></i></span>
                Estimate shipping rates
            </h3>
            <form>
                <div class="rbt-input-field-grp mb--12">
                    <div class="rbt-dropdown-select filter-select rbt-modern-select search-by-category">
                        <select class="w-100 rbt-select-activation" data-live-search="true"
                            data-live-search-placeholder="Search City">
                            <option>Select your City</option>
                            <option>New York</option>
                            <option>London</option>
                            <option>Paris</option>
                            <option>Tokyo</option>
                            <option>Dubai</option>
                            <option>Singapore</option>
                            <option>Sydney</option>
                            <option>Berlin</option>
                            <option>Toronto</option>
                            <option>Los Angeles</option>
                        </select>
                    </div>
                </div>
                <div class="rbt-input-field-grp mb--12">
                    <input type="text" placeholder="State / County">
                </div>
                <div class="rbt-input-field-grp mb--12">
                    <input type="text" placeholder="City">
                </div>
                <div class="rbt-input-field-grp">
                    <input type="text" placeholder="Postcode / ZIP">
                </div>
                <div class="rbt-btn-group mt--16">
                    <button class="rbt-btn rbt-btn-md rbt-btn-primary d-block w-100">Calculate shipping rates</button>
                    <button
                        class="rbt-btn rbt-btn-md rbt-btn-naked d-block w-100 mt--8 mb--8 rbt-popup-close-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="rbt-offcanvas-inner-popup">
    <div class="rbt-offcanvas-inner-popup-card coupon-popup">
        <div class="rbt-offcanvas-card-inner">
            <h3 class="rbt-title rbt-text-bold h6">
                <span class="mr--4"><i class="fa-regular fa-ticket"></i></span>
                Select or input Coupon
            </h3>
            <div class="rbt-coupon-wrapper rbt-bg-color-white">
                <div class="rbt-coupon">
                    <div class="inner rbt-text-copy-activation">
                        <div class="left-part">
                            <input type="text" value="WELCOME100" readonly
                                class="rbt-coupon-code-text rbt-has-right-shepe-border rbt-copy-value-field">
                        </div>
                        <div class="coupon-details">
                            <h2 class="rbt-coupon-info-title b1">UP TO 30% OFF</h2>
                            <p class="rbt-coupon-info-sub-title b3 mt--4">For orders over PKR 9.90</p>
                            <ul class="rbt-coupon-info-list mt--12">
                                <li><span>12/18/2023 14:00 ~ 12/25/2023 14:00</span></li>
                                <li><span>The minimum spend for this coupon <strong>PKR 200.00</strong></span></li>
                            </ul>
                        </div>
                        <button class="copy-icon rbt-round-btn rbt-bg-primary rbt-copy-btn" data-tooltip="Copy">
                            <i class="fa-sharp fa-regular fa-copy"></i>
                        </button>
                    </div>
                </div>
                <div class="rbt-coupon">
                    <div class="inner rbt-text-copy-activation">
                        <div class="left-part">
                            <input type="text" value="WELCOME100" readonly
                                class="rbt-coupon-code-text rbt-has-right-shepe-border rbt-copy-value-field">
                        </div>
                        <div class="coupon-details">
                            <h2 class="rbt-coupon-info-title b1">UP TO 30% OFF</h2>
                            <p class="rbt-coupon-info-sub-title b3 mt--4">For orders over PKR 9.90</p>
                            <ul class="rbt-coupon-info-list mt--12">
                                <li><span>12/18/2023 14:00 ~ 12/25/2023 14:00</span></li>
                                <li><span>The minimum spend for this coupon <strong>PKR 200.00</strong></span></li>
                            </ul>
                        </div>
                        <button class="copy-icon rbt-round-btn rbt-bg-primary rbt-copy-btn" data-tooltip="Copy">
                            <i class="fa-sharp fa-regular fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
            <form>
                <div class="rbt-input-field-grp mt--24">
                    <p class="b1 mb--12 rbt-text-color-gray-600">If you have coupon code, please apply it below.</p>
                    <input type="text" placeholder="Coupon code">
                </div>
                <div class="rbt-btn-group mt--16">
                    <button class="rbt-btn rbt-btn-md rbt-btn-primary d-block w-100">Apply</button>
                    <button
                        class="rbt-btn rbt-btn-md rbt-btn-naked d-block w-100 mt--8 mb--8 rbt-popup-close-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- End Side Nav -->
<!-- Start Side Nav -->
<div class="rbt-offcanvas-cat-side-menu rbt-category-sidemenu ">
    <div class="inner-wrapper">
        <div class="rbt-categories-sidebar d-flex">
            <div class="rbt-sidebar-left-content">
                <div class="rbt-sidebar-left-inner">
                    <!-- Start sidebar left header -->
                    <div class="rbt-sidebar-left-content-head">
                        <div class="rbt-categories-sidebar-top-content mb--24">
                            <div class="logo">
                                <a href="<?= site_url('home') ?>">
                                    <img src="<?php echo base_url('assets/frontend/'); ?>images/logo/bloom-logo-header.png" alt="Bloom Kids Wear">
                                </a>
                            </div>
                            <button class="rbt-sidebar-close-btn">
                                <i class="fa-sharp fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div
                            class="rbt-access-box rbt-scroll-trigger fade_in animation-order-1 rbt-access-box-has-bg-hover rbt-access-box-has-bg-hover-white d-inline-block">
                            <a href="#!" class="rbt-access-box-wrapper" data-bs-toggle="modal"
                                data-bs-target="#authModal">
                                <div
                                    class="rbt-round-btn rbt-bg-color-brand-300 rbt-text-color-primary has-rbt-sm-fsize">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                                <div class="content">
                                    <p>Log in/Sign Up</p>
                                    <span>Access Account</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- End sidebar left header -->

                    <div class="rbt-sidebar-tabs-wrapper">
                        <div class="rbt-sidebar-tabs-inner">
                            <!-- Start tabs -->
                            <ul class="rbt-sidebar-sub-categories nav flex-column nav-pills" id="v-pills-tab"
                                role="tablist" aria-orientation="vertical">
                                <li>
                                    <button class="rbt-nav-link nav-link" id="rbt-tab-cat-sidebar-1"
                                        data-bs-toggle="pill" data-bs-target="#rbt-nav-pill-1" type="button" role="tab"
                                        aria-controls="rbt-nav-pill-1" aria-selected="true">
                                        <span class="rbt-round-btn">
                                            <i class="fa-regular fa-camera"></i>
                                        </span>
                                        <span class="rbt-content">
                                            <span class="rbt-sub-category-title">
                                                <span>Camera & Photo</span>
                                            </span>
                                            <span class="description">Popular Camera & Photo accessories</span>
                                        </span>
                                        <span class="icon">
                                            <i class="fa-regular fa-chevron-right"></i>
                                        </span>
                                    </button>
                                </li>
                                <li>
                                    <button class="rbt-nav-link nav-link" id="rbt-tab-cat-sidebar-2"
                                        data-bs-toggle="pill" data-bs-target="#rbt-nav-pill-2" type="button" role="tab"
                                        aria-controls="rbt-nav-pill-2" aria-selected="false">
                                        <span class="rbt-round-btn">
                                            <i class="fa-regular fa-watch-apple"></i>
                                        </span>
                                        <span class="rbt-content">
                                            <span class="rbt-sub-category-title">
                                                <span>All Watches</span>
                                                <span
                                                    class="rbt-product-badge rbt-product-badge-bg-primary">EXCLUSIVE</span>
                                            </span>
                                            <span class="description">Pages with a demonstration
                                                of Smartwatches</span>
                                        </span>
                                        <span class="icon">
                                            <i class="fa-regular fa-chevron-right"></i>
                                        </span>
                                    </button>
                                </li>
                                <li>
                                    <button class="rbt-nav-link nav-link" id="rbt-tab-cat-sidebar-3"
                                        data-bs-toggle="pill" data-bs-target="#rbt-nav-pill-3" type="button" role="tab"
                                        aria-controls="rbt-nav-pill-3" aria-selected="false">
                                        <span class="rbt-round-btn">
                                            <i class="fa-sharp fa-regular fa-camcorder"></i>
                                        </span>
                                        <span class="rbt-content">
                                            <span class="rbt-sub-category-title">
                                                <span>TVs, Audio-Video</span>
                                            </span>
                                            <span class="description">Top TVs, Audio-Videothe most famous brands</span>
                                        </span>
                                        <span class="icon">
                                            <i class="fa-regular fa-chevron-right"></i>
                                        </span>
                                    </button>
                                </li>
                                <li>
                                    <button class="rbt-nav-link nav-link" id="rbt-tab-cat-sidebar-4"
                                        data-bs-toggle="pill" data-bs-target="#rbt-nav-pill-4" type="button" role="tab"
                                        aria-controls="rbt-nav-pill-4" aria-selected="false">
                                        <span class="rbt-round-btn">
                                            <i class="fa-light fa-game-console-handheld"></i>
                                        </span>
                                        <span class="rbt-content">
                                            <span class="rbt-sub-category-title">
                                                <span>Gaming</span>
                                                <span class="rbt-product-badge rbt-bg-color-green">TRENDING</span>
                                            </span>
                                            <span class="description">Accessories for Games from
                                                the best brands</span>
                                        </span>
                                        <span class="icon">
                                            <i class="fa-regular fa-chevron-right"></i>
                                        </span>
                                    </button>
                                </li>
                                <li>
                                    <button class="rbt-nav-link nav-link" id="rbt-tab-cat-sidebar-5"
                                        data-bs-toggle="pill" data-bs-target="#rbt-nav-pill-5" type="button" role="tab"
                                        aria-controls="rbt-nav-pill-5" aria-selected="false">
                                        <span class="rbt-round-btn">
                                            <i class="fa-sharp fa-regular fa-headphones"></i>
                                        </span>
                                        <span class="rbt-content">
                                            <span class="rbt-sub-category-title">
                                                <span>Headphones & Music</span>
                                            </span>
                                            <span class="description">Catalog best Headphones
                                                & Music here now</span>
                                        </span>
                                        <span class="icon">
                                            <i class="fa-regular fa-chevron-right"></i>
                                        </span>
                                    </button>
                                </li>
                                <li>
                                    <button class="rbt-nav-link nav-link" id="rbt-tab-cat-sidebar-6"
                                        data-bs-toggle="pill" data-bs-target="#rbt-nav-pill-6" type="button" role="tab"
                                        aria-controls="rbt-nav-pill-6" aria-selected="false">
                                        <span class="rbt-round-btn">
                                            <i class="fa-sharp fa-regular fa-blender-phone"></i>
                                        </span>
                                        <span class="rbt-content">
                                            <span class="rbt-sub-category-title">
                                                <span>Appliances</span>
                                                <span class="rbt-product-badge rbt-bg-color-danger">HOT</span>
                                            </span>
                                            <span class="description">Full list links of all
                                                House Appliances active</span>
                                        </span>
                                        <span class="icon">
                                            <i class="fa-regular fa-chevron-right"></i>
                                        </span>
                                    </button>
                                </li>
                            </ul>
                            <!-- End tabs -->

                            <!-- Start quick links -->
                            <div class="rbt-sidebar-quick-links-part">
                                <div class="rbt-sidebar-bottom-inner">
                                    <hr class="rbt-separator rbt-separator-gray200 mb--24">
                                    <nav class="rbt-sidebar-nav">
                                        <h2 class="rbt-sub-category-title h4">
                                            <a data-bs-toggle="collapse" href="#collapseExample" role="button"
                                                aria-expanded="false" aria-controls="collapseExample">
                                                Quick Links
                                                <span class="icon"><i class="fa-regular fa-chevron-down"></i></span>
                                            </a>
                                        </h2>
                                        <div class="collapse" id="collapseExample">
                                            <ul class="rbt-sidebar-quick-links">
                                                <li><a href="about.html">About us</a></li>
                                                <li><a href="#">Reviews</a></li>
                                                <li><a href="#">Delivery & payment</a></li>
                                                <li><a href="blogs.html">Blog Articles</a></li>
                                            </ul>
                                        </div>
                                    </nav>
                                    <hr class="rbt-separator rbt-separator-gray200 mb--24 mt--24">
                                    <nav class="rbt-sidebar-nav">
                                        <h2 class="rbt-sub-category-title h4">
                                            <a data-bs-toggle="collapse" href="#collapseExample2" role="button"
                                                aria-expanded="false" aria-controls="collapseExample2">
                                                More Links
                                                <span class="icon"><i class="fa-regular fa-chevron-down"></i></span>
                                            </a>
                                        </h2>
                                        <div class="collapse" id="collapseExample2">
                                            <ul class="rbt-sidebar-quick-links">
                                                <li><a href="contact.html">Contacts</a></li>
                                                <li><a href="#">Information</a></li>
                                                <li><a href="terms-policy.html">Terms & Conditions</a></li>
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                            <!-- End quick links -->
                        </div>
                    </div>

                    <!-- Start sidebar footer -->
                    <div class="rbt-sidebar-left-content-footer">
                        <div class="rbt-sidebar-contact-area">
                            <div class="rbt-sidebar-contact-inner rbt-link-hover">
                                <p class="rbt-contact-text">Boston, 44 Main street</p>
                                <a class="rbt-contact-links" href="tel:+1(917)722-7425">+1(917)722-7425 (the call is
                                    free)</a>
                                <p class="rbt-contact-text mt--12">Mon-Sun 9.00 - 18.00</p>
                                <a class="rbt-contact-links" href="mailto:demo@example.com">demo@example.com</a>
                                <a class="rbt-contact-links d-block" href="find-store.html">View on map</a>
                            </div>
                        </div>
                    </div>
                    <!-- End sidebar footer -->

                </div>
            </div>

            <div class="rbt-sidebar-right-content">
                <div class="rbt-sidebar-right-inner">

                    <!-- Start tab content -->
                    <div class="tab-content" id="v-pills-tabContent">

                        <!-- Start single Category Tab content -->
                        <div class="rbt-tab-content tab-pane fade show active" id="rbt-nav-pill-1" role="tabpanel"
                            aria-labelledby="rbt-tab-cat-sidebar-1" tabindex="0">
                            <div class="rbt-sub-category-products">
    <div class="rbt-category-products-inner">

        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-7.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Action Camera</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Sports Cameras</a></li>
                <li><a href="shop-by-category.html">Underwater Cameras</a></li>
                <li><a href="shop-by-category.html">360 Cameras</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-8.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Camera lenses</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">VR Cameras</a></li>
                <li><a href="shop-by-category.html">Panoramic Cameras </a></li>
                <li><a href="shop-by-category.html">3D Cameras</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-9.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Digital Camera</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Drone Cameras</a></li>
                <li><a href="shop-by-category.html">Helmet Cameras</a></li>
                <li><a href="shop-by-category.html">Dual-Lens Cameras</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-10.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">DSLR</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Compact 360 Cameras</a></li>
                <li><a href="shop-by-category.html">DSLR Cameras</a></li>
                <li><a href="shop-by-category.html">Mirrorless Cameras</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-11.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Handycam</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Point-and-Shoot Cameras</a></li>
                <li><a href="shop-by-category.html">Bridge Cameras</a></li>
                <li><a href="shop-by-category.html">Compact Cameras</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-12.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Mirrorless Camera</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Full-Frame Mirrorless</a></li>
                <li><a href="shop-by-category.html">APS-C Mirrorless</a></li>
                <li><a href="shop-by-category.html">Micro Four Thirds Mirrorless</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-13.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Dash Cam</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Compact Mirrorless</a></li>
                <li><a href="shop-by-category.html">Medium Format Mirrorless</a></li>
                <li><a href="shop-by-category.html">Panoramic</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-14.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Video Camera</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Digital Camcorders</a></li>
                <li><a href="shop-by-category.html">Professional Camcorders</a></li>
                <li><a href="shop-by-category.html">4K Camcorders</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-15.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Instant Camera</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Compact Camcorders</a></li>
                <li><a href="shop-by-category.html">High Definition (HD) Camcorders</a></li>
                <li><a href="shop-by-category.html">Panoramic</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-16.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Camera Accessories</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">SD Cards (High-Speed)</a></li>
                <li><a href="shop-by-category.html">MicroSD Cards</a></li>
                <li><a href="shop-by-category.html">External Hard Drives</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-17.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Camera Tripod</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Travel Tripods</a></li>
                <li><a href="shop-by-category.html">Tabletop Tripods</a></li>
                <li><a href="shop-by-category.html">Monopods</a></li>
            </ul>
        </div>
        <!-- End product singel -->

    </div>
    <!-- Start banner -->
    <div class="rbt-sidebar-banner">
        <div class="rbt-banner-img">
            <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/product-banner.webp" alt="Banner Image">
        </div>
        <div class="rbt-sidebar-banner-content">
            <p class="rbt-sidebar-banner-text">Camera Accessories
                <span class="rbt-text-color-primary rbt-text-semi-bold ml--4">11th December</span>
            </p>
            <h2 class="rbt-sidebar-banner-titile h4">Up to 40% Off <span class="rbt-text-regular">On All Brands</span>
            </h2>
            <a href="#" class="rbt-btn rbt-btn-sm">Know More</a>
        </div>
    </div>
    <!-- End banner -->

</div>
                        </div>
                        <!-- End single Category Tab content -->

                        <!-- Start single Category Tab content -->
                        <div class="rbt-tab-content tab-pane fade" id="rbt-nav-pill-2" role="tabpanel"
                            aria-labelledby="rbt-tab-cat-sidebar-2" tabindex="0">
                            <div class="rbt-sub-category-products">
    <div class="rbt-category-products-inner">

        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-1.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Fitness Tracker</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Smart Bands</a></li>
                <li><a href="shop-by-category.html">Heart Rate Monitors</a></li>
                <li><a href="shop-by-category.html">Sleep Trackers</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-2.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Bluetooth</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Luxury Bluetooth Watches</a></li>
                <li><a href="shop-by-category.html">Hybrid Smartwatches</a></li>
                <li><a href="shop-by-category.html">Kids' Smartwatches</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-3.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Hybrid</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Fitness Hybrid Watches</a></li>
                <li><a href="shop-by-category.html">Smart Hybrid Watches</a></li>
                <li><a href="shop-by-category.html">Classic Hybrid Watches</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-4.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Regular</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Analog Watches</a></li>
                <li><a href="shop-by-category.html">Digital Watches</a></li>
                <li><a href="shop-by-category.html">Dress Watches</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-5.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Touchscreen</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Smartwatches</a></li>
                <li><a href="shop-by-category.html">Fitness Trackers</a></li>
                <li><a href="shop-by-category.html">Hybrid Smartwatches</a></li>
            </ul>
        </div>
        <!-- End product singel -->

    </div>
    <!-- Start banner -->
    <div class="rbt-sidebar-banner">
        <div class="rbt-banner-img">
            <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/product-banner.webp" alt="Banner Image">
        </div>
        <div class="rbt-sidebar-banner-content">
            <p class="rbt-sidebar-banner-text">Starting From <span
                    class="rbt-text-color-primary rbt-text-semi-bold ml--4">11th
                    December</span></p>
            <h2 class="rbt-sidebar-banner-titile h4">Up to 40% Off <span class="rbt-text-regular">On All Brands</span>
            </h2>
            <a href="#" class="rbt-btn rbt-btn-sm">Know More</a>
        </div>
    </div>
    <!-- End banner -->

</div>
                        </div>
                        <!-- End single Category Tab content -->

                        <!-- Start single Category Tab content -->
                        <div class="rbt-tab-content tab-pane fade" id="rbt-nav-pill-3" role="tabpanel"
                            aria-labelledby="rbt-tab-cat-sidebar-3" tabindex="0">
                            <div class="rbt-sub-category-products">
    <div class="rbt-category-products-inner">

        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-18.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">QLED TV</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li>
                    <a href="shop-by-categories.html" class="rbt-underline-btn btn-white">
                        View All
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-19.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Smart TV</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li>
                    <a href="shop-by-categories.html" class="rbt-underline-btn btn-white">
                        View All
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-20.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">UHD TV</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li>
                    <a href="shop-by-categories.html" class="rbt-underline-btn btn-white">
                        View All
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-21.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">HD TV</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li>
                    <a href="shop-by-categories.html" class="rbt-underline-btn btn-white">
                        View All
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-22.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">LED TV</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li>
                    <a href="shop-by-categories.html" class="rbt-underline-btn btn-white">
                        View All
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-23.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">4K TV</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li>
                    <a href="shop-by-categories.html" class="rbt-underline-btn btn-white">
                        View All
                        <i class="fa-regular fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End product singel -->

    </div>
    <!-- Start banner -->
    <div class="rbt-sidebar-banner">
        <div class="rbt-banner-img">
            <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/product-banner.webp" alt="Banner Image">
        </div>
        <div class="rbt-sidebar-banner-content">
            <p class="rbt-sidebar-banner-text">Starting From <span
                    class="rbt-text-color-primary rbt-text-semi-bold ml--4">11th
                    December</span></p>
            <h2 class="rbt-sidebar-banner-titile h4">Up to 40% Off <span class="rbt-text-regular">On All Brands</span>
            </h2>
            <a href="#" class="rbt-btn rbt-btn-sm">Know More</a>
        </div>
    </div>
    <!-- End banner -->

</div>
                        </div>
                        <!-- End single Category Tab content -->

                        <!-- Start single Category Tab content -->
                        <div class="rbt-tab-content tab-pane fade" id="rbt-nav-pill-4" role="tabpanel"
                            aria-labelledby="rbt-tab-cat-sidebar-4" tabindex="0">
                            <div class="rbt-sub-category-products">
    <div class="rbt-category-products-inner">

        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-24.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Gaming Keyboard</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Apex Gamer Pro</a></li>
                <li><a href="shop-by-category.html">Stealth Strike Keyboard</a></li>
                <li><a href="shop-by-category.html">Rapid Fire RGB</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-25.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Gaming Headset</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">SoundStorm Pro</a></li>
                <li><a href="shop-by-category.html">EchoMaster Elite</a></li>
                <li><a href="shop-by-category.html">BattleTune 360</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-26.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Gaming Chair</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Elite Gamer Throne</a></li>
                <li><a href="shop-by-category.html">Turbo Comfort Seat</a></li>
                <li><a href="shop-by-category.html">Pro Series Gaming Chair</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-27.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Mouse Pads</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">GlidePro Mouse Pad</a></li>
                <li><a href="shop-by-category.html">PixelPerfect Pad</a></li>
                <li><a href="shop-by-category.html">EagleEye Mouse Mat</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-28.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Joystick</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">ProGamer Joystick</a></li>
                <li><a href="shop-by-category.html">Precision Play Controller</a></li>
                <li><a href="shop-by-category.html">TurboGrip Joystick</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-29.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">VR headset</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">VisionSphere VR Headset</a></li>
                <li><a href="shop-by-category.html">ImmersiveEye VR Goggles</a></li>
                <li><a href="shop-by-category.html">RealityFusion Headset</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-30.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">PlayStation Acce...</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Crystal Clear Faceplate</a></li>
                <li><a href="shop-by-category.html">ComfortFit Chair</a></li>
                <li><a href="shop-by-category.html">Dynamic RGB LED</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-31.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Gaming Desk</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">ProGamer Desk</a></li>
                <li><a href="shop-by-category.html">Titan Gaming Station</a></li>
                <li><a href="shop-by-category.html">Arcade Pro Desk</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-32.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Gaming Sofa</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Victory Lounge</a></li>
                <li><a href="shop-by-category.html">Pixel Perch</a></li>
                <li><a href="shop-by-category.html">Gamer's Retreat</a></li>
            </ul>
        </div>
        <!-- End product singel -->

    </div>
    <!-- Start banner -->
    <div class="rbt-sidebar-banner">
        <div class="rbt-banner-img">
            <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/product-banner.webp" alt="Banner Image">
        </div>
        <div class="rbt-sidebar-banner-content">
            <p class="rbt-sidebar-banner-text">Starting From <span
                    class="rbt-text-color-primary rbt-text-semi-bold ml--4">11th
                    December</span></p>
            <h2 class="rbt-sidebar-banner-titile h4">Up to 40% Off <span class="rbt-text-regular">On All Brands</span>
            </h2>
            <a href="#" class="rbt-btn rbt-btn-sm">Know More</a>
        </div>
    </div>
    <!-- End banner -->

</div>
                        </div>
                        <!-- End single Category Tab content -->

                        <!-- Start single Category Tab content -->
                        <div class="rbt-tab-content tab-pane fade" id="rbt-nav-pill-5" role="tabpanel"
                            aria-labelledby="rbt-tab-cat-sidebar-5" tabindex="0">
                            <div class="rbt-sub-category-products">

    <div class="rbt-category-products-inner">
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-33.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Bluetooth Headphone</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">SoundWave Pro</a></li>
                <li><a href="shop-by-category.html">AeroSound Bluetooth</a></li>
                <li><a href="shop-by-category.html">PulseBeats Wireless</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-34.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Headphone Stand</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Audio Aegis</a></li>
                <li><a href="shop-by-category.html">Harmonic Holder</a></li>
                <li><a href="shop-by-category.html">Headset Haven</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-35.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Home Theater</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Cinematic Sound Bar</a></li>
                <li><a href="shop-by-category.html">Ultra HD Projector</a></li>
                <li><a href="shop-by-category.html">4K Smart TV</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-36.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Bluetooth Speaker</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">SoundWave Pro</a></li>
                <li><a href="shop-by-category.html">BassBlaster 360</a></li>
                <li><a href="shop-by-category.html">AeroSound Compact</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-37.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Soundbar</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Versatile Soundbar</a></li>
                <li><a href="shop-by-category.html">Signature Series Soundbar</a></li>
                <li><a href="shop-by-category.html">ProSound Soundbar</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-38.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Microphone</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">SoundWave Pro</a></li>
                <li><a href="shop-by-category.html">EchoSphere Mic</a></li>
                <li><a href="shop-by-category.html">ClearCast 3000</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-39.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Voice Recorder</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">EchoNote Pro</a></li>
                <li><a href="shop-by-category.html">VoxCapture 3000</a></li>
                <li><a href="shop-by-category.html">SoundScribe</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-40.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Sound Card</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">AeroSound Pro</a></li>
                <li><a href="shop-by-category.html">EchoMaster FX</a></li>
                <li><a href="shop-by-category.html">Vortex SoundBlaster</a></li>
            </ul>
        </div>
        <!-- End product singel -->

    </div>
    <!-- Start banner -->
    <div class="rbt-sidebar-banner">
        <div class="rbt-banner-img">
            <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/product-banner.webp" alt="Banner Image">
        </div>
        <div class="rbt-sidebar-banner-content">
            <p class="rbt-sidebar-banner-text">Starting From <span
                    class="rbt-text-color-primary rbt-text-semi-bold ml--4">11th
                    December</span></p>
            <h2 class="rbt-sidebar-banner-titile h4">Up to 40% Off <span class="rbt-text-regular">On All Brands</span>
            </h2>
            <a href="#" class="rbt-btn rbt-btn-sm">Know More</a>
        </div>
    </div>
    <!-- End banner -->
</div>
                        </div>
                        <!-- End single Category Tab content -->

                        <!-- Start single Category Tab content -->
                        <div class="rbt-tab-content tab-pane fade" id="rbt-nav-pill-6" role="tabpanel"
                            aria-labelledby="rbt-tab-cat-sidebar-6" tabindex="0">
                            <div class="rbt-sub-category-products">
    <div class="rbt-category-products-inner">
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-41.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Air Conditioner</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">CoolBreeze Pro</a></li>
                <li><a href="shop-by-category.html">ChillMaster Elite</a></li>
                <li><a href="shop-by-category.html">AirFlow Genius</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-42.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Geyser</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">AquaFlow Geysers</a></li>
                <li><a href="shop-by-category.html">TurboHeat Geysers</a></li>
                <li><a href="shop-by-category.html">EcoHeat Geysers</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-43.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Oven</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">CrispBake Oven</a></li>
                <li><a href="shop-by-category.html">QuickHeat Convection Oven</a></li>
                <li><a href="shop-by-category.html">PerfectBake Electric Oven</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-44.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Air Fryer</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">CrispMaster Air Fryer</a></li>
                <li><a href="shop-by-category.html">Healthy Fry Pro</a></li>
                <li><a href="shop-by-category.html">QuickCrisp Air Fryer</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-45.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Washing Machine</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">EcoClean Pro</a></li>
                <li><a href="shop-by-category.html">UltraWash 360</a></li>
                <li><a href="shop-by-category.html">QuickSpin Deluxe</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-46.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Sewing Machine</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">StitchPro 300</a></li>
                <li><a href="shop-by-category.html">SewMaster Deluxe</a></li>
                <li><a href="shop-by-category.html">QuiltCraft Elite</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-47.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Air Purifier</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">PureAir Breeze</a></li>
                <li><a href="shop-by-category.html">FreshFlow Purifier</a></li>
                <li><a href="shop-by-category.html">BreatheEasy Pro</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-48.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Vacuum Cleaner</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">PowerSweep Pro</a></li>
                <li><a href="shop-by-category.html">UltraClean Cyclone</a></li>
                <li><a href="shop-by-category.html">DustBuster Max</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-49.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Blender</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Smoothie Master Pro</a></li>
                <li><a href="shop-by-category.html">NutriBlend Ultra</a></li>
                <li><a href="shop-by-category.html">EcoBlend Portable Blender</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-50.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Cooker</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">PowerMix 3000</a></li>
                <li><a href="shop-by-category.html">Frozen Fusion Blender</a></li>
                <li><a href="shop-by-category.html">UltraSmooth Blender</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-51.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Iron</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">Blender & Chop Duo</a></li>
                <li><a href="shop-by-category.html">TurboMix Professional</a></li>
                <li><a href="shop-by-category.html">BlendSmart 2-in-1</a></li>
            </ul>
        </div>
        <!-- End product singel -->
        <!-- Start product singel -->
        <div class="rbt-sub-category-product">
            <a href="#" class="rbt-sidebar-category-img">
                <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/category-product-52.webp" alt="Product Image">
            </a>
            <h2 class="rbt-category-offcanvas-header h5"><a href="shop-by-categories.html">Mini Heater</a></h2>
            <ul class="rbt-product-features has-link-underline-effect">
                <li><a href="shop-by-category.html">HeatWave Blanket</a></li>
                <li><a href="shop-by-category.html">ThermoCushion </a></li>
                <li><a href="shop-by-category.html">SootheHeat Massager</a></li>
            </ul>
        </div>
        <!-- End product singel -->

    </div>
    <!-- Start banner -->
    <div class="rbt-sidebar-banner">
        <div class="rbt-banner-img">
            <img src="<?php echo base_url('assets/frontend/'); ?>images/product-img/sidebar-category/product-banner.webp" alt="Banner Image">
        </div>
        <div class="rbt-sidebar-banner-content">
            <p class="rbt-sidebar-banner-text">Starting From <span
                    class="rbt-text-color-primary rbt-text-semi-bold ml--4">11th
                    December</span></p>
            <h2 class="rbt-sidebar-banner-titile h4">Up to 40% Off <span class="rbt-text-regular">On All Brands</span>
            </h2>
            <a href="#" class="rbt-btn rbt-btn-sm">Know More</a>
        </div>
    </div>
    <!-- End banner -->

</div>
                        </div>
                        <!-- End single Category Tab content -->
                    </div>

                    <!-- End tab content -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Side Nav -->
