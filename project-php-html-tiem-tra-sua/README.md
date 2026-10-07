# PROJECT: Website "Tiệm Trà Sữa Mini" (PHP + HTML + MySQL)

**Đối tượng:** học viên mới bắt đầu PHP và HTML
**Thời lượng:** 3 ngày
**Hình thức:** cá nhân (hoặc nhóm 2 người)

## 1. Giới thiệu đề tài
Một tiệm trà sữa nhỏ muốn có website đơn giản gồm 2 phần:
- **Phần khách hàng** (không cần tài khoản): xem menu, tìm món, đặt đồ uống online, tra cứu đơn đã đặt bằng số điện thoại.
- **Phần quản trị** (chỉ chủ tiệm, **phải đăng nhập**): quản lý món (thêm / sửa / xóa), xem **lịch sử đơn hàng**, cập nhật trạng thái đơn và xem thống kê.

Em hãy xây dựng website đó bằng **HTML + CSS + PHP thuần + MySQL**.
**Không dùng framework** (không Laravel, CodeIgniter, Bootstrap JS…). CSS tự viết.

## 2. Mục tiêu kiến thức
| Nội dung | Kiến thức áp dụng |
|---|---|
| HTML / CSS | Bố cục trang, `form`, `table`, liên kết, CSS cơ bản |
| PHP cơ bản | Biến, mảng, `if/else`, `foreach` / `while`, hàm |
| Tách file | `include` / `require` (header, footer, kết nối CSDL, kiểm tra đăng nhập) |
| Nhận dữ liệu | `$_GET` (tham số trên URL), `$_POST` (form) |
| Kiểm tra dữ liệu | `trim()`, `empty()`, `is_numeric()`, `strlen()` |
| MySQL | `SELECT`, `INSERT`, `UPDATE`, `DELETE`, `WHERE`, `LIKE`, `BETWEEN`, `ORDER BY`, `JOIN`, `COUNT`, `SUM` |
| PHP kết nối MySQL | `mysqli_connect()` (hoặc PDO), `mysqli_query()`, `mysqli_fetch_assoc()`, **prepared statement** |
| Đăng nhập admin | `session_start()`, `$_SESSION`, `session_destroy()`, `password_verify()` |
| Bảo mật cơ bản | Chống SQL Injection (prepared statement), mật khẩu mã hóa, `htmlspecialchars()` khi in dữ liệu |
| Chuyển trang | `header("Location: ...")` sau khi đăng nhập / thêm / sửa / xóa |

## 3. Thiết kế cơ sở dữ liệu
Tạo CSDL tên `tiem_tra_sua` (bảng mã `utf8mb4_unicode_ci`) với 5 bảng:

**`admin`** – tài khoản quản trị
| Cột | Kiểu | Ghi chú |
|---|---|---|
| id | INT, PK, AUTO_INCREMENT | |
| ten_dang_nhap | VARCHAR(50), UNIQUE | |
| mat_khau | VARCHAR(255) | Chuỗi đã mã hóa bằng `password_hash()`, **không lưu mật khẩu gốc** |
| ho_ten | VARCHAR(100) | |

> Không có trang đăng ký. Tài khoản admin được tạo sẵn trong `database.sql`
> (tạo chuỗi mã hóa bằng cách chạy `echo password_hash("123456", PASSWORD_DEFAULT);` rồi dán vào câu `INSERT`).

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

**`don_hang`** – lưu toàn bộ lịch sử đơn hàng
| Cột | Kiểu | Ghi chú |
|---|---|---|
| id | INT, PK, AUTO_INCREMENT | Mã đơn |
| ho_ten | VARCHAR(100) | Tên khách |
| so_dien_thoai | VARCHAR(10) | Dùng để khách tra cứu đơn |
| mon_id | INT | Khóa ngoại → `mon.id` |
| ten_mon | VARCHAR(150) | Tên món **tại thời điểm đặt** |
| size | CHAR(1) | `M` hoặc `L` |
| topping | VARCHAR(255) | Tên các topping đã chọn, cách nhau dấu phẩy |
| so_luong | INT | |
| don_gia | INT | Giá **tại thời điểm đặt** |
| thanh_tien | INT | |
| ghi_chu | TEXT | |
| trang_thai | VARCHAR(20) | `Mới` / `Đang pha` / `Đã giao` / `Đã hủy` (mặc định `Mới`) |
| thoi_gian | DATETIME | Mặc định `CURRENT_TIMESTAMP` |

