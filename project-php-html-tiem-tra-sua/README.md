# PROJECT: Website "Tiệm Trà Sữa Mini" (PHP + HTML + MySQL)

**Đối tượng:** học viên mới bắt đầu PHP và HTML
**Thời lượng:** 3 ngày
**Hình thức:** cá nhân (hoặc nhóm 2 người)

## 1. Giới thiệu đề tài
Một tiệm trà sữa nhỏ muốn có website đơn giản để:
- **Khách hàng** đăng ký tài khoản, đăng nhập, xem menu, đặt đồ uống online và xem lại **lịch sử đơn hàng** của mình.
- **Chủ tiệm (admin)** đăng nhập để quản lý món (thêm / sửa / xóa), xem tất cả đơn hàng và cập nhật trạng thái đơn.

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
| MySQL | `SELECT`, `INSERT`, `UPDATE`, `DELETE`, `WHERE`, `LIKE`, `ORDER BY`, `JOIN`, `COUNT`, `SUM` |
| PHP kết nối MySQL | `mysqli_connect()` (hoặc PDO), `mysqli_query()`, `mysqli_fetch_assoc()`, **prepared statement** |
| Đăng nhập | `session_start()`, `$_SESSION`, `session_destroy()`, `password_hash()`, `password_verify()` |
| Phân quyền | Kiểm tra vai trò `khach` / `admin` trước khi cho vào trang |
| Bảo mật cơ bản | Chống SQL Injection (prepared statement), mã hóa mật khẩu, `htmlspecialchars()` khi in dữ liệu |
| Chuyển trang | `header("Location: ...")` sau khi đăng nhập / thêm / sửa / xóa |

## 3. Thiết kế cơ sở dữ liệu
Tạo CSDL tên `tiem_tra_sua` (bảng mã `utf8mb4_unicode_ci`) với 5 bảng:

**`nguoi_dung`** – tài khoản
| Cột | Kiểu | Ghi chú |
|---|---|---|
| id | INT, PK, AUTO_INCREMENT | |
| ho_ten | VARCHAR(100) | |
| ten_dang_nhap | VARCHAR(50), UNIQUE | Không được trùng |
| mat_khau | VARCHAR(255) | Lưu chuỗi đã mã hóa bằng `password_hash()`, **không lưu mật khẩu gốc** |
| so_dien_thoai | VARCHAR(10) | |
| vai_tro | VARCHAR(10) | `khach` hoặc `admin` (mặc định `khach`) |
| ngay_tao | DATETIME | Mặc định `CURRENT_TIMESTAMP` |

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

**`don_hang`** – lưu toàn bộ lịch sử đơn
| Cột | Kiểu | Ghi chú |
|---|---|---|
| id | INT, PK, AUTO_INCREMENT | Mã đơn |
| nguoi_dung_id | INT | Khóa ngoại → `nguoi_dung.id` (ai đặt đơn) |
| ho_ten | VARCHAR(100) | Tên người nhận |
| so_dien_thoai | VARCHAR(10) | SĐT người nhận |
| mon_id | INT | Khóa ngoại → `mon.id` |
| ten_mon | VARCHAR(150) | Lưu lại tên món **tại thời điểm đặt** |
| size | CHAR(1) | `M` hoặc `L` |
| topping | VARCHAR(255) | Tên các topping đã chọn, cách nhau dấu phẩy |
| so_luong | INT | |
| don_gia | INT | Giá **tại thời điểm đặt** |
| thanh_tien | INT | |
| ghi_chu | TEXT | |
| trang_thai | VARCHAR(20) | `Mới` / `Đang pha` / `Đã giao` / `Đã hủy` (mặc định `Mới`) |
| thoi_gian | DATETIME | Mặc định `CURRENT_TIMESTAMP` |

> Vì sao lưu `ten_mon`, `don_gia` vào đơn hàng? Sau này chủ tiệm đổi giá hoặc tên món thì **lịch sử đơn cũ vẫn giữ đúng** số tiền khách đã trả.

Dữ liệu mẫu tối thiểu: **1 tài khoản admin, 2 tài khoản khách, 3 loại, 8 món, 4 topping, 5 đơn hàng**.
Toàn bộ câu lệnh tạo bảng + dữ liệu mẫu lưu trong file `database.sql`. Ghi rõ tài khoản/mật khẩu mẫu trong file `README` của bài nộp.

