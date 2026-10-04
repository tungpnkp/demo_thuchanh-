# PHP 02 - Xử lý form với PHP

## Mục tiêu
Xây dựng máy tính đơn giản: nhận dữ liệu từ form HTML, kiểm tra dữ liệu và hiển thị kết quả bằng PHP.

## Kiến thức sử dụng
| Nội dung | Ví dụ |
|---|---|
| Form gửi dữ liệu | `<form method="post">`, `<input name="so_a">` |
| Nhận dữ liệu | `$_POST["so_a"]` (còn có `$_GET` khi `method="get"`) |
| Kiểm tra form đã gửi chưa | `$_SERVER["REQUEST_METHOD"] === "POST"` |
| Giá trị mặc định | `$_POST["so_a"] ?? ""` |
| Kiểm tra dữ liệu | `trim()`, `is_numeric()` |
| Ép kiểu | `(float)$soA` |
| Rẽ nhánh | `switch / case` |
| Bảo mật khi in ra | `htmlspecialchars()` |

## Cách chạy
Mở terminal tại thư mục này và chạy:
```bash
php -S localhost:8000
```
Sau đó mở trình duyệt vào: http://localhost:8000

## Thử nghiệm
- Để trống 1 ô → báo lỗi "Vui lòng nhập đầy đủ 2 số!"
- Nhập chữ `abc` → báo lỗi "Dữ liệu nhập vào phải là số!"
- Chia cho 0 → báo lỗi "Không thể chia cho 0!"
- Đổi `method="post"` thành `method="get"` (và `$_POST` thành `$_GET`) → quan sát dữ liệu hiện trên thanh địa chỉ.

## Bài tập mở rộng
1. Thêm phép tính lũy thừa (`**`) và chia lấy dư (`%`).
2. Làm form tính chỉ số BMI: nhập chiều cao, cân nặng → in ra BMI và đánh giá (gầy / bình thường / thừa cân).
3. Làm form đăng ký: họ tên, email, giới tính (radio), sở thích (checkbox) → hiển thị lại thông tin đã nhập.