> Vì sao lưu `ten_mon`, `don_gia` vào đơn? Sau này chủ tiệm đổi giá hoặc tên món thì **lịch sử đơn cũ vẫn giữ đúng** số tiền khách đã trả.
> Đơn hàng **không bao giờ bị xóa**, chỉ chuyển sang `Đã hủy`, để lịch sử luôn đầy đủ.

Dữ liệu mẫu tối thiểu: **1 tài khoản admin, 3 loại, 8 món, 4 topping, 8 đơn hàng** (rải ở nhiều ngày, nhiều trạng thái).
Toàn bộ câu lệnh tạo bảng + dữ liệu mẫu lưu trong `database.sql`.

## 4. Yêu cầu chức năng – PHẦN KHÁCH HÀNG (không cần đăng nhập)

### 4.1. Bố cục chung
- `ket-noi.php`: kết nối MySQL và gọi `session_start()`; mọi trang `require` file này.
- `header.php` / `footer.php` dùng chung. Menu khách: **Menu – Đặt hàng – Tra cứu đơn**. Góc phải có link nhỏ **Quản trị** (dẫn tới trang đăng nhập admin).
- Footer ghi năm hiện tại và họ tên học viên.

### 4.2. Trang Menu (`index.php`)
- Lấy danh sách món từ bảng `mon` (**JOIN** `loai_do_uong` để hiện tên loại), hiển thị dạng thẻ: hình, tên, loại, giá.
- Mỗi món có nút **Xem chi tiết** → `chi-tiet.php?id=...`.
- **Tìm kiếm / lọc** (form `method="get"`): tìm theo tên món (`LIKE`) và lọc theo loại. Không có món phù hợp → báo "Không tìm thấy món phù hợp".

### 4.3. Trang Chi tiết món (`chi-tiet.php`)
- Lấy `id` từ `$_GET`, truy vấn món tương ứng.
- Hiển thị đầy đủ thông tin và nút **Đặt món này** → `dat-hang.php?id=...`.
- `id` không hợp lệ → báo **"Không tìm thấy món"** và có link quay về Menu.

### 4.4. Trang Đặt hàng (`dat-hang.php`)
Form `method="post"`:

| Trường | Kiểu input | Ràng buộc |
|---|---|---|
| Họ tên | text | Bắt buộc |
| Số điện thoại | text | Bắt buộc, 10 chữ số, bắt đầu bằng 0 |
| Chọn món | select | Bắt buộc, lấy từ bảng `mon`; vào từ trang chi tiết thì chọn sẵn món đó |
| Size | radio (M / L) | Bắt buộc; size L cộng thêm 5.000 đ |
| Topping | checkbox | Không bắt buộc, lấy từ bảng `topping` |
| Số lượng | number | Từ 1 đến 10 |
| Ghi chú | textarea | Không bắt buộc |

Xử lý khi bấm **Đặt hàng**:
- Kiểm tra dữ liệu; sai thì hiện danh sách lỗi và giữ lại giá trị đã nhập.
- Hợp lệ thì tính tiền (giá món và topping lấy từ CSDL, không lấy từ form):
  `Đơn giá = giá món + phụ thu size + tổng giá topping`
  `Thành tiền = Đơn giá × Số lượng`
- `INSERT` vào `don_hang` (prepared statement), trạng thái `Mới`.
- Hiển thị hóa đơn có **mã đơn** (lấy bằng `mysqli_insert_id()`) và lời nhắc "Dùng số điện thoại để tra cứu đơn".

### 4.5. Tra cứu đơn (`tra-cuu.php`)
- Khách nhập số điện thoại (form `method="get"`) → hiển thị các đơn của SĐT đó, mới nhất lên đầu: mã đơn, thời gian, món, size, số lượng, thành tiền, **trạng thái**.
- SĐT không hợp lệ → báo lỗi; không có đơn → báo "Không tìm thấy đơn hàng nào".

## 5. Yêu cầu chức năng – PHẦN QUẢN TRỊ (bắt buộc đăng nhập)

