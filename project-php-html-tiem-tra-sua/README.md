# PROJECT: Website "Tiệm Trà Sữa Mini" (PHP + HTML)

**Đối tượng:** học viên mới bắt đầu PHP và HTML
**Thời lượng:** 3 ngày
**Hình thức:** cá nhân (hoặc nhóm 2 người)

## 1. Giới thiệu đề tài
Một tiệm trà sữa nhỏ muốn có website đơn giản để khách xem menu và đặt đồ uống online, còn chủ tiệm xem lại các đơn đã đặt.
Em hãy xây dựng website đó bằng **HTML + CSS + PHP** (không dùng database, không dùng framework).

## 2. Mục tiêu kiến thức
| Nội dung | Kiến thức áp dụng |
|---|---|
| HTML / CSS | Bố cục trang, thẻ `form`, `table`, liên kết, CSS cơ bản |
| PHP cơ bản | Biến, mảng, mảng kết hợp, `if/else`, `foreach`, hàm |
| Tách file | `include` / `require` (header, footer, dữ liệu chung) |
| Nhận dữ liệu | `$_GET` (tham số trên URL), `$_POST` (form) |
| Kiểm tra dữ liệu | `trim()`, `empty()`, `is_numeric()`, `strlen()` |
| Bảo mật cơ bản | `htmlspecialchars()` khi in dữ liệu người dùng nhập |
| Lưu trữ | Đọc/ghi file: `file_get_contents()`, `file_put_contents()`, `json_encode()`, `json_decode()` |

## 3. Yêu cầu chức năng

### 3.1. Bố cục chung (header / footer)
- Tách phần đầu trang (`header.php`) và cuối trang (`footer.php`), mọi trang đều `include` 2 file này.
- Header có logo/tên tiệm và menu điều hướng: **Menu** – **Đặt hàng** – **Quản lý đơn**.
- Footer ghi năm hiện tại (dùng `date("Y")`) và họ tên học viên.

### 3.2. Dữ liệu menu (`data.php`)
- Khai báo mảng `$menu` gồm **ít nhất 6 món**. Mỗi món là mảng kết hợp có: `id`, `ten`, `loai`, `gia`, `hinh` (emoji hoặc tên file ảnh), `mo_ta`.
- Có ít nhất **3 loại** đồ uống (ví dụ: Trà sữa, Trà trái cây, Cà phê).
- Khai báo mảng topping (ít nhất 3 loại, mỗi loại có tên và giá).
- Viết hàm `dinhDangTien($so)` để hiển thị tiền dạng `25.000 đ`.

### 3.3. Trang Menu (`index.php`)
- Dùng `foreach` hiển thị tất cả món dưới dạng thẻ (card): hình, tên, loại, giá.
- Mỗi món có nút **Xem chi tiết** dẫn tới `chi-tiet.php?id=...`.
- Hiển thị tổng số món đang có.

### 3.4. Trang Chi tiết món (`chi-tiet.php`)
- Lấy `id` từ URL bằng `$_GET`, tìm món tương ứng trong mảng `$menu`.
- Hiển thị đầy đủ thông tin món và nút **Đặt món này** dẫn tới `dat-hang.php?id=...`.
- Nếu không có `id` hoặc `id` không tồn tại → báo **"Không tìm thấy món"** và có link quay về Menu.

### 3.5. Trang Đặt hàng (`dat-hang.php`)
Form gửi bằng `method="post"`, gồm các trường:

| Trường | Kiểu input | Ràng buộc |
|---|---|---|
| Họ tên khách | text | Bắt buộc |
| Số điện thoại | text | Bắt buộc, đúng 10 chữ số, bắt đầu bằng số 0 |
| Chọn món | select | Bắt buộc, lấy danh sách từ `$menu`; nếu vào từ trang chi tiết thì chọn sẵn món đó |
| Size | radio (M / L) | Bắt buộc; size L cộng thêm 5.000 đ |
| Topping | checkbox (chọn nhiều) | Không bắt buộc |
| Số lượng | number | Từ 1 đến 10 |
| Ghi chú | textarea | Không bắt buộc |

Xử lý khi bấm **Đặt hàng**:
- Kiểm tra dữ liệu; nếu sai thì hiện **danh sách lỗi** và **giữ lại** các giá trị đã nhập trong form.
- Nếu hợp lệ, tính tiền:
  `Đơn giá = giá món + phụ thu size + tổng giá topping`
  `Thành tiền = Đơn giá × Số lượng`
