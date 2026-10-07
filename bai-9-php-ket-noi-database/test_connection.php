<?php
require_once "config.php";
/*
 * HÀM KẾT NỐI DATABASE (dùng PDO)
 * File nào cần dùng database thì: require_once "config.php"; require_once "db.php";
 */




// DSN: chuỗi mô tả "kết nối tới đâu"
$dsn = "mysql:host=127.0.0.1;port=3306;dbname=bai9_quan_ly_sinh_vien;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // có lỗi SQL thì báo lỗi ngay
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // kết quả trả về dạng mảng ["cot" => giá trị]
    ]);

    $dsSinhVien = $pdo->query("SELECT id, ho_ten, lop, diem FROM sinh_vien ORDER BY id")->fetchAll();
    echo json_encode($dsSinhVien);
} catch (PDOException $e) {
    // Không kết nối được: dừng chương trình và báo lỗi dễ hiểu
    die("Không kết nối được database: " . $e->getMessage()
        . "\nHãy kiểm tra: MySQL đã bật chưa? Đã chạy file database.sql chưa? Mật khẩu trong config.php đúng chưa?\n");
}
