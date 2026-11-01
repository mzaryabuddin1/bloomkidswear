/* Bloom Kidswear storefront: auth modal (OTP / Google), wishlist (localStorage <-> account). */
(function () {
  'use strict';

  var BASE = (document.querySelector('meta[name="base-url"]') || {}).content || (location.origin + '/');
  var csrfMeta = document.querySelector('meta[name="csrf-token"]');
  var loggedIn = (document.querySelector('meta[name="bloom-auth"]') || {}).content === '1';
  var WL_KEY = 'bloom_wishlist';

  function url(path) { return new URL(path, BASE).href; }

  // ---------- small helpers ----------
  function setCsrf(data) {
    if (data && data.csrfHash && csrfMeta) csrfMeta.setAttribute('content', data.csrfHash);
  }

  function post(path, body) {
    var fd = body instanceof FormData ? body : new FormData();
    if (!(body instanceof FormData)) Object.keys(body || {}).forEach(function (k) { fd.append(k, body[k]); });
    return fetch(url(path), {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrfMeta ? csrfMeta.content : '' },
      body: fd
    }).then(function (r) {
      return r.json().then(function (d) { setCsrf(d); d._status = r.status; return d; });
    });
  }

  function getJson(path) {
    return fetch(url(path), { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(function (r) { return r.json(); }).then(function (d) { setCsrf(d); return d; });
  }

  var toastTimer;
  function toast(msg) {
    var el = document.getElementById('bloom-toast');
    if (!el) return;
    el.textContent = msg;
    el.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function () { el.classList.remove('show'); }, 2200);
  }

  // ---------- wishlist ----------
  var wishlist = []; // current items (server list when logged in, local list otherwise)

  function readLocal() {
    try { var v = JSON.parse(localStorage.getItem(WL_KEY) || '[]'); return Array.isArray(v) ? v : []; } catch (e) { return []; }
  }
  function writeLocal(list) {
    try { localStorage.setItem(WL_KEY, JSON.stringify(list)); } catch (e) { /* storage unavailable */ }
  }

  function refreshWishlistUi() {
    document.querySelectorAll('.bloom-wishlist-count').forEach(function (el) {
      el.textContent = wishlist.length;
      el.style.display = wishlist.length ? '' : 'none';
    });
    var keys = {};
    wishlist.forEach(function (i) { keys[i.key] = true; });
    document.querySelectorAll('.rbt-wishlisted-btn').forEach(function (btn) {
      var item = extractItem(btn);
      btn.classList.toggle('bloom-wished', !!(item && keys[item.key]));
    });
    document.dispatchEvent(new CustomEvent('bloom:wishlist', { detail: wishlist }));
  }

  function extractItem(btn) {
    var card = btn.closest('.rbt-product-card, .rbt-card, .rbt-single-product, .product, li, article, .rbt-product-single');
    if (!card) return null;
    var titleEl = card.querySelector('[class*="rbt-card-title"], .rbt-product-title, .title, h2, h3, h4');
    var linkEl = (titleEl && titleEl.querySelector('a')) || card.querySelector('a[href]:not([href="#"]):not([href="#!"])');
    var imgEl = card.querySelector('img.rbt-prd-img') || card.querySelector('img');
    var priceEl = card.querySelector('[class*="price"]');
    var name = titleEl ? titleEl.textContent.replace(/\s+/g, ' ').trim() : '';
    if (!name) return null;
    var href = linkEl ? linkEl.getAttribute('href') : '';
    var img = imgEl ? (imgEl.currentSrc || imgEl.src) : '';
    return {
      key: (href || '') + '|' + name.toLowerCase(),
      name: name,
      image: img,
      url: href && href.charAt(0) !== '#' ? new URL(href, location.href).href : '',
      price: priceEl ? priceEl.textContent.replace(/\s+/g, ' ').trim().slice(0, 50) : ''
    };
  }

  function toggleWishlist(item) {
    if (loggedIn) {
      return post('wishlist/toggle', item).then(function (d) {
        if (d.success) { wishlist = d.items || []; refreshWishlistUi(); toast(d.message); }
      });
    }
    var idx = wishlist.findIndex(function (i) { return i.key === item.key; });
    if (idx > -1) { wishlist.splice(idx, 1); toast('Removed from wishlist.'); }
    else { wishlist.unshift(item); toast('Added to wishlist.'); }
    writeLocal(wishlist);
    refreshWishlistUi();
    return Promise.resolve();
  }

  function removeFromWishlist(key) {
    if (loggedIn) {
      return post('wishlist/remove', { key: key }).then(function (d) { wishlist = d.items || []; refreshWishlistUi(); });
    }
    wishlist = wishlist.filter(function (i) { return i.key !== key; });
    writeLocal(wishlist);
    refreshWishlistUi();
    return Promise.resolve();
  }

  // Push the guest list into the account right after sign in, then clear it locally.
  function syncLocalToAccount() {
    var local = readLocal();
    if (!local.length) return Promise.resolve();
    return post('wishlist/sync', { items: JSON.stringify(local) }).then(function (d) {
      if (d.success) { writeLocal([]); wishlist = d.items || []; }
    }).catch(function () { /* keep local copy, retry next page */ });
  }

  function initWishlist() {
    document.querySelectorAll('.rbt-wishlisted-btn').forEach(function (btn) {
      btn.removeAttribute('data-bs-toggle');
      btn.removeAttribute('data-bs-target');
    });

    document.addEventListener('click', function (e) {
      var btn = e.target.closest('.rbt-wishlisted-btn');
      if (!btn) return;
      e.preventDefault();
      e.stopPropagation();
      var item = extractItem(btn);
      if (item) toggleWishlist(item);
    }, true);

    if (loggedIn) {
      syncLocalToAccount().then(function () { return getJson('wishlist/items'); }).then(function (d) {
        wishlist = d.items || wishlist;
        refreshWishlistUi();
      }).catch(function () { refreshWishlistUi(); });
    } else {
      wishlist = readLocal();
      refreshWishlistUi();
    }
  }

  window.BloomWishlist = {
    ready: function (cb) { document.addEventListener('bloom:wishlist', function (e) { cb(e.detail); }); cb(wishlist); },
    remove: removeFromWishlist,
    refresh: refreshWishlistUi,
    isLoggedIn: function () { return loggedIn; }
  };

  // ---------- auth modal ----------
  function initAuth() {
    var modalEl = document.getElementById('authModal');
    if (!modalEl) return;

    var alertBox = document.getElementById('bloom-auth-alert');
    var pendingEmail = '';
    var resendTimers = {};

    function showAlert(msg, ok) {
      alertBox.textContent = msg || '';
      alertBox.className = 'bloom-auth-alert' + (msg ? (ok ? ' ok' : ' error') : '');
    }

    function go(view, message) {
      modalEl.querySelectorAll('.bloom-auth-view').forEach(function (v) {
        v.classList.toggle('active', v.getAttribute('data-view') === view);
      });
      showAlert(message || '', true);
      var first = modalEl.querySelector('.bloom-auth-view.active input:not([type=hidden])');
      if (first) setTimeout(function () { first.focus(); }, 150);
    }

    function startResendTimer(purpose) {
      var btn = modalEl.querySelector('[data-auth-resend="' + purpose + '"]');
      if (!btn) return;
      var left = 60;
      clearInterval(resendTimers[purpose]);
      btn.disabled = true;
      btn.textContent = 'Resend code (' + left + 's)';
      resendTimers[purpose] = setInterval(function () {
        left--;
        if (left <= 0) { clearInterval(resendTimers[purpose]); btn.disabled = false; btn.textContent = 'Resend code'; return; }
        btn.textContent = 'Resend code (' + left + 's)';
      }, 1000);
    }

    modalEl.addEventListener('show.bs.modal', function (e) {
      var trigger = e.relatedTarget;
      go((trigger && trigger.getAttribute('data-auth-view')) || 'signin');
    });

    modalEl.addEventListener('click', function (e) {
      var nav = e.target.closest('[data-auth-go]');
      if (nav) { go(nav.getAttribute('data-auth-go')); return; }

      var resend = e.target.closest('[data-auth-resend]');
      if (resend) {
        var purpose = resend.getAttribute('data-auth-resend');
        resend.disabled = true;
        post('account/otp/resend', { email: pendingEmail, purpose: purpose }).then(function (d) {
          if (d.step === 'signup') { go('signup', d.message); return; }
          showAlert(d.message, d.success);
          if (d.success) startResendTimer(purpose); else resend.disabled = false;
        });
      }
    });

    modalEl.querySelectorAll('form[data-auth-form]').forEach(function (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var btn = form.querySelector('[type=submit]');
        var label = btn.textContent;
        btn.disabled = true;
        btn.textContent = 'Please wait...';
        showAlert('');

        post(form.getAttribute('data-auth-form'), new FormData(form)).then(function (d) {
          if (d.email) pendingEmail = d.email;

          if (d.success && d.reload) {
            syncLocalToAccount().then(function () { location.reload(); });
            return;
          }
          if (d.step === 'otp' && d.success) {
            modalEl.querySelectorAll('[data-otp-email]').forEach(function (i) { i.value = pendingEmail; });
            go('otp', d.message);
            startResendTimer('signup');
          } else if (d.step === 'reset' && d.success) {
            modalEl.querySelectorAll('[data-otp-email]').forEach(function (i) { i.value = pendingEmail; });
            go('reset', d.message);
            startResendTimer('reset');
          } else if (d.step === 'signin' && d.success) {
            form.reset();
            go('signin', d.message);
          } else {
            showAlert(d.message || 'Please try again.', d.success);
          }
        }).catch(function () {
          showAlert('Something went wrong. Please try again.');
        }).then(function () {
          btn.disabled = false;
          btn.textContent = label;
        });
      });
    });

    // Opened by a redirect (login required) or after a failed Google sign in.
    var flashView = modalEl.getAttribute('data-flash-view');
    var flashError = modalEl.getAttribute('data-flash-error');
    if ((flashView || flashError) && window.bootstrap) {
      var m = new bootstrap.Modal(modalEl);
      modalEl.addEventListener('shown.bs.modal', function once() {
        modalEl.removeEventListener('shown.bs.modal', once);
        if (flashError) showAlert(flashError);
      });
      m.show();
      go(flashView || 'signin');
    }
  }

  // ---------- shop: filter without full page reloads ----------
  function initShop() {
    var results = document.getElementById('bloom-results');
    if (!results) return;

    var regions = ['bloom-shop-top', 'bloom-filters', 'bloom-results'];
    var current = location.href;
    var controller = null;

    function load(target, push) {
      if (controller) controller.abort();
      controller = window.AbortController ? new AbortController() : null;
      results.style.transition = 'opacity .2s';
      results.style.opacity = '0.45';
      results.style.pointerEvents = 'none';

      fetch(target, { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' }, signal: controller ? controller.signal : undefined })
        .then(function (r) { if (!r.ok) throw new Error(r.status); return r.text(); })
        .then(function (html) {
          var doc = new DOMParser().parseFromString(html, 'text/html');
          regions.forEach(function (id) {
            var fresh = doc.getElementById(id), old = document.getElementById(id);
            if (!fresh || !old) return;
            // theme scroll animations never fire for injected nodes, so drop them
            fresh.querySelectorAll('.rbt-scroll-trigger').forEach(function (n) { n.classList.remove('rbt-scroll-trigger', 'fade_in', 'zoom_in'); });
            old.innerHTML = fresh.innerHTML;
          });
          document.title = doc.title;
          if (push) history.pushState({ shop: true }, '', target);
          current = target;
          if (window.BloomWishlist) BloomWishlist.refresh();
          var top = results.getBoundingClientRect().top + window.pageYOffset - 110;
          if (window.pageYOffset > top) window.scrollTo({ top: Math.max(top, 0), behavior: 'smooth' });
        })
        .catch(function (e) { if (e.name !== 'AbortError') location.href = target; })
        .then(function () {
          results.style.opacity = '';
          results.style.pointerEvents = '';
        });
    }

    function isShopUrl(href) {
      try {
        var u = new URL(href, location.href);
        var shop = new URL('shop', BASE).pathname.replace(/\/$/, '');
        var path = u.pathname.replace(/\/$/, '');
        return u.origin === location.origin && (path === shop || path.indexOf(shop + '/category/') === 0);
      } catch (e) { return false; }
    }

    document.addEventListener('click', function (e) {
      var box = e.target.closest('[data-shop-url]');
      if (box) { e.preventDefault(); load(box.getAttribute('data-shop-url'), true); return; }
      var a = e.target.closest('a[href]');
      if (!a || e.metaKey || e.ctrlKey || e.shiftKey || a.target === '_blank') return;
      if (!a.closest('#bloom-shop-top, #bloom-filters, #bloom-results')) return;
      if (a.getAttribute('data-bs-toggle') || !isShopUrl(a.href)) return;
      e.preventDefault();
      load(a.href, true);
    });

    document.addEventListener('change', function (e) {
      if (e.target.matches('[data-shop-select]')) load(e.target.value, true);
    });

    document.addEventListener('submit', function (e) {
      var form = e.target.closest('form[data-shop-form]');
      if (!form) return;
      e.preventDefault();
      var params = new URLSearchParams(new FormData(form));
      Array.from(params.keys()).forEach(function (k) { if (params.get(k) === '') params.delete(k); });
      var qs = params.toString();
      load(new URL('shop', BASE).href + (qs ? '?' + qs : ''), true);
    });

    window.addEventListener('popstate', function () {
      if (location.href !== current) load(location.href, false);
    });
  }

  // ---------- cart: sidebar mini-cart, add to cart, cart page ----------
  function money(n) { return 'PKR ' + Math.round(n).toLocaleString('en-US'); }
  function esc(s) { var d = document.createElement('div'); d.textContent = s == null ? '' : s; return d.innerHTML; }

  function renderCart(cart) {
    if (!cart) return;
    document.querySelectorAll('.bloom-cart-count').forEach(function (el) {
      el.textContent = cart.count; el.style.display = cart.count ? '' : 'none';
    });
    document.querySelectorAll('.bloom-cart-total').forEach(function (el) { el.textContent = money(cart.subtotal); });

    var list = document.getElementById('bloom-mini-items');
    if (list) {
      list.innerHTML = cart.items.map(function (i) {
        return '<li class="minicart-item"><div class="thumbnail"><a href="' + esc(i.url) + '"><img src="' + esc(i.image) + '" alt="' + esc(i.name) + '"></a></div>' +
          '<div class="product-content"><h3 class="title h6"><a href="' + esc(i.url) + '">' + esc(i.name) + '</a></h3>' +
          '<span class="quantity">' + i.qty + 'x <span class="price">' + money(i.price) + '</span>' + (i.size ? ' <small style="color:#7b8794">· Size ' + esc(i.size) + '</small>' : '') + '</span>' +
          '<div class="bottom-part"><div class="rbt-qty-area"><button type="button" class="qty-item-btn qty-item-btn-decr"><i class="fa-solid fa-minus"></i></button>' +
          '<input type="number" class="items-qty-input" data-cart-key="' + esc(i.key) + '" value="' + String(i.qty).padStart(2, '0') + '" min="1" max="' + i.max + '">' +
          '<button type="button" class="qty-item-btn qty-item-btn-incr"><i class="fa-solid fa-plus"></i></button></div></div></div>' +
          '<div class="close-btn"><button type="button" class="rbt-round-btn" data-cart-remove="' + esc(i.key) + '" aria-label="Remove"><i class="fa-solid fa-xmark"></i></button></div></li>';
      }).join('');
      var empty = document.getElementById('bloom-mini-empty'), foot = document.getElementById('bloom-mini-footer');
      if (empty) empty.style.display = cart.items.length ? 'none' : '';
      if (foot) {
        foot.style.display = cart.items.length ? '' : 'none';
        var set = function (k, v) { foot.querySelectorAll('[data-cart="' + k + '"]').forEach(function (el) { el.textContent = v; }); };
        set('count', cart.count); set('subtotal', money(cart.subtotal)); set('total', money(cart.total));
        set('shipping', cart.shipping ? money(cart.shipping) : 'Free');
        var offer = foot.querySelector('[data-cart="offer"]');
        if (offer) offer.innerHTML = cart.remaining > 0 ? 'Add <strong>' + money(cart.remaining) + '</strong> more to get <strong>free delivery</strong>' : '🎉 You’ve unlocked <strong>free delivery</strong>';
        var bar = foot.querySelector('[data-cart="progress"]');
        if (bar) bar.style.width = cart.progress + '%';
      }
    }
  }

  function openMiniCart() {
    var side = document.querySelector('.rbt-cart-side-menu');
    if (side) { side.classList.add('side-menu-active'); document.body.classList.add('cart-sidenav-menu-active'); }
  }

  function refreshCartPage() {
    var region = document.getElementById('bloom-cart-region');
    if (!region) return Promise.resolve();
    return fetch(location.pathname, { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(function (r) { return r.text(); })
      .then(function (html) {
        var fresh = new DOMParser().parseFromString(html, 'text/html').getElementById('bloom-cart-region');
        if (fresh) region.innerHTML = fresh.innerHTML;
      });
  }

  function cartCall(path, body) {
    return post(path, body).then(function (d) {
      if (d.cart) renderCart(d.cart);
      return d;
    });
  }

  function initCart() {
    getJson('cart/data').then(function (d) { renderCart(d.cart); }).catch(function () {});

    document.addEventListener('click', function (e) {
      var rm = e.target.closest('[data-cart-remove]');
      if (rm) {
        e.preventDefault();
        cartCall('cart/remove', { key: rm.getAttribute('data-cart-remove') }).then(refreshCartPage);
        return;
      }
      var add = e.target.closest('[data-add-to-cart]');
      if (!add) return;
      e.preventDefault();
      var card = add.closest('.rbt-product-card'), sel = card && card.querySelector('[data-card-size]');
      var size = sel ? sel.value : (add.getAttribute('data-size') || '');
      if (sel && !size) {
        sel.style.borderColor = '#e0457b'; sel.focus(); toast('Please select a size first.');
        sel.addEventListener('change', function () { sel.style.borderColor = ''; }, { once: true });
        return;
      }
      if (add.dataset.busy) return;
      add.dataset.busy = '1';
      cartCall('cart/add', { product_id: add.getAttribute('data-add-to-cart'), size: size, qty: 1 }).then(function (d) {
        if (d.success) { toast(d.message || 'Added to your cart.'); openMiniCart(); } else { toast(d.message || 'Could not add this item.'); }
      }).catch(function () { toast('Something went wrong. Please try again.'); })
        .then(function () { delete add.dataset.busy; });
    });

    document.addEventListener('change', function (e) {
      var input = e.target.closest('.items-qty-input[data-cart-key]');
      if (!input) return;
      var qty = Math.max(1, parseInt(input.value, 10) || 1);
      cartCall('cart/update', { key: input.getAttribute('data-cart-key'), qty: qty }).then(refreshCartPage);
    });
  }

  function initAccountMenu() {
    document.addEventListener('click', function (e) {
      var toggle = e.target.closest('[data-bloom-account-toggle]');
      document.querySelectorAll('.bloom-account-li.open').forEach(function (li) {
        if (!toggle || li !== toggle.closest('.bloom-account-li')) li.classList.remove('open');
      });
      if (toggle) {
        e.preventDefault();
        var li = toggle.closest('.bloom-account-li');
        toggle.setAttribute('aria-expanded', li.classList.toggle('open') ? 'true' : 'false');
      }
    });
  }

  function boot() { initWishlist(); initAuth(); initAccountMenu(); initShop(); initCart(); }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot); else boot();
})();
