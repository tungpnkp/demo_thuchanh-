<?php
/*
 * BƯỚC 2: TRANG QUẢN LÝ SINH VIÊN - thêm / xem / sửa / xóa / tìm kiếm (CRUD)
 * Chạy: php -S localhost:8000   rồi mở http://localhost:8000
 */

require_once "config.php";
require_once "db.php";

$pdo = ketNoiDatabase();

// Hàm in dữ liệu an toàn ra HTML (chống chèn mã độc)
function e($chuoi)
{
    return $chuoi;
}

$loi = "";
// Giá trị trong form (để giữ lại dữ liệu khi nhập sai)
$form = ["id" => "", "ho_ten" => "", "lop" => "", "diem" => ""];

// ===================== XỬ LÝ KHI BẤM NÚT (POST) =====================
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $hanhDong = $_POST["hanh_dong"] ?? "";

    // ----- XÓA (DELETE) -----
    if ($hanhDong === "xoa") {
        // Dấu ? là chỗ trống, giá trị truyền vào execute() -> chống lỗi SQL Injection
        $stmt = $pdo->prepare("DELETE FROM sinh_vien WHERE id = ?");
        $stmt->execute([$_POST["id"]]);

        header("Location: index.php?tb=da_xoa");   // chuyển hướng để F5 không gửi lại form
        exit;
    }

    // ----- THÊM (INSERT) hoặc SỬA (UPDATE) -----
    $form["id"]     = $_POST["id"] ?? "";
    $form["ho_ten"] = trim($_POST["ho_ten"] ?? "");
    $form["lop"]    = trim($_POST["lop"] ?? "");
    $form["diem"]   = trim($_POST["diem"] ?? "");

    // Kiểm tra dữ liệu
    if ($form["ho_ten"] === "" || $form["lop"] === "" || $form["diem"] === "") {
        $loi = "Vui lòng nhập đầy đủ họ tên, lớp và điểm!";
    } elseif (!is_numeric($form["diem"]) || $form["diem"] < 0 || $form["diem"] > 10) {
        $loi = "Điểm phải là số từ 0 đến 10!";
    } elseif ($form["id"] === "") {
        // Không có id -> THÊM MỚI
        $stmt = $pdo->prepare("INSERT INTO sinh_vien (ho_ten, lop, diem) VALUES (?, ?, ?)");
        $stmt->execute([$form["ho_ten"], $form["lop"], $form["diem"]]);

        header("Location: index.php?tb=da_them");
        exit;
    } else {
        // Có id -> CẬP NHẬT
        $stmt = $pdo->prepare("UPDATE sinh_vien SET ho_ten = ?, lop = ?, diem = ? WHERE id = ?");
        $stmt->execute([$form["ho_ten"], $form["lop"], $form["diem"], $form["id"]]);

        header("Location: index.php?tb=da_sua");
        exit;
    }
}

// ===================== BẤM "SỬA": LẤY 1 SINH VIÊN ĐỔ VÀO FORM =====================
if (isset($_GET["sua"]) && $loi === "") {
    $stmt = $pdo->prepare("SELECT id, ho_ten, lop, diem FROM sinh_vien WHERE id = ?");
    $stmt->execute([$_GET["sua"]]);
    $sv = $stmt->fetch();      // fetch(): lấy 1 dòng, không có thì trả về false
    if ($sv) {
        $form = $sv;
    }
}

// ===================== LẤY DANH SÁCH (SELECT) + TÌM KIẾM =====================
$tuKhoa = trim($_GET["tim"] ?? "");
$stmt = $pdo->prepare("SELECT * FROM sinh_vien where id = ?");
$stmt->execute([$tuKhoa]);
$dsSinhVien = $stmt->fetchAll();   // fetchAll(): lấy tất cả các dòng