- Hiển thị **hóa đơn**: tên khách, món, size, topping, số lượng, đơn giá, thành tiền, thời gian đặt.
- Lưu đơn hàng vào file `don-hang.json`.

### 3.6. Trang Quản lý đơn hàng (`don-hang.php`)
- Đọc file `don-hang.json` và hiển thị bảng các đơn: STT, thời gian, khách hàng, SĐT, món, size, topping, số lượng, thành tiền.
- Đơn mới nhất hiển thị lên đầu.
- Bên trên bảng hiển thị: **tổng số đơn**, **tổng số ly**, **tổng doanh thu**.
- Nếu chưa có đơn nào → hiện thông báo "Chưa có đơn hàng".

### 3.7. Tìm kiếm và lọc (trên trang Menu)
- Form `method="get"` gồm ô tìm theo tên món và ô chọn loại.
- Chỉ hiển thị các món thỏa điều kiện; không có món nào → báo "Không tìm thấy món phù hợp".

## 4. Kế hoạch 3 ngày

| Ngày | Công việc | Kết quả cần có cuối ngày |
|---|---|---|
| **Ngày 1** – HTML & hiển thị dữ liệu | Thiết kế bố cục + CSS; tạo `header.php`, `footer.php`, `data.php`; làm trang Menu (3.3) và Chi tiết (3.4) | Xem được menu và trang chi tiết từng món |
| **Ngày 2** – Form & xử lý | Làm trang Đặt hàng (3.5): form, kiểm tra dữ liệu, giữ lại giá trị, tính tiền, hiển thị hóa đơn | Đặt hàng được, nhập sai thì báo lỗi đúng |
| **Ngày 3** – Lưu trữ & hoàn thiện | Lưu đơn vào file JSON; làm trang Quản lý đơn (3.6); tìm kiếm/lọc (3.7); kiểm thử, chỉnh giao diện, chuẩn bị demo | Website hoàn chỉnh, demo trước lớp 3–5 phút |

## 5. Cấu trúc thư mục yêu cầu
```
tiem-tra-sua/
├── index.php        # Trang menu + tìm kiếm
├── chi-tiet.php     # Chi tiết món
├── dat-hang.php     # Form đặt hàng + hóa đơn
├── don-hang.php     # Quản lý đơn hàng
├── header.php
├── footer.php
├── data.php         # Mảng dữ liệu + các hàm dùng chung
├── style.css
└── don-hang.json    # Tự sinh ra khi có đơn đầu tiên
```

Chạy thử: mở Terminal tại thư mục project, gõ `php -S localhost:8000`, rồi mở http://localhost:8000
(hoặc copy thư mục vào `htdocs` của XAMPP).

## 6. Tiêu chí chấm điểm (thang 10)
| Tiêu chí | Điểm |
|---|---|
| Bố cục, header/footer dùng `include`, giao diện gọn gàng | 1.5 |
| Trang Menu hiển thị đúng từ mảng bằng `foreach` | 1.5 |
| Trang Chi tiết dùng `$_GET`, xử lý trường hợp id sai | 1.0 |
| Form đặt hàng đủ trường, kiểm tra dữ liệu, báo lỗi, giữ giá trị đã nhập | 2.0 |
| Tính tiền đúng và hiển thị hóa đơn | 1.0 |
| Lưu đơn vào file và trang Quản lý đơn có thống kê | 1.5 |
| Tìm kiếm / lọc theo loại | 0.5 |
| Code sạch: đặt tên rõ ràng, có chú thích, dùng `htmlspecialchars()` | 0.5 |
| Demo và trả lời câu hỏi của giáo viên | 0.5 |

## 7. Phần nâng cao (cộng tối đa 1 điểm)
- Thêm nút **Xóa đơn** trên trang Quản lý đơn.
- Sắp xếp menu theo giá tăng/giảm dần.
- Mã giảm giá: nhập `GIAM10` được giảm 10% hóa đơn.
- Giỏ hàng đặt nhiều món một lúc (dùng `$_SESSION`).
- Thống kê món bán chạy nhất.

## 8. Nộp bài
- Nén thư mục project thành `HoTen_TiemTraSua.zip` (hoặc đẩy lên GitHub và gửi link).
- Hạn nộp: cuối ngày thứ 3, trước buổi demo.
