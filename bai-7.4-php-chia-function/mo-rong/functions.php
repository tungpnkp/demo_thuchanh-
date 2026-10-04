<?php
/*
 * BÀI 7.4 (MỞ RỘNG) - File chỉ chứa các function, không có chương trình chính.
 * Được nạp vào index.php bằng: require_once "functions.php";
 */

// ================= CÁC FUNCTION TÍNH TOÁN (chỉ return, không echo) =================

// Định dạng tiền: 15000 -> "15,000 VNĐ"
function formatMoney($amount)
{
    return number_format($amount) . " VNĐ";
}

// Thành tiền của 1 sản phẩm
function calculateLineTotal($product)
{
    return $product["price"] * $product["quantity"];
}

// Tổng tiền của cả đơn hàng (gọi lại calculateLineTotal, không tính lại)
function calculateSubtotal($products)
{
    $subtotal = 0;
    foreach ($products as $product) {
        $subtotal += calculateLineTotal($product);
    }
    return $subtotal;
}

// Số tiền giảm: 10% nếu tổng >= 100,000, ngược lại là 0
function calculateDiscount($subtotal)
{
    if ($subtotal >= 100000) {
        return $subtotal * 0.1;
    }
    return 0;
}

// ================= CÁC FUNCTION IN KẾT QUẢ =================

// In tiêu đề và từng dòng sản phẩm
function printProductList($products)
{
    echo "===== DANH SÁCH SẢN PHẨM =====\n\n";
    foreach ($products as $product) {
        echo $product["name"] . " - "
            . formatMoney($product["price"]) . " x "
            . $product["quantity"] . " = "
            . formatMoney(calculateLineTotal($product)) . "\n";
    }
}

// In Tạm tính, Giảm giá, Thanh toán
function printSummary($products)
{
    $subtotal = calculateSubtotal($products);
    $discount = calculateDiscount($subtotal);

    echo "\n";
    echo "Tạm tính: " . formatMoney($subtotal) . "\n";
    echo "Giảm giá: " . formatMoney($discount) . "\n";
    echo "Thanh toán: " . formatMoney($subtotal - $discount) . "\n";
}
