<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Coming Soon | Bloom Kidswear</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bloom Kidswear is launching soon. Kids fashion, made with care.">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/admin/font/iconsmind-s/css/iconsminds.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/admin/font/simple-line-icons/css/simple-line-icons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/vendor/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/vendor/bootstrap.rtl.only.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/main.css') ?>" />
</head>

<body class="background show-spinner no-footer">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-sm-8 col-md-10 mx-auto my-auto">
                    <div class="card index-card">
                        <div class="card-body text-center form-side">
                            <a href="<?= site_url('/') ?>">
                                <span class="logo-single"></span>
                            </a>
                            <h1 class="mb-3">Coming Soon</h1>
                            <p class="lead mb-5">Bloom Kidswear will be available soon.</p>
                            <div id="timer" class="mb-5"></div>
                            <p class="text-muted mb-0">Kidswear made with care. The shop is getting ready.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>window.ADMIN_ASSETS = <?= json_encode(base_url('assets/admin')) ?>;</script>
    <script src="<?= base_url('assets/admin/js/vendor/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/vendor/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/dore.script.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/scripts.js') ?>"></script>
    <script>
        $(function () {
            var end = new Date(<?= json_encode($launchAt) ?>).getTime();
            var $timer = $("#timer");

            function pad(value) {
                return String(value).padStart(2, "0");
            }

            function tick() {
                var diff = Math.max(0, end - Date.now());
                var days = Math.floor(diff / 86400000);
                var hours = Math.floor((diff % 86400000) / 3600000);
                var minutes = Math.floor((diff % 3600000) / 60000);
                var seconds = Math.floor((diff % 60000) / 1000);

                $timer.html(
                    ' <span class="timer-column"><p class="lead text-center">' + pad(days) + '</p><p>Days</p></span>' +
                    '<span class="timer-column"><p class="lead text-center">' + pad(hours) + '</p><p>Hours</p></span>' +
                    '<span class="timer-column"><p class="lead text-center">' + pad(minutes) + '</p><p>Minutes</p></span>' +
                    '<span class="timer-column"><p class="lead text-center">' + pad(seconds) + '</p><p>Seconds</p></span>'
                );
            }

            tick();
            setInterval(tick, 1000);
        });
    </script>
</body>

</html>
