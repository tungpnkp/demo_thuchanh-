# Hướng dẫn cài đặt và chạy PHP trên macOS

Từ macOS 12 (Monterey) trở đi, máy Mac **không còn cài sẵn PHP**. Cách đơn giản nhất là cài qua **Homebrew**.

## Bước 1 - Mở Terminal
Nhấn `Cmd + Space` → gõ `Terminal` → Enter.

## Bước 2 - Kiểm tra PHP đã có chưa
```bash
php -v
```
- Nếu hiện `PHP 8.x.x ...` → đã có PHP, chuyển sang **Bước 5**.
- Nếu hiện `command not found: php` → làm tiếp Bước 3.

## Bước 3 - Cài Homebrew (bỏ qua nếu đã có)
Kiểm tra: `brew -v`. Nếu chưa có, chạy lệnh sau (lấy từ trang https://brew.sh):
```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```
- Máy sẽ hỏi **mật khẩu đăng nhập máy Mac** (khi gõ sẽ không hiện ký tự, cứ gõ rồi Enter).
- Với máy **chip Apple (M1/M2/M3/M4)**: cuối quá trình cài, Terminal sẽ in ra mục **"Next steps"**,
  hãy chạy 2 lệnh đó. Thường là:
  ```bash
  echo 'eval "$(/opt/homebrew/bin/brew shellenv)"' >> ~/.zprofile
  eval "$(/opt/homebrew/bin/brew shellenv)"
  ```

## Bước 4 - Cài PHP
```bash
brew install php
php -v
```
Hiện `PHP 8.x.x` là cài thành công.

## Bước 5 - Chạy bài thực hành
```bash
# 1. Di chuyển vào thư mục bài
#    Mẹo: gõ "cd " (có dấu cách) rồi KÉO THẢ thư mục từ Finder vào Terminal
cd ~/Downloads/demo_thuchanh-/bai-php-03-bien-va-toan-tu

# 2. Bật server PHP có sẵn
php -S localhost:8000
```
Mở trình duyệt (Safari/Chrome) vào: **http://localhost:8000**

- Sửa code → lưu → `Cmd + R` trên trình duyệt để xem kết quả mới (không cần tắt server).
- Tắt server: quay lại Terminal, nhấn `Ctrl + C`.
- Muốn chạy bài khác: tắt server, `cd` sang thư mục bài khác, rồi chạy lại `php -S localhost:8000`.

## Một số lệnh hữu ích
| Lệnh | Tác dụng |
|---|---|
| `php -v` | Xem phiên bản PHP |
| `php -l index.php` | Kiểm tra lỗi cú pháp của file |
| `php index.php` | Chạy file ngay trong Terminal (xem kết quả dạng text/HTML) |
| `php -S localhost:8000` | Bật web server tại thư mục hiện tại |
| `pwd` / `ls` | Xem đang ở thư mục nào / liệt kê file |

## Lỗi thường gặp
| Lỗi | Cách xử lý |
|---|---|
| `command not found: php` | Chưa cài PHP (Bước 4), hoặc đóng Terminal mở lại sau khi cài |
| `command not found: brew` | Chưa chạy 2 lệnh "Next steps" ở Bước 3 (máy chip Apple) |
| `Address already in use` | Cổng 8000 đang bận → dùng cổng khác: `php -S localhost:8001` |
| Trình duyệt báo `Not Found` | Chưa `cd` đúng thư mục chứa file `index.php` (gõ `ls` để kiểm tra) |
| Trang trắng, không báo lỗi | Bật hiển thị lỗi: `php -S localhost:8000 -d display_errors=1` |
| Trình duyệt hiện nguyên code PHP | Đang mở file trực tiếp (`file://...`). Phải mở qua `http://localhost:8000` |

## Cách khác (không dùng Terminal)
Có thể cài **MAMP** (https://www.mamp.info) hoặc **XAMPP** (https://www.apachefriends.org) - phần mềm có giao diện,
bấm Start là chạy. Sau đó copy thư mục bài vào thư mục `htdocs` và mở `http://localhost:8888/<tên-thư-mục>` (MAMP)
hoặc `http://localhost/<tên-thư-mục>` (XAMPP).
