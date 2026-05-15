<?php
$page = $_GET['page'] ?? 'homepage';
$allowedPages = ['homepage', 'about', 'contact', 'detail'];

if (!in_array($page, $allowedPages, true)) {
    $page = 'homepage';
}

include __DIR__ . '/common/header.php';

if ($page === 'homepage') {
    include __DIR__ . '/common/slide.php';
}

switch ($page) {
    case 'about':
        include __DIR__ . '/views/about.php';
        break;
    case 'contact':
        include __DIR__ . '/views/contact.php';
        break;
    case 'detail':
        include __DIR__ . '/product/product_detail.php';
        break;
    default:
        include __DIR__ . '/views/homepage.php';
        break;
}

include __DIR__ . '/common/footer.php';
