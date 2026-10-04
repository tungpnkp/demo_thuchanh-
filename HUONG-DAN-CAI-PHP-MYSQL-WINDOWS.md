# Hướng dẫn cài đặt PHP và MySQL trên Windows

Có 2 cách cài:

| | Cách 1: XAMPP (khuyên dùng) | Cách 2: Cài riêng PHP + MySQL |
|---|---|---|
| Độ khó | Dễ, cài 1 lần có đủ | Nhiều bước hơn |
| Gồm | Apache + PHP + MariaDB (tương thích MySQL) + phpMyAdmin | PHP và MySQL bản chính thức |
| Phù hợp | Người mới học, buổi thực hành | Người muốn hiểu rõ từng thành phần |

> **MariaDB** là bản "anh em" của MySQL, dùng cùng câu lệnh SQL, cùng hàm `mysqli` / `PDO` trong PHP.
> Với các bài học cơ bản, dùng MariaDB trong XAMPP hay MySQL đều như nhau.

---

## CÁCH 1 - Cài bằng XAMPP (khuyên dùng)

### Bước 1. Tải XAMPP
1. Vào trang https://www.apachefriends.org
2. Bấm **XAMPP for Windows** để tải bản mới nhất (file `.exe`).

### Bước 2. Cài đặt
1. Chạy file vừa tải. Nếu Windows hỏi quyền (UAC) → bấm **Yes**.
2. Nếu có cảnh báo về **User Account Control** → bấm **OK** (vì vậy ta cài vào `C:\xampp` thay vì `C:\Program Files`).
3. Màn hình **Select Components**: giữ nguyên các mục đã chọn, quan trọng nhất là:
   - ✅ Apache
   - ✅ MySQL
   - ✅ PHP
   - ✅ phpMyAdmin
4. Thư mục cài đặt: để mặc định **`C:\xampp`**.
5. Bấm **Next** đến khi cài xong, tick **Start the Control Panel now** → **Finish**.

### Bước 3. Bật Apache và MySQL
1. Mở **XAMPP Control Panel** (tìm trong Start Menu: gõ `xampp`).
2. Bấm **Start** ở dòng **Apache** và dòng **MySQL**.
3. Nếu Windows Firewall hỏi → tick **Private networks** → bấm **Allow access**.
4. Hai dòng chuyển sang **màu xanh** là thành công.

### Bước 4. Kiểm tra
| Mở trình duyệt vào | Kết quả đúng |
|---|---|
| http://localhost | Trang chào mừng của XAMPP |
| http://localhost/phpmyadmin | Giao diện quản lý cơ sở dữ liệu phpMyAdmin |

Tài khoản MySQL mặc định của XAMPP: **user `root`, mật khẩu để trống**.

