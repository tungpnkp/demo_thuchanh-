<?php
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

$tong = 0;
$giam = 0;

echo "===== DANH SÁCH SẢN PHẨM =====\n\n";

foreach ($products as $p) {
    $tien = $p["price"] * $p["quantity"];
    $tong += $tien;
    echo $p["name"] . " - " . $p["price"] . " VNĐ x " . $p["quantity"] . " = " . $tien . " VNĐ\n";
}

if ($tong >= 100000) {
    $giam = $tong * 0.1;
}

echo "\nTạm tính: " . $tong . " VNĐ\n";
echo "Giảm giá: " . $giam . " VNĐ\n";
echo "Thanh toán: " . ($tong - $giam) . " VNĐ\n";
?>