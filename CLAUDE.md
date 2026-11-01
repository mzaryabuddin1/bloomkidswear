# Bloom Kidswear — project map (reference so the whole codebase need not be re-read)

CodeIgniter 4.7 (PHP 8.3, MySQL) kids-clothing storefront + admin. Local: Laragon `https://bloomkidswear.test` (self-signed cert → test with `curl -sk`). Production: cPanel/Apache, `vendor/` is committed, repo `github.com/mzaryabuddin1/bloomkidswear`.

## Working rules
- Build every new page from the purchased **Unimart** themes: storefront = `webapp_theme/` (rbt-* classes, Bootstrap 5.0.2 without Popper), admin = `admin_theme_unimart/` (Tailwind-style classes, compiled CSS → arbitrary classes like `w-[340px]` may be missing, use inline styles for sizes). Docs: https://html.getunimart.com/docs
- Commit yourself after finishing work (don't ask). Reply to the user in roman Urdu.
- Windows quirks: bash heredocs can truncate/break → use the Write/Edit tools or a PHP script; avoid `php -r` regex edits on views. Scratch files go in the session scratchpad.
- Currency PKR (`Cart::money()`), no shoes/accessories, one colour per product.
- Local `.env` has `orderEmails.enabled = false` (no real mail while testing). Prod `.env` omits it → emails on.
- After tests: delete test orders/history/notifications and run `php spark db:seed ShopSeeder` to reset stock.
- Admin test login: `admin@bloomkidswear.test` / `Admin123!` (AdminSeeder). CSRF cookie mode: POST needs `csrf_test_name` field or `X-CSRF-TOKEN` header (value from `<meta name="csrf-token">`).

## Routes (app/Config/Routes.php)
- Public: `/` Home, `home`, `shop`, `shop/category/{slug}`, `product/{slug}`, `cart` (+ `cart/data|add|update|remove` JSON), `checkout` (GET form, POST place), `checkout/thank-you/{no}`, `track-order`, `wishlist`.
- Customer auth JSON: `account/login|signup/start|signup/verify|otp/resend|forgot|reset`, `account/google(+callback)`, `account/logout`; pages (customerAuth) `account`, `account/orders`, `account/update/*`, `account/delete`; wishlist JSON `wishlist/items|toggle|remove|sync`.
- Admin (`/admin/*`, filter adminAuth + `permission:x.view|manage`): dashboard, notifications (+`feed`, `read-all`, `{id}/open`), roles, users, customers, products(+toggle/delete), categories, orders (+create/edit/`{id}/status`). Login: `admin/login`.

## Controllers (app/Controllers)
Home, Shop (filters/AJAX, `AGE_LABELS`, price ranges PKR, sorts, flags), Product (`show`), Cart (JSON), Checkout (place → OrderHistory 'created' → OrderMailer::sendInvoice + AdminNotify::newOrder), Account, Wishlist, TrackOrder. Admin/: Auth, Dashboard, Notifications, Roles, Users, Customers, Products, Categories, Orders (index/show/create/edit/persist/status/restock; STATUSES placed|processing|shipped|delivered|cancelled; methods cod|card|bank; payment_status pending|paid|failed|refund due|refunded).
Filters: AdminAuth, AdminGuest, CustomerAuth, CustomerGuest, PermissionFilter.

## Libraries (app/Libraries)
- `Cart` session cart (stores id/size/qty only; prices+stock re-read from DB; FREE_SHIPPING_OVER 10000, FLAT_SHIPPING 250, MAX_QTY 10; `summary()` items have key `id:size`, url → `product/{slug}`).
- `PaymentGateway` sandbox card (Luhn/expiry/CVC; card ending 0002 declined; 4242… paid).
- `OrderHistory` audit: snapshot/record/diff of orders (before/after JSON). Cancelled orders restock and can't be reopened.
- `OrderMailer` renders `emails/order_invoice|order_status` and **queues** them (invoice BCC `mahnoor@bloomkidswear.com`); `MailQueue` (table `email_queue`; `enqueue`, `flush`; best-effort flush in shutdown + cron `php spark mail:flush`, 5 attempts). `OtpService` sends OTP mail directly.
- `AdminNotify` (table `admin_notifications`: `newOrder`, `push`, `unread`, `latest`, `ago`). `PlaceholderImage` draws placeholder product PNGs (no colour dot). Command: `app/Commands/MailFlush.php`.

## Data (migrations in app/Database/Migrations)
Tables: admins, roles, permissions (+pivot), customers, otps, wishlist, categories (parent_id, slug, image, sort_order), products (slug, image, hover_image, sku, price, sale_price, stock, badge, rating_avg/count, sold_count, age_group, colors, sizes comma list, material, is_featured, is_active), orders (order_number BK…, customer_id?, email, status, totals, name/phone/address/city/province/postal_code, payment_method/status, card_brand/last4, tracking_number, carrier), order_items, order_history, admin_notifications, email_queue. Seeders: AdminSeeder, RolePermissionSeeder, ShopSeeder (26 products, 4 top categories Boys/Girls/Baby/Seasonal; resets stock).

## Views
- Storefront (`app/Views/storefront`): home, shop (regions `#bloom-shop-top`, `#bloom-filters`, `#bloom-results`; product cards with `.bloom-pill` size buttons, multi-select), product, cart (`#bloom-cart-region`), checkout, thank_you, track_order, wishlist, account/{info,orders,_sidebar}; partials head (global CSS incl. pill styles), header (mini-cart `#bloom-mini-*`), footer, scripts (loads `bloom.js?v=N` — **bump N after editing**), auth_modal, shop_menu, breadcrumb, modals.
- Admin (`app/Views/admin`): `layout.php` (sidebar + bell dropdown `#bloom-bell`, `$this->extend('admin/layout')`, section `content`, `activeNav`, flash keys success/error, `admin_can('perm')`), dashboard, orders (index/form/show), products, categories, customers, users, roles, notifications/index.
- Emails: otp, order_invoice, order_status (navy #233b61 header with logo `assets/frontend/images/logo/bloom-logo.png`).

## Frontend JS (public/assets/frontend/js/bloom.js)
Helpers `post()/getJson()/toast()` + CSRF; `initWishlist`, `initAuth` (modal email/Google + OTP), `initAccountMenu`, `initShop` (AJAX filters), `initCart` (mini-cart render, `[data-add-to-cart]` adds one line per selected size pill, capture-phase `.qty-item-btn` handler for cart + `[data-product-qty]`, `[data-cart-remove]`). Theme qty +/- is jQuery and would bypass native listeners, hence capture phase.

## Known open issue
Production POST `/account/signup/start` returned 404 JSON — not resolved (check deployed Routes.php, docroot → `public/`, OPcache).
