# PROJECT: Website "Tiệm Trà Sữa Mini" (PHP + HTML + MySQL)

**Đối tượng:** học viên mới bắt đầu PHP và HTML
**Thời lượng:** 3 ngày
**Hình thức:** cá nhân (hoặc nhóm 2 người)

## 1. Giới thiệu đề tài
Một tiệm trà sữa nhỏ muốn có website đơn giản để:
- **Khách hàng** xem menu, tìm món và đặt đồ uống online.
- **Chủ tiệm** quản lý món (thêm / sửa / xóa) và xem các đơn hàng đã đặt.

Em hãy xây dựng website đó bằng **HTML + CSS + PHP thuần + MySQL**.
**Không dùng framework** (không Laravel, CodeIgniter, Bootstrap JS…). CSS tự viết.

## 2. Mục tiêu kiến thức
| Nội dung | Kiến thức áp dụng |
|---|---|
| HTML / CSS | Bố cục trang, `form`, `table`, liên kết, CSS cơ bản |
| PHP cơ bản | Biến, mảng, `if/else`, `foreach` / `while`, hàm |
| Tách file | `include` / `require` (header, footer, kết nối CSDL) |
| Nhận dữ liệu | `$_GET` (tham số trên URL), `$_POST` (form) |
| Kiểm tra dữ liệu | `trim()`, `empty()`, `is_numeric()`, `strlen()` |
| MySQL | Tạo CSDL/bảng trên phpMyAdmin; `SELECT`, `INSERT`, `UPDATE`, `DELETE`, `WHERE`, `LIKE`, `ORDER BY`, `JOIN`, `COUNT`, `SUM` |
| PHP kết nối MySQL | `mysqli_connect()` (hoặc PDO), `mysqli_query()`, `mysqli_fetch_assoc()`, **prepared statement** |
| Bảo mật cơ bản | Chống SQL Injection bằng prepared statement; `htmlspecialchars()` khi in dữ liệu ra HTML |
| Chuyển trang | `header("Location: ...")` sau khi thêm / sửa / xóa |

## 3. Thiết kế cơ sở dữ liệu
Tạo CSDL tên `tiem_tra_sua` (bảng mã `utf8mb4_unicode_ci`) với 4 bảng:

**`loai_do_uong`** – loại đồ uống
| Cột | Kiểu | Ghi chú |
|---|---|---|
| id | INT, PK, AUTO_INCREMENT | |
| ten_loai | VARCHAR(100) | VD: Trà sữa, Trà trái cây, Cà phê |

**`mon`** – món trong menu
| Cột | Kiểu | Ghi chú |
|---|---|---|
| id | INT, PK, AUTO_INCREMENT | |
| ten_mon | VARCHAR(150) | Bắt buộc |
| loai_id | INT | Khóa ngoại → `loai_do_uong.id` |
| gia | INT | Giá size M (đồng) |
| hinh | VARCHAR(255) | Tên file ảnh hoặc emoji |
| mo_ta | TEXT | |

**`topping`**
| Cột | Kiểu | Ghi chú |
|---|---|---|
| id | INT, PK, AUTO_INCREMENT | |
| ten_topping | VARCHAR(100) | |
| gia | INT | |

**`don_hang`**
| Cột | Kiểu | Ghi chú |
|---|---|---|
| id | INT, PK, AUTO_INCREMENT | |
| ho_ten | VARCHAR(100) | |
| so_dien_thoai | VARCHAR(10) | |
| mon_id | INT | Khóa ngoại → `mon.id` |
| size | CHAR(1) | `M` hoặc `L` |
| topping | VARCHAR(255) | Lưu tên các topping đã chọn, cách nhau dấu phẩy |
| so_luong | INT | |
| don_gia | INT | |
| thanh_tien | INT | |
| ghi_chu | TEXT | |
| thoi_gian | DATETIME | Mặc định `CURRENT_TIMESTAMP` |

Yêu cầu dữ liệu mẫu: **ít nhất 3 loại, 8 món, 4 topping**.
Toàn bộ câu lệnh tạo bảng + dữ liệu mẫu lưu trong file `database.sql` (xuất từ phpMyAdmin hoặc tự viết).

