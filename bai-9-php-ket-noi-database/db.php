<?php
/*
 * HÀM KẾT NỐI DATABASE (dùng PDO)
 * File nào cần dùng database thì: require_once "config.php"; require_once "db.php";
 */



// define("DB_HOST", "127.0.0.1");   // máy local. Dùng 127.0.0.1 (không dùng "localhost") để PHP kết nối qua cổng 3306
// define("DB_PORT", 3306);          // cổng mặc định của MySQL
// define("DB_NAME", "bai9_quan_ly_sinh_vien");
// define("DB_USER", "root");

function ketNoiDatabase()
{
    // DSN: chuỗi mô tả "kết nối tới đâu"
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // có lỗi SQL thì báo lỗi ngay
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // kết quả trả về dạng mảng ["cot" => giá trị]
        ]);

        $dsSinhVien = $pdo->query("SELECT id, ho_ten, lop, diem FROM sinh_vien ORDER BY id")->fetchAll();
        return $pdo;
    } catch (PDOException $e) {
        // Không kết nối được: dừng chương trình và báo lỗi dễ hiểu
        die("Không kết nối được database: " . $e->getMessage()
            . "\nHãy kiểm tra: MySQL đã bật chưa? Đã chạy file database.sql chưa? Mật khẩu trong config.php đúng chưa?\n");
    }
}