### 5.1. Đăng nhập / Đăng xuất (`admin/dang-nhap.php`, `admin/dang-xuat.php`)
- Form: tên đăng nhập, mật khẩu.
- Tìm admin theo tên đăng nhập (prepared statement), kiểm tra mật khẩu bằng `password_verify()`.
- Sai → báo **"Tên đăng nhập hoặc mật khẩu không đúng"** (không nói rõ sai cái nào).
- Đúng → lưu `admin_id`, `admin_ten` vào `$_SESSION`, chuyển tới trang Lịch sử đơn hàng.
- Đã đăng nhập mà vào lại trang đăng nhập → chuyển thẳng vào trang quản trị.
- Đăng xuất: xóa session, chuyển về trang đăng nhập.

### 5.2. Bảo vệ trang quản trị (`admin/kiem-tra-dang-nhap.php`)
- File này kiểm tra `$_SESSION["admin_id"]`; chưa đăng nhập → chuyển về `admin/dang-nhap.php` và dừng (`exit`).
- **Mọi trang trong thư mục `admin/`** (trừ trang đăng nhập) đều `require` file này ở dòng đầu tiên.
- Header phần quản trị hiển thị: **Lịch sử đơn hàng – Quản lý món – Xin chào, {họ tên} – Đăng xuất**.

### 5.3. Lịch sử đơn hàng (`admin/lich-su-don.php`)
- Hiển thị **toàn bộ** đơn đã lưu, mới nhất lên đầu: mã đơn, thời gian, khách, SĐT, món, size, topping, số lượng, thành tiền, trạng thái (mỗi trạng thái một màu).
- **Bộ lọc** (form `method="get"`, dùng được nhiều điều kiện cùng lúc):
  - Từ ngày – đến ngày (`BETWEEN`)
  - Trạng thái (Tất cả / Mới / Đang pha / Đã giao / Đã hủy)
  - Số điện thoại hoặc tên khách (`LIKE`)
- **Thống kê theo kết quả lọc**: số đơn, tổng số ly, **doanh thu** (chỉ tính đơn `Đã giao`).
- Mỗi đơn có ô chọn trạng thái + nút **Cập nhật** (`UPDATE trang_thai`). Đơn `Đã giao` hoặc `Đã hủy` không được đổi nữa.
- Click mã đơn → `admin/chi-tiet-don.php?id=...` xem đầy đủ thông tin đơn (cả ghi chú).

### 5.4. Quản lý món (`admin/quan-ly-mon.php`, `them-mon.php`, `sua-mon.php`, `xoa-mon.php`)
- **Danh sách:** bảng gồm ID, tên món, loại, giá, nút Sửa / Xóa.
- **Thêm món:** tên, loại (select từ CSDL), giá, hình, mô tả. Tên không rỗng, giá là số > 0.
- **Sửa món:** `sua-mon.php?id=...`, form hiện sẵn dữ liệu cũ, lưu bằng `UPDATE`.
- **Xóa món:** hỏi xác nhận (`onclick="return confirm('...')"`). Món đã có trong lịch sử đơn hàng thì **không cho xóa** và báo lý do.

## 6. Kế hoạch 3 ngày

| Ngày | Công việc | Kết quả cuối ngày |
|---|---|---|
| **Ngày 1** – CSDL & phần khách | Thiết kế, tạo CSDL + dữ liệu mẫu; bố cục HTML/CSS, header/footer; trang Menu (chưa cần tìm kiếm) và Chi tiết món | Xem được menu và chi tiết món lấy từ CSDL |
| **Ngày 2** – Đặt hàng & đăng nhập admin | Trang Đặt hàng (lưu đơn), Tra cứu đơn; Đăng nhập / đăng xuất admin, bảo vệ trang quản trị | Khách đặt và tra cứu được đơn; chưa đăng nhập không vào được `admin/` |
| **Ngày 3** – Quản trị & hoàn thiện | Lịch sử đơn hàng (lọc, thống kê, cập nhật trạng thái); Quản lý món (thêm / sửa / xóa); tìm kiếm trên Menu; kiểm thử, xuất `database.sql`, chuẩn bị demo | Website hoàn chỉnh, demo trước lớp 5 phút |

## 7. Cấu trúc thư mục yêu cầu
```
tiem-tra-sua/
├── database.sql             # Tạo bảng + dữ liệu mẫu (có tài khoản admin)
├── README.md                # Cách cài đặt + tài khoản admin mẫu
├── ket-noi.php              # Kết nối MySQL + session_start()
├── header.php
├── footer.php
├── style.css
├── index.php                # Menu + tìm kiếm/lọc
├── chi-tiet.php
├── dat-hang.php
├── tra-cuu.php              # Khách tra cứu đơn theo SĐT
├── images/                  # Ảnh món (nếu dùng ảnh)
└── admin/
    ├── dang-nhap.php
    ├── dang-xuat.php
    ├── kiem-tra-dang-nhap.php
    ├── header-admin.php
    ├── lich-su-don.php
    ├── chi-tiet-don.php
    ├── cap-nhat-trang-thai.php
    ├── quan-ly-mon.php
    ├── them-mon.php
    ├── sua-mon.php
    └── xoa-mon.php
```