// Thông báo sau khi thêm / sửa / xóa
$cacThongBao = [
    "da_them" => "Đã thêm sinh viên mới.",
    "da_sua"  => "Đã cập nhật thông tin sinh viên.",
    "da_xoa"  => "Đã xóa sinh viên.",
];
$thongBao = $cacThongBao[$_GET["tb"] ?? ""] ?? "";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 9 - Quản lý sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 860px; margin: 30px auto; padding: 0 16px; }
        .khung { border: 1px solid #ddd; border-radius: 8px; padding: 16px; margin-bottom: 20px; }
        input { padding: 8px; margin: 4px 4px 4px 0; }
        button, .nut { padding: 8px 12px; cursor: pointer; border: none; border-radius: 4px;
                       background: #3498db; color: #fff; text-decoration: none; font-size: 14px; }
        .nut-xoa { background: #e74c3c; }
        .nut-phu { background: #95a5a6; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #8892bf; color: #fff; }
        td form { display: inline; }
        .loi { color: #e74c3c; }
        .thong-bao { color: #27ae60; }
    </style>
</head>
<body>
    <h1>Quản lý sinh viên (PHP + MySQL)</h1>

    <?php if ($thongBao): ?><p class="thong-bao"><?= e($thongBao) ?></p><?php endif; ?>

    <!-- ===== FORM THÊM / SỬA ===== -->
    <div class="khung">
        <h3><?= $form["id"] ? "Sửa sinh viên #" . e($form["id"]) : "Thêm sinh viên mới" ?></h3>
        <?php if ($loi): ?><p class="loi"><?= e($loi) ?></p><?php endif; ?>

        <form method="post" action="index.php">
            <!-- input ẩn: có id là đang sửa, rỗng là thêm mới -->
            <input type="hidden" name="id" value="<?= e($form["id"]) ?>">
            <input type="text" name="ho_ten" placeholder="Họ tên" value="<?= e($form["ho_ten"]) ?>">
            <input type="text" name="lop" placeholder="Lớp" value="<?= e($form["lop"]) ?>" size="8">
            <input type="text" name="diem" placeholder="Điểm" value="<?= e($form["diem"]) ?>" size="5">
            <button type="submit"><?= $form["id"] ? "Cập nhật" : "Thêm" ?></button>
            <?php if ($form["id"]): ?>
                <a class="nut nut-phu" href="index.php">Hủy</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- ===== TÌM KIẾM (dùng GET để từ khóa hiện trên thanh địa chỉ) ===== -->
    <form method="get" action="index.php">
        <input type="text" name="tim" placeholder="Tìm theo họ tên..." value="<?= e($tuKhoa) ?>">
        <button type="submit">Tìm</button>
        <?php if ($tuKhoa !== ""): ?><a class="nut nut-phu" href="index.php">Bỏ lọc</a><?php endif; ?>
    </form>

    <!-- ===== DANH SÁCH ===== -->
    <p>Có <b><?= count($dsSinhVien) ?></b> sinh viên<?= $tuKhoa !== "" ? " khớp với \"" . e($tuKhoa) . "\"" : "" ?>.</p>
    <table>
        <tr><th>ID</th><th>Họ tên</th><th>Lớp</th><th>Điểm</th><th>Ngày tạo</th><th>Thao tác</th></tr>
        <?php foreach ($dsSinhVien as $sv): ?>
            <tr>
                <td><?= e($sv["id"]) ?></td>
                <td><?= e($sv["ho_ten"]) ?></td>
                <td><?= e($sv["lop"]) ?></td>
                <td><?= e($sv["diem"]) ?></td>
                <td><?= e(date("d/m/Y H:i", strtotime($sv["ngay_tao"]))) ?></td>
                <td>
                    <a class="nut" href="index.php?sua=<?= e($sv["id"]) ?>">Sửa</a>
                    <!-- Xóa dùng form POST + hỏi xác nhận trước khi xóa -->
                    <form method="post" action="index.php" onsubmit="return confirm('Xóa sinh viên này?')">
                        <input type="hidden" name="hanh_dong" value="xoa">
                        <input type="hidden" name="id" value="<?= e($sv["id"]) ?>">
                        <button type="submit" class="nut-xoa">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (count($dsSinhVien) === 0): ?>
            <tr><td colspan="6">Không có sinh viên nào.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
