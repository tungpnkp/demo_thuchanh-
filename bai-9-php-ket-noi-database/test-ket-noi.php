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
// ================= CÁCH 2: PDO (dùng trong index.php) =================
echo "\n===== CÁCH 2: PDO =====\n";
$pdo = ketNoiDatabase();   // hàm viết trong db.php
echo "Kết nối thành công!\n\n";

$dsSinhVien = $pdo->query("SELECT id, ho_ten, lop, diem FROM sinh_vien ORDER BY id")->fetchAll();

foreach ($dsSinhVien as $sv) {
    echo $sv["id"] . ". " . $sv["ho_ten"] . " - Lớp " . $sv["lop"] . " - Điểm: " . $sv["diem"] . "\n";
}
