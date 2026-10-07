<?php
/*
 * CẤU HÌNH KẾT NỐI MYSQL
 * Sửa các giá trị dưới đây cho đúng với máy của bạn.
 */

define("DB_HOST", "127.0.0.1");   // máy local. Dùng 127.0.0.1 (không dùng "localhost") để PHP kết nối qua cổng 3306
define("DB_PORT", 3306);          // cổng mặc định của MySQL
define("DB_NAME", "bai9_quan_ly_sinh_vien");
define("DB_USER", "root");
define("DB_PASS", "");            // <-- ĐIỀN MẬT KHẨU MySQL CỦA BẠN (XAMPP mặc định để trống). File này là bản mẫu: copy thành config.php rồi sửa.