## 4. Yêu cầu chức năng

### 4.1. Bố cục chung
- `ket-noi.php`: kết nối MySQL và gọi `session_start()`; mọi trang đều `require` file này.
- `header.php` / `footer.php`: mọi trang đều `include`.
- Menu trên header **thay đổi theo trạng thái đăng nhập**:

| Trạng thái | Menu hiển thị |
|---|---|
| Chưa đăng nhập | Menu – Đăng nhập – Đăng ký |
| Khách | Menu – Đặt hàng – Lịch sử đơn hàng – *Xin chào, {họ tên}* – Đăng xuất |
| Admin | Menu – Quản lý món – Quản lý đơn – *Xin chào, {họ tên}* – Đăng xuất |

- Footer ghi năm hiện tại và họ tên học viên.

### 4.2. Đăng ký (`dang-ky.php`)
- Form: họ tên, tên đăng nhập, số điện thoại, mật khẩu, nhập lại mật khẩu.
- Kiểm tra: không để trống; tên đăng nhập 4–50 ký tự và **chưa có ai dùng**; SĐT 10 chữ số bắt đầu bằng 0; mật khẩu ít nhất 6 ký tự; 2 lần nhập mật khẩu phải giống nhau.
- Lỗi thì hiện danh sách lỗi và giữ lại dữ liệu đã nhập (trừ mật khẩu).
- Thành công: lưu tài khoản với vai trò `khach`, mật khẩu mã hóa bằng `password_hash()`, chuyển sang trang đăng nhập kèm thông báo "Đăng ký thành công".

### 4.3. Đăng nhập / Đăng xuất (`dang-nhap.php`, `dang-xuat.php`)
- Form: tên đăng nhập, mật khẩu.
- Tìm tài khoản theo tên đăng nhập (prepared statement), kiểm tra mật khẩu bằng `password_verify()`.
- Sai → báo **"Tên đăng nhập hoặc mật khẩu không đúng"** (không nói rõ sai cái nào).
- Đúng → lưu `id`, `ho_ten`, `vai_tro` vào `$_SESSION`. Admin chuyển tới trang Quản lý đơn, khách chuyển về trang Menu.
- Đã đăng nhập mà vào lại trang đăng nhập / đăng ký → chuyển về trang Menu.
- Đăng xuất: xóa session, chuyển về trang Menu.

### 4.4. Phân quyền (`kiem-tra-dang-nhap.php`)
Viết 2 hàm và dùng ở đầu các trang cần bảo vệ:
- `batBuocDangNhap()`: chưa đăng nhập → chuyển tới `dang-nhap.php`.
- `batBuocAdmin()`: không phải admin → hiện "Bạn không có quyền truy cập trang này".

| Trang | Ai được vào |
|---|---|
| Menu, Chi tiết món, Đăng nhập, Đăng ký | Mọi người |
| Đặt hàng, Lịch sử đơn hàng | Người đã đăng nhập |
| Quản lý món, Thêm / Sửa / Xóa món, Quản lý đơn | Chỉ admin |

### 4.5. Trang Menu (`index.php`)
- Lấy danh sách món từ bảng `mon` (**JOIN** `loai_do_uong` để hiện tên loại), hiển thị dạng thẻ: hình, tên, loại, giá.
- Mỗi món có nút **Xem chi tiết** → `chi-tiet.php?id=...`.
- **Tìm kiếm / lọc** (form `method="get"`): tìm theo tên món (`LIKE`) và lọc theo loại. Không có món phù hợp → báo "Không tìm thấy món phù hợp".

### 4.6. Trang Chi tiết món (`chi-tiet.php`)
- Lấy `id` từ `$_GET`, truy vấn món tương ứng.
- Hiển thị đầy đủ thông tin và nút **Đặt món này** → `dat-hang.php?id=...` (chưa đăng nhập thì bấm vào sẽ bị chuyển sang trang đăng nhập).
- `id` không hợp lệ → báo **"Không tìm thấy món"** và có link quay về Menu.

### 4.7. Trang Đặt hàng (`dat-hang.php`) – *cần đăng nhập*
Form `method="post"`:

