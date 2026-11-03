
<footer class="rbt-footer rbt-footer-style-three rbt-bg-color-gray-light pt--48">
  <?= $this->include('storefront/partials/footer_main') ?>
  <div class="rbt-separator-mid pt--56">
    <div class="container">
      <hr class="rbt-separator m-0 rbt-bg-color-gray-100">
    </div>
  </div>

  <!-- Start Copyright Area  -->
  <div class="copyright-area copyright-style-1 pb--32 pt--32">
    <div class="container">
      <div class="row align-items-center justify-content-between row--12 mt_dec--24">
        <div class="col-xl-4 col-lg-6 col-md-12 col-12 mt--24">
          <p class="rbt-link-hover text-center text-lg-start">
            Copyright <span class="copyright-year"><?= date('Y') ?></span> &copy;
            <a href="<?= site_url('home') ?>" class="rbt-text-semi-bold">Bloom Kidswear</a>. All rights reserved.
          </p>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12 col-12 mt--24">
          <ul class="payment-img-link">
            <li>
              <a href="#!"><img src="<?php echo base_url('assets/frontend/'); ?>images/payment-brand/image-01.webp" alt="eCommerce Brand Image">
              </a>
            </li>
          </ul>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-12 mt--24">
          <ul
            class="copyright-link rbt-link-hover justify-content-center justify-content-lg-start justify-content-xl-end mt_sm--12 mt_md--12 mt_lg--12">
            <li><a href="<?= site_url('refund-and-return-policy') ?>">Refund policy</a></li>
            <li><a href="<?= site_url('privacy-policy') ?>">Privacy policy</a></li>
            <li><a href="<?= site_url('terms-and-conditions') ?>">Terms & conditions</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End Copyright Area  -->
</footer>

<div class="rbt-toolbar rbt-toolbar--bottom d-block d-xl-none">
    <div class="container p--0">
        <div class="row row row--0">
            <div class="col-md-12">
                <ul class="rbt-quick-access onepagenav">
                    <li class="rbt-access-box">
                        <a href="<?= site_url('shop') ?>" class="rbt-round-btn has-rbt-md-fsize">
                            <i class="fa-regular fa-bag-shopping"></i>
                            <span class="rbt-toolbar-label"> Shop</span>
                        </a>
                    </li>

                    <li class="rbt-access-box rbt-wishlist">
                        <a class="rbt-round-btn has-rbt-md-fsize" href="<?= site_url('wishlist') ?>">
                            <i class="fa-regular fa-heart"></i>
                            <div class="access-box-count bloom-wishlist-count" style="display:none">0</div>
                            <span class="rbt-toolbar-label"> Wishlist</span>
                        </a>
                    </li>

                    <li class="rbt-access-box">
                        <a class="rbt-common-search-trigger-active rbt-round-btn has-rbt-md-fsize rbt-modern-close-btn"
                            href="<?= site_url('home') ?>">
                            <i class="fa-regular fa-house search-icon"></i>
                            <div class="modern-close-wrapper"></div>
                            <span class="rbt-toolbar-label"> Home</span>
                        </a>
                    </li>



                    

                    <li class="rbt-access-box">
                        <?php if (session('customer_id')): ?>
                        <a href="<?= site_url('account') ?>" class="rbt-round-btn has-rbt-md-fsize"><i class="fa-regular fa-user"></i><span class="rbt-toolbar-label"> Account</span></a>
                        <?php else: ?>
                        <a href="#!" class="rbt-round-btn has-rbt-md-fsize" data-bs-toggle="modal" data-bs-target="#authModal" data-auth-view="signin"><i class="fa-regular fa-user"></i><span class="rbt-toolbar-label"> Profile</span></a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Footer aera -->
    <div class="rbt-toaster rbt-toaster-compare" role="alert" aria-atomic="true" aria-live="assertive"><i
        class="fa-regular fa-check mr--8"></i>Added in Compare</div>
<div class="rbt-toaster rbt-toaster-wishlist" role="alert" aria-atomic="true" aria-live="assertive"><i
        class="fa-regular fa-check mr--8"></i>Added in Wishlist</div>
<div class="rbt-progress-parent">
    <svg class="rbt-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<a class="close_side_menu catagories-close_side_menu" href="javascript:void(0);"></a>
<a href="javascript:void(0);" class="common-close_search_dropdown"></a>