## 4. Yêu cầu chức năng

### 4.1. Bố cục chung
- File `ket-noi.php` chứa kết nối MySQL, các trang khác `require` file này.
- Tách `header.php` / `footer.php`, mọi trang đều `include`.
- Header có logo/tên tiệm và menu: **Menu** – **Đặt hàng** – **Quản lý món** – **Quản lý đơn**.
- Footer ghi năm hiện tại và họ tên học viên.

### 4.2. Trang Menu (`index.php`)
- Lấy danh sách món từ bảng `mon` (**JOIN** với `loai_do_uong` để hiện tên loại), hiển thị dạng thẻ (card): hình, tên, loại, giá.
- Mỗi món có nút **Xem chi tiết** → `chi-tiet.php?id=...`.
- **Tìm kiếm / lọc** (form `method="get"`): tìm theo tên món (`LIKE`) và lọc theo loại; danh sách loại trong ô chọn lấy từ CSDL.
- Không có món phù hợp → báo "Không tìm thấy món phù hợp".

### 4.3. Trang Chi tiết món (`chi-tiet.php`)
- Lấy `id` từ `$_GET`, truy vấn món tương ứng (dùng prepared statement).
- Hiển thị đầy đủ thông tin và nút **Đặt món này** → `dat-hang.php?id=...`.
- Không có `id` hoặc `id` không tồn tại → báo **"Không tìm thấy món"** và có link quay về Menu.

### 4.4. Trang Đặt hàng (`dat-hang.php`)
Form `method="post"` gồm:

| Trường | Kiểu input | Ràng buộc |
|---|---|---|
| Họ tên khách | text | Bắt buộc |
| Số điện thoại | text | Bắt buộc, đúng 10 chữ số, bắt đầu bằng số 0 |
| Chọn món | select | Bắt buộc, lấy từ bảng `mon`; vào từ trang chi tiết thì chọn sẵn món đó |
| Size | radio (M / L) | Bắt buộc; size L cộng thêm 5.000 đ |
| Topping | checkbox (chọn nhiều) | Không bắt buộc, lấy từ bảng `topping` |
| Số lượng | number | Từ 1 đến 10 |
| Ghi chú | textarea | Không bắt buộc |

Xử lý khi bấm **Đặt hàng**:
- Kiểm tra dữ liệu; sai thì hiện **danh sách lỗi** và **giữ lại** giá trị đã nhập.
- Hợp lệ thì tính tiền (giá món và topping phải lấy từ CSDL, không lấy từ form):
  `Đơn giá = giá món + phụ thu size + tổng giá topping`
  `Thành tiền = Đơn giá × Số lượng`
- `INSERT` đơn vào bảng `don_hang` bằng **prepared statement**.
- Hiển thị **hóa đơn**: mã đơn, tên khách, món, size, topping, số lượng, đơn giá, thành tiền, thời gian.

### 4.5. Quản lý món (`quan-ly-mon.php`, `them-mon.php`, `sua-mon.php`, `xoa-mon.php`)
- **Danh sách:** bảng gồm ID, tên món, loại, giá, nút Sửa / Xóa.
- **Thêm món:** form gồm tên, loại (select từ CSDL), giá, hình, mô tả. Kiểm tra: tên không rỗng, giá là số > 0. Thêm xong chuyển về trang danh sách.
- **Sửa món:** mở `sua-mon.php?id=...`, form hiện sẵn dữ liệu cũ; lưu bằng `UPDATE`.
- **Xóa món:** hỏi xác nhận trước khi xóa (`onclick="return confirm('...')"`), xóa bằng `DELETE`. Món đã có đơn hàng thì **không cho xóa** và báo lý do.

### 4.6. Quản lý đơn hàng (`don-hang.php`)
- Bảng các đơn (JOIN với `mon` để hiện tên món): mã đơn, thời gian, khách, SĐT, món, size, topping, số lượng, thành tiền.
- Đơn mới nhất lên đầu (`ORDER BY thoi_gian DESC`).
- Phía trên bảng: **tổng số đơn**, **tổng số ly**, **tổng doanh thu** (dùng `COUNT`, `SUM`).
- Chưa có đơn → báo "Chưa có đơn hàng".

