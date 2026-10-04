<?php
/*
 * BÀI 7.4 (MỞ RỘNG) - Tách function sang file functions.php
 * Chạy: php index.php   (đứng trong thư mục mo-rong)
 */

// Nạp file chứa các function (__DIR__ = thư mục chứa file này)
require_once __DIR__ . "/functions.php";

$products = [
    [
        "name" => "Bánh mì",
        "price" => 15000,
        "quantity" => 2
    ],
    [
        "name" => "Sữa",
        "price" => 30000,
        "quantity" => 1
    ],
    [
        "name" => "Trứng",
        "price" => 25000,
        "quantity" => 3   // Thử đổi thành 1: tổng còn 85,000 VNĐ -> Giảm giá: 0 VNĐ
    ]
];

printProductList($products);
printSummary($products);
