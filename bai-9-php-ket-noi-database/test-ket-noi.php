<?php
/*
 * BƯỚC 1: KIỂM TRA KẾT NỐI DATABASE
 * Chạy trên terminal: php test-ket-noi.php
 *
 * PHP có 2 cách kết nối MySQL phổ biến: mysqli và PDO. File này demo cả 2.
 */

require_once "config.php";
require_once "db.php";

// Nếu mở bằng trình duyệt thì hiển thị dạng text cho dễ đọc
if (PHP_SAPI !== "cli") {
    header("Content-Type: text/plain; charset=utf-8");
}

// ================= CÁCH 1: mysqli =================
echo "===== CÁCH 1: mysqli =====\n";
try {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    mysqli_set_charset($conn, "utf8mb4");
    echo "Kết nối thành công! Phiên bản MySQL: " . mysqli_get_server_info($conn) . "\n";

    $result = mysqli_query($conn, "SELECT COUNT(*) AS tong FROM sinh_vien");
    $row = mysqli_fetch_assoc($result);
    echo "Bảng sinh_vien có " . $row["tong"] . " dòng\n";

    mysqli_close($conn);   // đóng kết nối
} catch (mysqli_sql_exception $e) {
    echo "Lỗi: " . $e->getMessage() . "\n";
}

// ================= CÁCH 2: PDO (dùng trong index.php) =================
echo "\n===== CÁCH 2: PDO =====\n";
$pdo = ketNoiDatabase();   // hàm viết trong db.php
echo "Kết nối thành công!\n\n";

$dsSinhVien = $pdo->query("SELECT id, ho_ten, lop, diem FROM sinh_vien ORDER BY id")->fetchAll();

foreach ($dsSinhVien as $sv) {
    echo $sv["id"] . ". " . $sv["ho_ten"] . " - Lớp " . $sv["lop"] . " - Điểm: " . $sv["diem"] . "\n";
}
