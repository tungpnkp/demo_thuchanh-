# Bài 9 - Kết nối database MySQL từ PHP

## Mục tiêu
- Kết nối PHP với MySQL chạy trên máy (local, cổng 3306, user `root`).
- Biết 2 cách kết nối: **mysqli** và **PDO**.
- Làm trang quản lý sinh viên với đủ 4 thao tác cơ bản (**CRUD**):
  thêm (`INSERT`), xem (`SELECT`), sửa (`UPDATE`), xóa (`DELETE`), cùng chức năng tìm kiếm (`LIKE`).

## Cấu trúc thư mục
| File | Nội dung |
|---|---|
| `database.sql` | Tạo database `bai9_quan_ly_sinh_vien`, bảng `sinh_vien` và 5 dòng dữ liệu mẫu |
| `config.php` | Thông tin kết nối: host, port, tên database, user, **mật khẩu (bạn tự điền)** |
| `db.php` | Hàm `ketNoiDatabase()` tạo kết nối PDO, dùng lại ở mọi file |
| `test-ket-noi.php` | Kiểm tra kết nối bằng mysqli và PDO, in danh sách ra terminal |
| `index.php` | Trang web quản lý sinh viên: thêm / xem / sửa / xóa / tìm kiếm |

## Cách chạy

### Bước 1. Bật MySQL
- **XAMPP**: mở XAMPP Control Panel → **Start** dòng MySQL.
- **Cài riêng MySQL** (Windows): MySQL chạy sẵn dưới dạng Windows Service.
- **macOS (Homebrew)**: `brew services start mysql`

### Bước 2. Tạo database
Chọn 1 trong 2 cách:
- **phpMyAdmin**: mở http://localhost/phpmyadmin → tab **Import** → chọn file `database.sql` → **Import**.
  (Hoặc tab **SQL**, dán nội dung file `database.sql` vào rồi bấm **Go**.)
- **Terminal** (đứng trong thư mục bài):
  ```bash
  mysql -u root -p < database.sql
  ```
  Nhập mật khẩu MySQL khi được hỏi. Nếu root không có mật khẩu (XAMPP) thì bỏ `-p`.

### Bước 3. Điền mật khẩu vào `config.php`
```php
define("DB_PASS", "");   // <-- điền mật khẩu MySQL của bạn vào giữa 2 dấu ""
```
Các thông tin còn lại đã được để sẵn: host `127.0.0.1`, port `3306`, user `root`.

> **Vì sao dùng `127.0.0.1` mà không dùng `localhost`?**
> Trên macOS/Linux, nếu ghi `localhost` thì PHP sẽ bỏ qua cổng 3306 và kết nối qua *socket file*,
> dễ gây lỗi `No such file or directory`. Ghi `127.0.0.1` thì PHP luôn kết nối qua cổng 3306.

### Bước 4. Kiểm tra kết nối (terminal)
```bash
php test-ket-noi.php
```
Kết quả đúng:
```
===== CÁCH 1: mysqli =====
Kết nối thành công! Phiên bản MySQL: 8.x.x
Bảng sinh_vien có 5 dòng

===== CÁCH 2: PDO =====
Kết nối thành công!

1. Nguyễn Văn An - Lớp PHP01 - Điểm: 8.50
2. Trần Thị Bình - Lớp PHP01 - Điểm: 6.00
3. Lê Văn Cường - Lớp PHP02 - Điểm: 4.50
4. Phạm Thị Dung - Lớp PHP02 - Điểm: 9.00
5. Hoàng Văn Em - Lớp PHP01 - Điểm: 7.25
```

### Bước 5. Chạy trang quản lý sinh viên
```bash
php -S localhost:8000
```
Mở trình duyệt vào http://localhost:8000. Thử lần lượt các thao tác: thêm, sửa, xóa, tìm kiếm.
Sau mỗi thao tác, mở phpMyAdmin để thấy dữ liệu trong database đã thay đổi theo.

(Dùng XAMPP: copy thư mục bài vào `C:\xampp\htdocs\` rồi mở http://localhost/bai-9-php-ket-noi-database)

## Kiến thức chính
| Nội dung | Code |
|---|---|
| Kết nối bằng mysqli | `mysqli_connect($host, $user, $pass, $db, $port)` |
| Kết nối bằng PDO | `new PDO("mysql:host=...;port=...;dbname=...;charset=utf8mb4", $user, $pass)` |
| Bắt lỗi kết nối | `try { ... } catch (PDOException $e) { ... }` |
| Chạy câu SQL có dữ liệu người dùng nhập | `$stmt = $pdo->prepare("... WHERE id = ?"); $stmt->execute([$id]);` |
| Lấy 1 dòng / nhiều dòng | `$stmt->fetch()` / `$stmt->fetchAll()` |
| Chống chèn mã HTML khi in ra | `htmlspecialchars()` |
| Không gửi lại form khi bấm F5 | Xử lý xong thì `header("Location: index.php"); exit;` |

> **Quan trọng: SQL Injection.** Không bao giờ nối thẳng dữ liệu người dùng nhập vào câu SQL
> (ví dụ `"... WHERE ho_ten LIKE '%$tuKhoa%'"`). Hãy dùng `prepare()` với dấu `?` như trong bài.
> Thử gõ `' OR 1=1 -- ` vào ô tìm kiếm: chương trình vẫn chạy đúng, không bị lộ dữ liệu.

## Lỗi thường gặp
| Lỗi | Cách xử lý |
|---|---|
| `Access denied for user 'root'@'localhost'` | Sai mật khẩu trong `config.php` (XAMPP: để trống `""`) |
| `Unknown database 'bai9_quan_ly_sinh_vien'` | Chưa chạy file `database.sql` (Bước 2) |
| `Connection refused` | MySQL chưa bật (Bước 1), hoặc MySQL không chạy ở cổng 3306 |
| `could not find driver` | PHP chưa bật extension `pdo_mysql` (xem hướng dẫn cài PHP trên [Windows](../HUONG-DAN-CAI-PHP-MYSQL-WINDOWS.md)) |
| `Table 'sinh_vien' doesn't exist` | Chạy lại file `database.sql` |

## Bài tập mở rộng
1. Thêm cột `email` vào bảng, form và danh sách (nhớ sửa cả `INSERT` và `UPDATE`).
2. Thêm cột "Xếp loại" (Giỏi / Khá / Trung bình / Yếu) tính từ điểm.
3. Thêm ô chọn lọc theo lớp (`WHERE lop = ?`).
4. Sắp xếp danh sách theo điểm từ cao xuống thấp (`ORDER BY diem DESC`).
5. Viết lại phần thêm sinh viên bằng **mysqli** thay vì PDO.