| Trường | Kiểu input | Ràng buộc |
|---|---|---|
| Họ tên người nhận | text | Bắt buộc; **điền sẵn** từ tài khoản đang đăng nhập |
| Số điện thoại | text | Bắt buộc, 10 chữ số, bắt đầu bằng 0; **điền sẵn** từ tài khoản |
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
- `INSERT` vào `don_hang` với `nguoi_dung_id = $_SESSION["id"]`, trạng thái `Mới`.
- Hiển thị hóa đơn và link **"Xem lịch sử đơn hàng"**.

### 4.8. Lịch sử đơn hàng của khách (`lich-su-don-hang.php`) – *cần đăng nhập*
- Chỉ hiển thị **đơn của chính người đang đăng nhập** (`WHERE nguoi_dung_id = ?`), đơn mới nhất lên đầu.
- Bảng gồm: mã đơn, thời gian, món, size, topping, số lượng, thành tiền, **trạng thái** (mỗi trạng thái một màu).
- Phía trên bảng: tổng số đơn đã đặt và **tổng tiền đã mua** (không tính đơn `Đã hủy`).
- Lọc theo trạng thái (ô chọn: Tất cả / Mới / Đang pha / Đã giao / Đã hủy).
- Đơn đang ở trạng thái `Mới` có nút **Hủy đơn**. Khi hủy phải kiểm tra **đơn đó đúng là của người đang đăng nhập** và đang ở trạng thái `Mới`.
- Chưa có đơn → báo "Bạn chưa có đơn hàng nào" và link về Menu.

### 4.9. Quản lý món (`quan-ly-mon.php`, `them-mon.php`, `sua-mon.php`, `xoa-mon.php`) – *chỉ admin*
- **Danh sách:** bảng gồm ID, tên món, loại, giá, nút Sửa / Xóa.
- **Thêm món:** tên, loại (select từ CSDL), giá, hình, mô tả. Tên không rỗng, giá là số > 0.
- **Sửa món:** `sua-mon.php?id=...`, form hiện sẵn dữ liệu cũ, lưu bằng `UPDATE`.
- **Xóa món:** hỏi xác nhận (`onclick="return confirm('...')"`). Món đã có trong đơn hàng thì **không cho xóa** và báo lý do.

### 4.10. Quản lý đơn hàng (`quan-ly-don.php`) – *chỉ admin*
- Bảng **tất cả** đơn (JOIN `nguoi_dung` để hiện tài khoản đặt): mã đơn, thời gian, tài khoản, người nhận, SĐT, món, size, topping, số lượng, thành tiền, trạng thái.
- Đơn mới nhất lên đầu; lọc theo trạng thái.
- Mỗi đơn có ô chọn trạng thái + nút **Cập nhật** (`UPDATE trang_thai`).
- Thống kê phía trên: tổng số đơn, tổng số ly, **doanh thu** (chỉ tính đơn `Đã giao`).

## 5. Kế hoạch 3 ngày

| Ngày | Công việc | Kết quả cuối ngày |
|---|---|---|
| **Ngày 1** – CSDL, giao diện, tài khoản | Tạo CSDL + dữ liệu mẫu; bố cục HTML/CSS, header/footer; trang Menu (chưa cần tìm kiếm) và Chi tiết; Đăng ký, Đăng nhập, Đăng xuất | Xem được menu từ CSDL; đăng ký, đăng nhập, đăng xuất được; header đổi theo trạng thái đăng nhập |
| **Ngày 2** – Đặt hàng & lịch sử | Phân quyền (4.4); trang Đặt hàng; trang Lịch sử đơn hàng (lọc, hủy đơn) | Khách đặt được đơn và xem lại lịch sử đơn của riêng mình |
| **Ngày 3** – Admin & hoàn thiện | Quản lý món (thêm / sửa / xóa); Quản lý đơn (cập nhật trạng thái, thống kê); tìm kiếm + lọc trên Menu; kiểm thử, xuất `database.sql`, chuẩn bị demo | Website hoàn chỉnh, demo trước lớp 5 phút |

## 6. Cấu trúc thư mục yêu cầu
```
tiem-tra-sua/
├── database.sql            # Tạo bảng + dữ liệu mẫu
├── README.md               # Cách cài đặt + tài khoản mẫu
├── ket-noi.php             # Kết nối MySQL + session_start()
├── kiem-tra-dang-nhap.php  # batBuocDangNhap(), batBuocAdmin()
├── header.php
├── footer.php
├── style.css
├── index.php               # Menu + tìm kiếm/lọc
├── chi-tiet.php
├── dang-ky.php
├── dang-nhap.php
├── dang-xuat.php
├── dat-hang.php
├── lich-su-don-hang.php    # Lịch sử đơn của khách
├── huy-don.php
├── quan-ly-mon.php         # Admin
├── them-mon.php
├── sua-mon.php
├── xoa-mon.php
├── quan-ly-don.php         # Admin
└── images/                 # Ảnh món (nếu dùng ảnh)
```

