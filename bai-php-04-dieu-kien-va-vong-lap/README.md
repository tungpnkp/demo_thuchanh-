# PHP 04 - Câu lệnh điều kiện và vòng lặp (Starter)

## Đề bài: Luyện tập với các con số

Tạo file `index.php` và thực hiện các yêu cầu sau. Đầu file khai báo:
```php
$n   = 15;
$nam = 2024;
$thu = 3;
```

### Phần A - Câu lệnh điều kiện
1. **if / else**: Kiểm tra `$n` là số **chẵn** hay **lẻ** (gợi ý: dùng `%`).
2. **if / else + toán tử logic**: Kiểm tra `$nam` có phải **năm nhuận** không.
   Năm nhuận là năm chia hết cho 400, **hoặc** chia hết cho 4 **nhưng** không chia hết cho 100.
   (gợi ý: dùng `&&`, `||`, `!=`)
3. **switch / case**: Dựa vào `$thu` (1 → 7) in ra tên thứ: 1 = Thứ Hai, 2 = Thứ Ba, ..., 7 = Chủ nhật.
   Số khác 1 → 7 thì in "Không hợp lệ".

### Phần B - Vòng lặp
4. **for**: In các số từ 1 đến `$n` trên một dòng. Số chẵn tô màu **xanh**, số lẻ tô màu **đỏ**.
5. **for**: Tính tổng `1 + 2 + ... + n`.
6. **while**: Tính giai thừa `n! = 1 × 2 × ... × n`.
7. **FizzBuzz** - in các số từ 1 đến 30, nhưng:
   - Số chia hết cho cả 3 và 5 → in `FizzBuzz`
   - Số chia hết cho 3 → in `Fizz`
   - Số chia hết cho 5 → in `Buzz`
   - Còn lại → in chính số đó
8. **Vòng lặp lồng nhau**: Vẽ tam giác sao 5 dòng:
   ```
   *
   * *
   * * *
   * * * *
   * * * * *
   ```

### Kết quả mong muốn (tham khảo)
```
15 là số lẻ
2024 là năm nhuận
Thứ 3 là: Thứ Tư
Tổng 1 đến 15 = 120
15! = 1.307.674.368.000
FizzBuzz: 1 2 Fizz 4 Buzz Fizz 7 8 Fizz Buzz 11 Fizz 13 14 FizzBuzz ...
```

Thử đổi giá trị `$n`, `$nam`, `$thu` rồi tải lại trang để kiểm tra chương trình còn đúng không
(ví dụ `$nam = 1900` → không nhuận, `$nam = 2000` → nhuận).

---

## Bài làm mẫu
Xem file [`index.php`](index.php).

## Cách chạy trên macOS
> Chưa cài PHP? Xem hướng dẫn cho [macOS](../HUONG-DAN-CHAY-PHP-MACOS.md) hoặc [Windows](../HUONG-DAN-CAI-PHP-MYSQL-WINDOWS.md)

1. Mở **Terminal** (nhấn `Cmd + Space`, gõ `Terminal`, Enter).
2. Di chuyển vào thư mục bài (gõ `cd ` rồi kéo thả thư mục vào cửa sổ Terminal):
   ```bash
   cd ~/Downloads/demo_thuchanh-/bai-php-04-dieu-kien-va-vong-lap
   ```
3. Chạy server PHP có sẵn:
   ```bash
   php -S localhost:8000
   ```
4. Mở trình duyệt vào: http://localhost:8000
5. Sửa code → lưu file → bấm **F5 / Cmd + R** trên trình duyệt để xem kết quả mới.
6. Dừng server: quay lại Terminal, nhấn `Ctrl + C`.