### Bước 5. Chạy code PHP qua trình duyệt
1. Copy thư mục bài vào **`C:\xampp\htdocs\`**, ví dụ: `C:\xampp\htdocs\bai-php-03-bien-va-toan-tu`
2. Mở trình duyệt vào: http://localhost/bai-php-03-bien-va-toan-tu

### Bước 6. Dùng lệnh `php` và `mysql` trong Terminal (cho các bài 7.x)
Mặc định Windows chưa biết lệnh `php` ở đâu, cần thêm vào biến môi trường **PATH**:

1. Bấm phím **Windows**, gõ `environment` → chọn **Edit the system environment variables**
   (tiếng Việt: *Chỉnh sửa các biến môi trường hệ thống*).
2. Bấm nút **Environment Variables...**
3. Ở khung dưới (**System variables**), chọn dòng **Path** → bấm **Edit...**
4. Bấm **New**, thêm lần lượt 2 dòng:
   ```
   C:\xampp\php
   C:\xampp\mysql\bin
   ```
5. Bấm **OK** ở cả 3 cửa sổ.
6. **Đóng hết cửa sổ CMD/PowerShell đang mở**, mở cửa sổ mới rồi kiểm tra:
   ```bat
   php -v
   mysql --version
   ```
   Hiện ra số phiên bản là thành công.

Chạy bài in ra terminal:
```bat
cd C:\Users\TenBan\Downloads\demo_thuchanh-\bai-7.1-php-tinh-tien-don-hang
php index.php
```
> Mẹo: trong File Explorer, mở thư mục bài, bấm vào thanh địa chỉ, gõ `cmd` rồi Enter
> → cửa sổ CMD mở sẵn tại đúng thư mục đó.

👉 Xong cách 1, chuyển xuống phần **[Kiểm tra PHP kết nối MySQL](#kiểm-tra-php-kết-nối-mysql)**.

---

## CÁCH 2 - Cài riêng PHP và MySQL

### Phần A. Cài PHP

1. Vào https://windows.php.net/download
2. Chọn bản PHP 8.x mới nhất, mục **VS16/VS17 x64 Thread Safe** → bấm tải file **Zip**.
3. Giải nén vào thư mục **`C:\php`** (bên trong phải thấy file `C:\php\php.exe`).
4. Trong `C:\php`, copy file **`php.ini-development`** và đổi tên bản copy thành **`php.ini`**.
5. Mở `php.ini` bằng Notepad, tìm (Ctrl + F) và **xóa dấu `;` ở đầu** các dòng sau:
   ```ini
   extension_dir = "ext"
   extension=mbstring
   extension=mysqli
   extension=openssl
   extension=pdo_mysql
   ```
   Lưu file lại.
6. Thêm **`C:\php`** vào PATH (làm giống Bước 6 của Cách 1).
7. Mở CMD mới, kiểm tra:
   ```bat
   php -v
   php -m
   ```
   Lệnh `php -m` phải có `mysqli` và `pdo_mysql` trong danh sách.

> Nếu báo lỗi thiếu file **`VCRUNTIME140.dll`**: tải và cài **Microsoft Visual C++ Redistributable (x64)**
> từ trang của Microsoft: https://aka.ms/vs/17/release/vc_redist.x64.exe rồi chạy lại.

### Phần B. Cài MySQL

1. Vào https://dev.mysql.com/downloads/mysql/
2. Chọn hệ điều hành **Microsoft Windows** → tải bản **MSI Installer** (x64).
   Trang hỏi đăng nhập → bấm **No thanks, just start my download**.
3. Chạy file `.msi`, chọn kiểu cài **Typical** → **Install**.
4. Cài xong, chương trình cấu hình (**MySQL Configurator**) sẽ mở. Chọn:
   - **Config Type**: `Development Computer`
   - **Port**: `3306` (giữ mặc định)
   - **Root Password**: đặt mật khẩu cho tài khoản `root` → **ghi nhớ mật khẩu này!**
   - **Windows Service**: tick **Configure MySQL Server as a Windows Service** và **Start at System Startup**
   - Bấm **Next** → **Execute** → **Finish**.
5. Thêm thư mục `bin` của MySQL vào PATH, ví dụ (đổi số phiên bản cho đúng máy bạn):
   ```
   C:\Program Files\MySQL\MySQL Server 8.4\bin
   ```
6. Mở CMD mới, đăng nhập thử:
   ```bat
   mysql -u root -p
   ```
   Nhập mật khẩu đã đặt → thấy dấu nhắc `mysql>` là thành công. Gõ `exit` để thoát.

> Muốn có giao diện đồ họa để quản lý database: cài thêm **MySQL Workbench**
> tại https://dev.mysql.com/downloads/workbench/

---

## Kiểm tra PHP kết nối MySQL

### Bước 1. Tạo database và bảng mẫu
Mở MySQL bằng một trong các cách:
- **XAMPP**: vào http://localhost/phpmyadmin → tab **SQL**
- **Terminal**: `mysql -u root -p` (XAMPP thì `mysql -u root`, không cần `-p`)

Chạy đoạn SQL sau:
```sql
SET NAMES utf8mb4;  -- để lưu đúng tiếng Việt khi chạy từ terminal

CREATE DATABASE IF NOT EXISTS demo_php CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE demo_php;

DROP TABLE IF EXISTS sinh_vien;  -- xóa bảng cũ (nếu có) để chạy lại nhiều lần không bị trùng dữ liệu
CREATE TABLE sinh_vien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ho_ten VARCHAR(100) NOT NULL,
    diem FLOAT
);

INSERT INTO sinh_vien (ho_ten, diem) VALUES
    ('Nguyễn Văn An', 8.5),
    ('Trần Thị Bình', 6.0),
    ('Lê Văn Cường', 4.5);
