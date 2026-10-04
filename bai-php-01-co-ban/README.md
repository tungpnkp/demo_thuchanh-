# PHP 01 - Làm quen với PHP cơ bản

## Mục tiêu
Viết trang PHP đầu tiên: khai báo biến, in ra HTML, dùng điều kiện, vòng lặp, mảng và hàm.

## Kiến thức sử dụng
| Nội dung | Ví dụ |
|---|---|
| Biến | `$ten = "An";` |
| In ra | `echo "Xin chào $ten";` hoặc `<?= $ten ?>` |
| Nối chuỗi | `"Tuổi: " . $tuoi` |
| Điều kiện | `if / elseif / else`, toán tử 3 ngôi `? :` |
| Mảng | `[1, 2, 3]`, `["ten" => "An"]`, `count()` |
| Vòng lặp | `for`, `foreach` |
| Hàm | `function xepLoai($diem) { return ...; }` |

## Cách chạy
Mở terminal tại thư mục này và chạy:
```bash
php -S localhost:8000
```
Sau đó mở trình duyệt vào: http://localhost:8000

(Hoặc copy thư mục vào `htdocs` của XAMPP và mở `http://localhost/bai-php-01-co-ban`)

## Bài tập mở rộng
1. Thêm 2 sinh viên vào mảng `$sinhVien` và xem bảng thay đổi.
2. Tìm và in ra sinh viên có điểm cao nhất.
3. Tô màu đỏ cho dòng của sinh viên xếp loại "Yếu".
4. In bảng cửu chương từ 2 đến 9.
