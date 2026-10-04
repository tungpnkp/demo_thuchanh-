# Bài 7.4 - Chia chương trình thành các function con

**Kiến thức:** `function`, tham số, `return`.

**Đề:** Viết lại Bài 7.3 bằng các function `formatMoney`, `calculateLineTotal`, `calculateSubtotal`, `calculateDiscount`, `printProductList`, `printSummary`. Function tính toán chỉ `return`, không `echo`; không dùng `global`; chương trình chính chỉ có `$products` và 2 lời gọi in.

| File | Nội dung |
|---|---|
| `index.php` | Bài làm mẫu: function + chương trình chính trong 1 file |
| `mo-rong/functions.php` | Phần mở rộng: chỉ chứa các function |
| `mo-rong/index.php` | Phần mở rộng: `require_once` file functions rồi gọi 2 function in |

Kết quả giống hệt Bài 7.3. Thử đổi `quantity` của "Trứng" thành 1 trong `mo-rong/index.php`: tổng còn 85,000 VNĐ nên Giảm giá là 0 VNĐ.

## Cách chạy (Terminal macOS / Linux / Windows)
```bash
cd đường-dẫn-tới/bai-7.4-php-chia-function
php index.php
```
Kết quả được `echo` thẳng ra Terminal (không cần trình duyệt, không cần `php -S`).
Chưa cài PHP? Xem hướng dẫn cho [macOS](../HUONG-DAN-CHAY-PHP-MACOS.md) hoặc [Windows](../HUONG-DAN-CAI-PHP-MYSQL-WINDOWS.md).
