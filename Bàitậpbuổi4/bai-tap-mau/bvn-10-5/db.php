<?php
// BVN 10-5: kết nối DB (PDO) + các hàm xử lý. Sửa DB_PASS cho đúng máy bạn.
const DB_HOST = '127.0.0.1';
const DB_NAME = 'lab_buoi_4_5';
const DB_USER = 'root';
const DB_PASS = '';

function getConnection(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    return $pdo;
}

function getStudents(): array {
    return getConnection()->query('SELECT * FROM students ORDER BY id')->fetchAll();
}

function addStudent(string $name, string $email): bool {
    $stmt = getConnection()->prepare('INSERT IGNORE INTO students (name, email) VALUES (?, ?)');  // prepared statement chống SQL injection
    $stmt->execute([$name, $email]);
    return $stmt->rowCount() > 0;
}
