<?php
/*
 * BÀI LÀM MẪU - PHP 03: In hóa đơn mua hàng
 * Kiến thức: biến, hằng, toán tử, hàm xử lý chuỗi, định dạng số
 */

// ===== 1. Khai báo biến =====
$tenKhach   = "tran thi binh";   // string
$tenSanPham = "Bàn phím cơ";     // string
$donGia     = 850000;            // int
$soLuong    = 3;                 // int
$laThanhVien = true;             // bool

// ===== 2. Khai báo hằng (giá trị không đổi, không có dấu $) =====
define("VAT", 0.1);              // cách 1: dùng define()
const GIAM_GIA_THANH_VIEN = 0.05; // cách 2: dùng const

// ===== 3. Tính toán =====
$thanhTien = $donGia * $soLuong;

// Toán tử 3 ngôi: điều_kiện ? giá_trị_đúng : giá_trị_sai
$tienGiamGia = $laThanhVien ? $thanhTien * GIAM_GIA_THANH_VIEN : 0;

$tienVAT  = ($thanhTien - $tienGiamGia) * VAT;
$tongTien = $thanhTien - $tienGiamGia + $tienVAT;

// ===== 4. Xử lý chuỗi =====
$tenVietHoaDau = ucwords($tenKhach);    // "Tran Thi Binh"
$tenInHoa      = strtoupper($tenKhach); // "TRAN THI BINH"
$doDaiTen      = strlen($tenKhach);     // 13 (chú ý: chữ có dấu tiếng Việt dùng mb_strlen)

// ===== 5. Hàm tự viết để định dạng tiền: 2550000 -> "2.550.000 đ" =====
function dinhDangTien($soTien)
{
    // number_format(số, số chữ số thập phân, dấu thập phân, dấu phân cách hàng nghìn)
    return number_format($soTien, 0, ",", ".") . " đ";
}

// ===== 7. Chia lấy nguyên và chia lấy dư =====
$soSanPhamMoiHop = 2;
$soHopDay  = intdiv($soLuong, $soSanPhamMoiHop); // 3 / 2 = 1 (lấy phần nguyên)
$soDu      = $soLuong % $soSanPhamMoiHop;        // 3 % 2 = 1 (lấy phần dư)
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PHP 03 - Hóa đơn mua hàng</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; padding: 0 16px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px; border-bottom: 1px dashed #ccc; }
        td:last-child { text-align: right; }
        .tong td { font-weight: bold; font-size: 18px; color: #c0392b; border-bottom: none; }
        .ghi-chu { color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <h1>HÓA ĐƠN MUA HÀNG</h1>

    <p>Khách hàng: <b><?= $tenVietHoaDau ?></b>
        (<?= $tenInHoa ?> - <?= $doDaiTen ?> ký tự)</p>
    <p>Thành viên: <?= $laThanhVien ? "Có" : "Không" ?></p>

    <table>
        <tr><td>Sản phẩm</td><td><?= $tenSanPham ?></td></tr>
        <tr><td>Đơn giá</td><td><?= dinhDangTien($donGia) . " x " . $soLuong ?></td></tr>
        <tr><td>Thành tiền</td><td><?= dinhDangTien($thanhTien) ?></td></tr>
        <tr><td>Giảm giá thành viên (<?= GIAM_GIA_THANH_VIEN * 100 ?>%)</td><td>- <?= dinhDangTien($tienGiamGia) ?></td></tr>
        <tr><td>VAT (<?= VAT * 100 ?>%)</td><td>+ <?= dinhDangTien($tienVAT) ?></td></tr>
        <tr class="tong"><td>TỔNG THANH TOÁN</td><td><?= dinhDangTien($tongTien) ?></td></tr>
    </table>

    <p>Đóng gói: <?= $soHopDay ?> hộp đầy, dư <?= $soDu ?> sản phẩm.</p>

    <!-- 6. Kiểu dữ liệu của biến -->
    <h3>Kiểu dữ liệu</h3>
    <ul class="ghi-chu">
        <li>$donGia: <?= gettype($donGia) ?></li>
        <li>$tenSanPham: <?= gettype($tenSanPham) ?></li>
        <li>$laThanhVien: <?= gettype($laThanhVien) ?></li>
        <li>$tongTien: <?= gettype($tongTien) ?> (phép nhân với số thực cho ra số thực)</li>
    </ul>
</body>
</html>
