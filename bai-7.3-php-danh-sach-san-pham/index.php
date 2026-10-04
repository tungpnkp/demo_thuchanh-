<?php
/*
 * BÀI 7.3 - Danh sách sản phẩm
 * Kiến thức: mảng, foreach, câu lệnh điều kiện
 * Chạy: php index.php
 */

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
        "quantity" => 3
    ]
];

echo "===== DANH SÁCH SẢN PHẨM =====\n\n";

$subtotal = 0;   // biến cộng dồn tổng tiền, phải khởi tạo = 0 trước vòng lặp

// 1. Duyệt danh sách: mỗi vòng lặp, $product là 1 sản phẩm
foreach ($products as $product) {
    // 3. Thành tiền = price x quantity
    $lineTotal = $product["price"] * $product["quantity"];

    // 4. Cộng dồn vào tổng tiền
    $subtotal += $lineTotal;

    // 2. In tên, đơn giá, số lượng, thành tiền
    echo $product["name"] . " - "
        . number_format($product["price"]) . " VNĐ x "
        . $product["quantity"] . " = "
        . number_format($lineTotal) . " VNĐ\n";
}

// 5, 6. Giảm 10% nếu tổng tiền >= 100,000
if ($subtotal >= 100000) {
    $discount = $subtotal * 0.1;
} else {
    $discount = 0;
}

$payment = $subtotal - $discount;

// 7. In kết quả
echo "\n";
echo "Tạm tính: " . number_format($subtotal) . " VNĐ\n";
echo "Giảm giá: " . number_format($discount) . " VNĐ\n";
echo "Thanh toán: " . number_format($payment) . " VNĐ\n";
