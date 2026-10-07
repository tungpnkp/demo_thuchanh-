<?php
// TH 10-2: router tự viết, chia trang theo tham số ?show=
$show = $_GET['show'] ?? 'home';

switch ($show) {
    case 'product':
        require __DIR__ . '/controller/product.php';
        break;
    case 'news':
        require __DIR__ . '/controller/news.php';
        break;
    case 'home':
        require __DIR__ . '/controller/home.php';
        break;
    default:
        http_response_code(404);
        echo "Không có trang bạn yêu cầu";
}