**Chạy thử (XAMPP):** bật Apache + MySQL → vào http://localhost/phpmyadmin, tạo CSDL `tiem_tra_sua` và import `database.sql` → copy thư mục vào `htdocs` → mở http://localhost/tiem-tra-sua (trang quản trị: http://localhost/tiem-tra-sua/admin/dang-nhap.php)

## 8. Kịch bản demo (giáo viên sẽ kiểm tra)
1. Khách xem menu, tìm "trà", lọc theo loại, xem chi tiết 1 món.
2. Khách đặt hàng: bỏ trống / nhập SĐT sai → báo lỗi, dữ liệu vẫn giữ; đặt đúng → ra hóa đơn đúng tiền.
3. Tra cứu bằng SĐT vừa đặt → thấy đơn, trạng thái `Mới`.
4. Gõ thẳng `admin/lich-su-don.php` trên thanh địa chỉ khi chưa đăng nhập → bị chuyển về trang đăng nhập.
5. Đăng nhập admin sai mật khẩu → báo lỗi; đúng → vào trang Lịch sử đơn hàng.
6. Lọc lịch sử theo khoảng ngày + trạng thái → thống kê thay đổi theo.
7. Chuyển đơn vừa đặt sang `Đã giao` → khách tra cứu lại thấy trạng thái mới; doanh thu tăng.
8. Đổi giá 1 món → đơn cũ trong lịch sử **vẫn giữ giá cũ**. Thử xóa món đã có đơn → bị chặn.
9. Mở bảng `admin` trong phpMyAdmin → mật khẩu đã được mã hóa.

## 9. Tiêu chí chấm điểm (thang 10)
| Tiêu chí | Điểm |
|---|---|
| Thiết kế CSDL đúng (khóa chính, khóa ngoại, kiểu dữ liệu), `database.sql` + dữ liệu mẫu | 1.0 |
| Bố cục, header/footer, giao diện gọn gàng | 0.5 |
| Trang Menu (JOIN, tìm kiếm/lọc) và Chi tiết món | 1.5 |
| Đặt hàng: kiểm tra dữ liệu, giữ giá trị, tính tiền đúng, lưu đơn, hóa đơn | 2.0 |
| Tra cứu đơn theo SĐT | 0.5 |
| Đăng nhập / đăng xuất admin (session, `password_verify()`) | 1.0 |
| Bảo vệ toàn bộ trang trong `admin/` | 0.5 |
| Lịch sử đơn hàng: lọc nhiều điều kiện, thống kê, cập nhật trạng thái | 1.5 |
| Quản lý món: thêm / sửa / xóa | 1.0 |
| Bảo mật & code sạch (prepared statement, `htmlspecialchars()`, đặt tên rõ, có chú thích) + demo, trả lời câu hỏi | 0.5 |

## 10. Phần nâng cao (cộng tối đa 1 điểm)
- Bảng `lich_su_trang_thai`: mỗi lần admin đổi trạng thái thì lưu lại (đơn, trạng thái cũ, trạng thái mới, admin nào đổi, lúc nào) và hiển thị dạng dòng thời gian trong `chi-tiet-don.php`.
- Trang **Đổi mật khẩu** cho admin (phải nhập đúng mật khẩu cũ).
- Xuất lịch sử đơn ra file CSV.
- Phân trang lịch sử đơn (`LIMIT`, `OFFSET`).
- Thống kê món bán chạy nhất, doanh thu theo từng ngày (`GROUP BY`).
- Upload ảnh món (`$_FILES`, `move_uploaded_file()`).
- Giỏ hàng đặt nhiều món một lần (bảng `chi_tiet_don_hang`).

## 11. Nộp bài
- Nén thư mục project (có `database.sql` và `README.md` ghi tài khoản admin mẫu) thành `HoTen_TiemTraSua.zip`, hoặc đẩy lên GitHub và gửi link.
- Hạn nộp: cuối ngày thứ 3, trước buổi demo.
