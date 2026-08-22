<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Coming Soon | Bloom Kidswear</title>
    <meta name="description" content="Bloom Kidswear is launching soon. Quality clothing for little ones.">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/frontend/images/favicon.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&family=Caveat:wght@500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bloom-coral: #f2746e;
            --bloom-coral-dark: #e05f59;
            --bloom-mint: #74bba6;
            --bloom-navy: #223b63;
            --bloom-cream: #fffdf9;
            --bloom-ink: #223b63;
            --bloom-muted: #5f6b7a;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            overflow-x: hidden;
        }

        body {
            min-height: 100dvh;
            overflow-x: hidden;
            font-family: "Cabin", sans-serif;
            color: var(--bloom-ink);
            background:
                radial-gradient(circle at top right, rgba(242, 116, 110, 0.14), transparent 32rem),
                radial-gradient(circle at bottom left, rgba(116, 187, 166, 0.18), transparent 28rem),
                var(--bloom-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 1.25rem;
        }

        .coming-soon {
            width: min(100%, 42rem);
            text-align: center;
        }

        .logo-wrap {
            width: min(100%, 16rem);
            margin: 0 auto 1rem;
            overflow: hidden;
            line-height: 0;
        }

        .logo {
            width: 100%;
            height: auto;
            display: block;
            margin-bottom: -42%;
        }

        .badge {
            display: inline-block;
            padding: 0.45rem 0.9rem;
            border-radius: 999px;
            background: rgba(232, 131, 122, 0.12);
            color: var(--bloom-coral-dark);
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 1.25rem;
        }

        h1 {
            font-size: clamp(2.4rem, 6vw, 3.6rem);
            line-height: 1.05;
            margin-bottom: 1rem;
        }

        .accent {
            font-family: "Caveat", cursive;
            color: var(--bloom-coral);
            font-size: clamp(2.8rem, 7vw, 4rem);
            display: block;
            margin-top: 0.35rem;
        }

        p {
            color: var(--bloom-muted);
            font-size: 1.05rem;
            line-height: 1.7;
            max-width: 32rem;
            margin: 0 auto 2rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid rgba(232, 131, 122, 0.18);
            border-radius: 1.25rem;
            padding: 1.5rem;
            box-shadow: 0 18px 50px rgba(43, 43, 43, 0.08);
            backdrop-filter: blur(8px);
        }

        .card strong {
            display: block;
            margin-bottom: 0.35rem;
            font-size: 1rem;
        }

        .card span {
            color: var(--bloom-muted);
            font-size: 0.95rem;
        }

        .footer {
            margin-top: 1.5rem;
            color: var(--bloom-muted);
            font-size: 0.9rem;
        }

        @media (max-width: 480px) {
            body {
                padding: 1rem;
            }

            .logo-wrap {
                margin-bottom: 0.75rem;
            }

            .card {
                padding: 1.15rem;
            }

            .footer {
                margin-top: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <main class="coming-soon">
        <div class="logo-wrap">
            <img
                class="logo"
                src="<?= base_url('assets/frontend/images/logo/bloom-logo.png') ?>"
                alt="Bloom Kids Wear">
        </div>

        <span class="badge">Launching Soon</span>

        <h1>
            Something beautiful
            <span class="accent">is blooming</span>
        </h1>

        <p>
            We are putting the finishing touches on Bloom Kidswear — thoughtful styles,
            soft fabrics, and everyday comfort for your little ones. Our store will be open very soon.
        </p>

        <div class="card">
            <strong>Stay tuned</strong>
            <span>Our full website is on the way. Check back soon for the launch.</span>
        </div>

        <p class="footer">&copy; <?= date('Y') ?> Bloom Kidswear. All rights reserved.</p>
    </main>
</body>
</html>