## 5. Kế hoạch 3 ngày

| Ngày | Công việc | Kết quả cuối ngày |
|---|---|---|
| **Ngày 1** – CSDL & hiển thị | Thiết kế, tạo CSDL + dữ liệu mẫu; bố cục HTML/CSS; `ket-noi.php`, header/footer; trang Menu (4.2, chưa cần tìm kiếm) và Chi tiết (4.3) | Xem được menu lấy từ CSDL và chi tiết từng món |
| **Ngày 2** – Form & thêm dữ liệu | Trang Đặt hàng (4.4): form, kiểm tra, tính tiền, `INSERT`, hóa đơn; trang Quản lý đơn (4.6) | Đặt hàng được, đơn lưu vào CSDL và hiện trong trang quản lý |
| **Ngày 3** – CRUD & hoàn thiện | Quản lý món: thêm / sửa / xóa (4.5); tìm kiếm + lọc; kiểm thử, chỉnh giao diện, xuất `database.sql`, chuẩn bị demo | Website hoàn chỉnh, demo trước lớp 3–5 phút |

## 6. Cấu trúc thư mục yêu cầu
```
tiem-tra-sua/
├── database.sql       # Tạo bảng + dữ liệu mẫu
├── ket-noi.php        # Kết nối MySQL
├── header.php
├── footer.php
├── style.css
├── index.php          # Menu + tìm kiếm/lọc
├── chi-tiet.php       # Chi tiết món
├── dat-hang.php       # Đặt hàng + hóa đơn
├── don-hang.php       # Quản lý đơn hàng
├── quan-ly-mon.php    # Danh sách món (quản lý)
├── them-mon.php
├── sua-mon.php
├── xoa-mon.php
└── images/            # Ảnh món (nếu dùng ảnh)
```

**Chạy thử (XAMPP):** bật Apache + MySQL → vào http://localhost/phpmyadmin, tạo CSDL `tiem_tra_sua` và import `database.sql` → copy thư mục project vào `htdocs` → mở http://localhost/tiem-tra-sua

## 7. Tiêu chí chấm điểm (thang 10)
| Tiêu chí | Điểm |
|---|---|
| Thiết kế CSDL đúng (khóa chính, khóa ngoại, kiểu dữ liệu), có `database.sql` + dữ liệu mẫu | 1.5 |
| Bố cục, header/footer, kết nối CSDL tách file, giao diện gọn gàng | 1.0 |
| Trang Menu lấy dữ liệu từ CSDL (có JOIN), trang Chi tiết xử lý được id sai | 1.5 |
| Form đặt hàng: đủ trường, kiểm tra dữ liệu, báo lỗi, giữ giá trị đã nhập | 1.5 |
| Tính tiền đúng, lưu đơn vào CSDL, hiển thị hóa đơn | 1.0 |
| Quản lý món: thêm / sửa / xóa đúng | 1.5 |
| Quản lý đơn có thống kê; tìm kiếm / lọc trên Menu | 1.0 |
| Bảo mật & code sạch: prepared statement, `htmlspecialchars()`, đặt tên rõ ràng, có chú thích | 0.5 |
| Demo và trả lời câu hỏi của giáo viên | 0.5 |

## 8. Phần nâng cao (cộng tối đa 1 điểm)
- Đăng nhập cho chủ tiệm (bảng `nguoi_dung`, `$_SESSION`); chưa đăng nhập thì không vào được trang quản lý.
- Upload ảnh món khi thêm / sửa (`$_FILES`, `move_uploaded_file()`).
- Trạng thái đơn hàng (Mới / Đang pha / Đã giao) và nút cập nhật trạng thái.
- Phân trang danh sách đơn (`LIMIT`, `OFFSET`).
- Sắp xếp menu theo giá; thống kê món bán chạy nhất (`GROUP BY`).
- Tách topping thành bảng `don_hang_topping` (quan hệ nhiều – nhiều).

## 9. Nộp bài
- Nén thư mục project (có kèm `database.sql`) thành `HoTen_TiemTraSua.zip`, hoặc đẩy lên GitHub và gửi link.
- Hạn nộp: cuối ngày thứ 3, trước buổi demo.
