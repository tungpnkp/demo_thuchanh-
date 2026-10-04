# PHP 03 - Biến, hằng, toán tử và chuỗi (Starter)

## Đề bài: In hóa đơn mua hàng

Tạo file `index.php` và thực hiện các yêu cầu sau:

1. **Khai báo biến** lưu thông tin:
   - Tên khách hàng: `"tran thi binh"`
   - Tên sản phẩm: `"Bàn phím cơ"`
   - Đơn giá: `850000`
   - Số lượng: `3`
   - Khách hàng có thẻ thành viên không: `true`
2. **Khai báo hằng** `VAT` = `0.1` (thuế 10%) và hằng `GIAM_GIA_THANH_VIEN` = `0.05` (giảm 5%).
3. **Tính toán** (dùng toán tử `+ - * /`):
   - Thành tiền = đơn giá × số lượng
   - Tiền giảm giá = thành tiền × 5% (chỉ khi là thành viên, ngược lại bằng 0)
   - Tiền VAT = (thành tiền − tiền giảm giá) × 10%
   - Tổng thanh toán = thành tiền − tiền giảm giá + tiền VAT
4. **Xử lý chuỗi**:
   - In tên khách hàng viết hoa chữ cái đầu mỗi từ: `Tran Thi Binh`
   - In tên khách hàng viết HOA toàn bộ: `TRAN THI BINH`
   - In số ký tự của tên khách hàng
5. **Định dạng số tiền** theo kiểu Việt Nam: `2.422.500 đ`
6. In ra **kiểu dữ liệu** của các biến đơn giá, tên sản phẩm, thành viên.
7. Dùng toán tử `%` và `intdiv()`: nếu mỗi hộp chứa được 2 sản phẩm, cần bao nhiêu hộp đầy và còn dư mấy sản phẩm?

### Kết quả mong muốn (tham khảo)
```
Khách hàng: Tran Thi Binh (TRAN THI BINH - 13 ký tự)
Sản phẩm  : Bàn phím cơ
Đơn giá   : 850.000 đ x 3
Thành tiền: 2.550.000 đ
Giảm giá  : 127.500 đ
VAT (10%) : 242.250 đ
TỔNG      : 2.664.750 đ
Đóng gói  : 1 hộp đầy, dư 1 sản phẩm
```

### Gợi ý hàm có sẵn
`define()` hoặc `const`, `ucwords()`, `strtoupper()`, `strlen()`, `number_format()`, `gettype()`, `intdiv()`

---

## Bài làm mẫu
Xem file [`index.php`](index.php).

## Cách chạy trên macOS
> Chưa cài PHP? Xem hướng dẫn cho [macOS](../HUONG-DAN-CHAY-PHP-MACOS.md) hoặc [Windows](../HUONG-DAN-CAI-PHP-MYSQL-WINDOWS.md)

1. Mở **Terminal** (nhấn `Cmd + Space`, gõ `Terminal`, Enter).
2. Di chuyển vào thư mục bài (gõ `cd ` rồi kéo thả thư mục vào cửa sổ Terminal):
   ```bash
   cd ~/Downloads/demo_thuchanh-/bai-php-03-bien-va-toan-tu
   ```
3. Chạy server PHP có sẵn:
   ```bash
   php -S localhost:8000
   ```
4. Mở trình duyệt vào: http://localhost:8000
5. Sửa code → lưu file → bấm **F5 / Cmd + R** trên trình duyệt để xem kết quả mới.
6. Dừng server: quay lại Terminal, nhấn `Ctrl + C`.