**Chạy thử (XAMPP):** bật Apache + MySQL → vào http://localhost/phpmyadmin, tạo CSDL `tiem_tra_sua` và import `database.sql` → copy thư mục vào `htdocs` → mở http://localhost/tiem-tra-sua

## 7. Kịch bản demo (giáo viên sẽ kiểm tra)
1. Đăng ký tài khoản mới → thử trùng tên đăng nhập, mật khẩu nhập lại sai.
2. Đăng nhập sai mật khẩu → báo lỗi; đăng nhập đúng → header đổi.
3. Chưa đăng nhập mà gõ thẳng `dat-hang.php` hoặc `quan-ly-mon.php` trên thanh địa chỉ → bị chặn.
4. Khách đặt 2 đơn → vào Lịch sử thấy đủ 2 đơn, đúng tiền; hủy 1 đơn.
5. Đăng nhập tài khoản khách khác → **không thấy** đơn của khách trước.
6. Đăng nhập admin → đổi trạng thái đơn sang `Đã giao` → khách đăng nhập lại thấy trạng thái mới; doanh thu cập nhật.
7. Admin đổi giá 1 món → đơn cũ trong lịch sử **vẫn giữ giá cũ**.
8. Mở bảng `nguoi_dung` trong phpMyAdmin → mật khẩu đã được mã hóa.

## 8. Tiêu chí chấm điểm (thang 10)
| Tiêu chí | Điểm |
|---|---|
| Thiết kế CSDL đúng (khóa chính, khóa ngoại, kiểu dữ liệu), có `database.sql` + dữ liệu mẫu | 1.0 |
| Bố cục, header/footer, header đổi theo đăng nhập, giao diện gọn gàng | 0.5 |
| Trang Menu (có JOIN, tìm kiếm/lọc) và Chi tiết món | 1.0 |
| Đăng ký: kiểm tra dữ liệu, trùng tên đăng nhập, mã hóa mật khẩu | 1.0 |
| Đăng nhập / đăng xuất bằng session, `password_verify()` | 1.0 |
| Phân quyền: chặn đúng trang theo bảng 4.4 | 1.0 |
| Đặt hàng: kiểm tra dữ liệu, tính tiền đúng, lưu đơn gắn với tài khoản | 1.5 |
| Lịch sử đơn hàng: chỉ đơn của mình, tổng tiền, lọc, hủy đơn an toàn | 1.0 |
| Quản lý món: thêm / sửa / xóa | 1.0 |
| Quản lý đơn: cập nhật trạng thái, thống kê | 0.5 |
| Bảo mật & code sạch (prepared statement, `htmlspecialchars()`, đặt tên rõ, có chú thích) + demo, trả lời câu hỏi | 0.5 |

## 9. Phần nâng cao (cộng tối đa 1 điểm)
- Trang **Thông tin tài khoản**: sửa họ tên, SĐT, đổi mật khẩu (phải nhập đúng mật khẩu cũ).
- Bảng `lich_su_trang_thai` lưu mỗi lần đơn đổi trạng thái (trạng thái cũ, mới, ai đổi, lúc nào) và hiển thị dòng thời gian trên trang chi tiết đơn.
- Nút **Đặt lại** trong lịch sử: mở form đặt hàng điền sẵn món, size, topping của đơn cũ.
- Giỏ hàng đặt nhiều món một lần (bảng `chi_tiet_don_hang`).
- Upload ảnh món (`$_FILES`, `move_uploaded_file()`).
- Phân trang lịch sử / danh sách đơn (`LIMIT`, `OFFSET`).
- Thống kê món bán chạy nhất, doanh thu theo ngày (`GROUP BY`).

## 10. Nộp bài
- Nén thư mục project (có `database.sql` và `README.md` ghi tài khoản mẫu) thành `HoTen_TiemTraSua.zip`, hoặc đẩy lên GitHub và gửi link.
- Hạn nộp: cuối ngày thứ 3, trước buổi demo.