```

### Bước 2. Viết file PHP kết nối
Tạo file `test-ket-noi.php`:
```php
<?php
$host     = "localhost";
$dbname   = "demo_php";
$username = "root";
$password = "";   // XAMPP: để trống. Cài riêng MySQL: điền mật khẩu root đã đặt

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối MySQL thành công!\n\n";

    $rows = $pdo->query("SELECT id, ho_ten, diem FROM sinh_vien")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        echo $row["id"] . ". " . $row["ho_ten"] . " - " . $row["diem"] . " điểm\n";
    }
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage() . "\n";
}
```

### Bước 3. Chạy thử
```bat
php test-ket-noi.php
```
Kết quả đúng:
```
Kết nối MySQL thành công!

1. Nguyễn Văn An - 8.5 điểm
2. Trần Thị Bình - 6 điểm
3. Lê Văn Cường - 4.5 điểm
```
(Hoặc copy file vào `C:\xampp\htdocs\` và mở http://localhost/test-ket-noi.php)

---

## Lỗi thường gặp

| Lỗi | Nguyên nhân / Cách xử lý |
|---|---|
| `'php' is not recognized as an internal or external command` | Chưa thêm thư mục PHP vào **PATH**, hoặc chưa **mở lại** cửa sổ CMD sau khi thêm |
| `'mysql' is not recognized ...` | Chưa thêm thư mục `bin` của MySQL vào **PATH** |
| Tiếng Việt in ra terminal bị lỗi font (`Ä‘`, `?`) | Gõ `chcp 65001` trong CMD rồi chạy lại, hoặc dùng **Windows Terminal / PowerShell** |
| XAMPP: Apache không Start, báo *Port 80 in use* | Cổng 80 bị phần mềm khác chiếm (IIS, Skype, VMware...). Tắt phần mềm đó, **hoặc** bấm **Config** → `httpd.conf` → đổi `Listen 80` thành `Listen 8080`, lưu, Start lại và truy cập http://localhost:8080 |
| XAMPP: Apache báo *Port 443 in use* | Bấm **Config** → `httpd-ssl.conf` → đổi `Listen 443` thành `Listen 4433` |
| XAMPP: MySQL không Start, báo *Port 3306 in use* | Máy đã cài sẵn một MySQL khác đang chạy. Bấm phím Windows, gõ `services.msc` → tìm dịch vụ **MySQL** → **Stop**, rồi Start lại MySQL trong XAMPP |
| XAMPP: *MySQL shutdown unexpectedly* | Thường do tắt máy đột ngột làm hỏng dữ liệu. Bấm **Logs** để xem lỗi. Cách hay dùng: **sao lưu** thư mục `C:\xampp\mysql\data` trước, sau đó copy các file trong `C:\xampp\mysql\backup` đè vào `C:\xampp\mysql\data` (bỏ qua file `ibdata1`) rồi Start lại |
| `Access denied for user 'root'@'localhost'` | Sai mật khẩu root. XAMPP: mật khẩu để trống. Cài riêng: dùng mật khẩu đã đặt lúc cài |
| `could not find driver` khi dùng PDO | Chưa bật `extension=pdo_mysql` trong `php.ini` (Cách 2, Phần A, bước 5) |
| `Unknown database 'demo_php'` | Chưa chạy đoạn SQL tạo database ở bước "Kiểm tra PHP kết nối MySQL" |
| Trình duyệt hiện nguyên code PHP / tải file về | Đang mở file trực tiếp (`file:///C:/...`). Phải mở qua `http://localhost/...` |

---

## Tóm tắt lệnh hay dùng

| Lệnh | Tác dụng |
|---|---|
| `php -v` | Xem phiên bản PHP |
| `php -m` | Xem các extension đã bật |
| `php index.php` | Chạy file PHP, kết quả in ra terminal |
| `php -S localhost:8000` | Bật web server tại thư mục hiện tại (không cần Apache) |
| `mysql -u root -p` | Đăng nhập MySQL bằng tài khoản root |
| `SHOW DATABASES;` | (trong MySQL) Xem danh sách database |
| `chcp 65001` | Cho CMD hiển thị đúng tiếng Việt (UTF-8) |
