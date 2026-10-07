-- =====================================================
-- BÀI 9: Tạo database và bảng mẫu
-- Chạy file này 1 lần trước khi chạy code PHP
-- (chạy lại nhiều lần cũng được: dữ liệu sẽ được làm mới)
-- =====================================================

SET NAMES utf8mb4;  -- để lưu đúng tiếng Việt khi chạy từ terminal

CREATE DATABASE IF NOT EXISTS bai9_quan_ly_sinh_vien
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE bai9_quan_ly_sinh_vien;

DROP TABLE IF EXISTS sinh_vien;

CREATE TABLE sinh_vien (
    id       INT AUTO_INCREMENT PRIMARY KEY,   -- mã tự tăng
    ho_ten   VARCHAR(100) NOT NULL,
    lop      VARCHAR(20)  NOT NULL,
    diem     DECIMAL(4,2) NOT NULL,            -- ví dụ: 8.50
    ngay_tao DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO sinh_vien (ho_ten, lop, diem) VALUES
    ('Nguyễn Văn An',   'PHP01', 8.5),
    ('Trần Thị Bình',   'PHP01', 6.0),
    ('Lê Văn Cường',    'PHP02', 4.5),
    ('Phạm Thị Dung',   'PHP02', 9.0),
    ('Hoàng Văn Em',    'PHP01', 7.25);
