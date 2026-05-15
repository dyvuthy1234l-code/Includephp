<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ម្ហូបឆ្ងាញ់ | Food Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --brand: #0f766e;
            --brand-dark: #115e59;
            --accent: #f97316;
            --ink: #14213d;
            --muted: #64748b;
            --surface: #ffffff;
            --page: #f7faf9;
            --line: #d9e5e2;
        }

        body {
            background: var(--page);
            color: var(--ink);
            font-family: "Khmer OS Battambang", "Noto Sans Khmer", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .site-nav {
            background: rgba(255, 255, 255, 0.94);
            border-bottom: 1px solid var(--line);
            backdrop-filter: blur(14px);
        }

        .navbar-brand {
            color: var(--brand-dark);
            font-weight: 800;
            letter-spacing: 0;
        }

        .navbar-brand:hover,
        .nav-link:hover,
        .nav-link.active {
            color: var(--brand);
        }

        .nav-link {
            color: #334155;
            font-weight: 600;
        }

        .btn-brand {
            --bs-btn-bg: var(--brand);
            --bs-btn-border-color: var(--brand);
            --bs-btn-hover-bg: var(--brand-dark);
            --bs-btn-hover-border-color: var(--brand-dark);
            --bs-btn-color: #fff;
        }

        .btn-outline-brand {
            --bs-btn-color: var(--brand);
            --bs-btn-border-color: var(--brand);
            --bs-btn-hover-bg: var(--brand);
            --bs-btn-hover-border-color: var(--brand);
            --bs-btn-hover-color: #fff;
        }

        .hero-slide {
            height: clamp(310px, 46vw, 520px);
            object-fit: cover;
            filter: saturate(1.04);
        }

        .hero-caption {
            left: 7%;
            right: auto;
            bottom: 14%;
            max-width: 560px;
            text-align: left;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.45);
        }

        .hero-caption h1,
        .hero-caption h2 {
            font-size: clamp(2rem, 5vw, 4rem);
            font-weight: 900;
        }

        .hero-overlay::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(7, 30, 35, 0.78), rgba(7, 30, 35, 0.22), rgba(7, 30, 35, 0.04));
            pointer-events: none;
        }

        .section-title {
            font-weight: 850;
            color: var(--ink);
        }

        .soft-panel {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
        }

        .product-card {
            border: 1px solid var(--line);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .product-card:hover {
            border-color: rgba(15, 118, 110, 0.34);
            box-shadow: 0 22px 45px rgba(15, 23, 42, 0.1);
            transform: translateY(-4px);
        }

        .product-card img {
            aspect-ratio: 4 / 3;
            height: auto;
            object-fit: cover;
            background: #e8f1ef;
        }

        .price {
            color: var(--accent);
            font-weight: 850;
        }

        .category-pill {
            background: #e7f5f2;
            color: var(--brand-dark);
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
            padding: 0.35rem 0.65rem;
        }

        .form-control,
        .form-select {
            border-color: var(--line);
            border-radius: 8px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 0.2rem rgba(15, 118, 110, 0.14);
        }

        .footer {
            background: #102a2d;
            color: #d9f1ee;
        }

        @media (max-width: 767.98px) {
            .hero-caption {
                left: 1.5rem;
                right: 1.5rem;
                bottom: 12%;
            }
        }
    </style>
</head>
<body>
<?php $currentPage = $_GET['page'] ?? 'homepage'; ?>
<nav class="navbar navbar-expand-lg sticky-top site-nav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php?page=homepage">
            <i class="fa-solid fa-bowl-food"></i>
            <span>ម្ហូបឆ្ងាញ់</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link <?php echo $currentPage === 'homepage' ? 'active' : ''; ?>" href="index.php?page=homepage">ទំព័រដើម</a></li>
                <li class="nav-item"><a class="nav-link <?php echo $currentPage === 'about' ? 'active' : ''; ?>" href="index.php?page=about">អំពីយើង</a></li>
                <li class="nav-item"><a class="nav-link <?php echo $currentPage === 'contact' ? 'active' : ''; ?>" href="index.php?page=contact">ទំនាក់ទំនង</a></li>
            </ul>
        </div>
    </div>
</nav>
<main>
