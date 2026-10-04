<?php
/*
 * BÀI 7.1 - Tính tổng tiền đơn hàng
 * Kiến thức: khai báo biến, phép tính, echo
 * Chạy: php index.php
 */

// 1. Khai báo các biến
$productName = "Bánh mì";
$price       = 15000;
$quantity    = 3;
$vatRate     = 0.1;   // VAT 10%

// 2. Tính thành tiền
$amount = $price * $quantity;

// 3. Tính VAT 10%
$vat = $amount * $vatRate;

// 4. Tính tổng tiền phải trả
$total = $amount + $vat;

// 5. In kết quả ra terminal ("\n" là ký tự xuống dòng)
echo "===== HÓA ĐƠN =====\n";
echo "Sản phẩm: " . $productName . "\n";
echo "Đơn giá: " . number_format($price) . " VNĐ\n";   // number_format(15000) -> "15,000"
echo "Số lượng: " . $quantity . "\n";
echo "Thành tiền: " . number_format($amount) . " VNĐ\n";
echo "VAT (10%): " . number_format($vat) . " VNĐ\n";
echo "Tổng tiền phải trả: " . number_format($total) . " VNĐ\n";
