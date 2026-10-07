# Bài tập & code mẫu – Lesson 10 + 11

Chạy thử: `cd bai-tap-mau && php -S localhost:8000` rồi mở `http://localhost:8000/<thư-mục>/...`
Học viên chỉ nhận **đề** (các mục "Đề" bên dưới); giảng viên giữ code mẫu trong từng thư mục.

## Làm tại lớp

### TH 11-1 – Đính kèm header (5')  → `th-11-1/header.php`
**Đề:** Viết `header.php` gửi header `X-Author: <tên bạn>` rồi in ra 1 câu chào. Mở bằng Chrome, tìm header đó trong DevTools > Network > Response Headers.
**Đạt khi:** thấy `X-Author` trong Response Headers.
**Mở rộng:** thử `header('Location: ...')`; cố tình `echo` trước `header()` để thấy lỗi "headers already sent".

### TH 10-2 – Chia trang bằng parameters (8')  → `th-10-2/`
**Đề:** `index.php` đọc `?show=`: `product` → trang sản phẩm, `news` → trang tin tức, thiếu hoặc `home` → trang chủ, giá trị khác → báo lỗi 404. Mỗi trang là 1 file trong `controller/`. Trang product/news hiển thị số trang từ `?page=`.
**Đạt khi:** `?show=news&page=2` và `?page=2&show=news` cho cùng kết quả; `?show=person` trả 404; không có tham số không bị lỗi.

### TH 10-1 – Session (9')  → `th-10-1/`
**Đề:** `form.php` nhập tên → `result.php` lưu tên vào session và chào → `result2.php` đọc lại tên và có nút Đăng xuất → quay về form.
**Đạt khi:** chuyển trang vẫn nhớ tên; sau đăng xuất vào lại `result2.php` bị đẩy về form.
**Mở rộng:** lưu thêm `last_visit = time()` và hiển thị.

### TH 10-4 – API + HTTP code (7')  → `th-10-4/api.php`
**Đề:** `api.php?id=` trả JSON sản phẩm từ 1 mảng mẫu. Có id hợp lệ → 200; thiếu id → 400 `{"error":"Missing id"}`; id không tồn tại → 404 `{"error":"Not found"}`.
**Đạt khi:** cột Status trong DevTools (hoặc `curl -i`) hiện đúng 200 / 400 / 404.

### TH 11-2 – Upload ảnh (10')  → `th-11-2/`
**Đề:** `upload.php` (form) + `uploaded.php` (xử lý). Chỉ nhận jpg/jpeg/png/gif, tối đa 800KB, lưu vào `uploads/`; báo lỗi riêng cho từng trường hợp (chưa chọn file, sai định dạng, quá nặng, lưu thất bại); thành công thì hiển thị ảnh.
**Đạt khi:** thử đủ 4 lỗi + 1 thành công.
**Lỗi hay gặp:** thiếu `enctype="multipart/form-data"`; thư mục `uploads/` chưa có hoặc không có quyền ghi.

### TH 11-4 – Đọc/ghi file (8')  → `th-11-4/`
**Đề:** Viết `readTextFile($path)` và `addTextFile($text, $path)`. Trang demo có form nhập 1 dòng → ghi vào `data.txt` → hiển thị toàn bộ nội dung bên dưới.
**Đạt khi:** lưu 3 dòng liên tiếp, F5 vẫn thấy đủ 3 dòng (không bị mất khi dùng `'a'`).

## Bài về nhà

| Bài | Đề | Code mẫu |
|---|---|---|
| 10-3 | Mở rộng 10-2: thêm `&action=` (`list`, `detail&id=`), mỗi chức năng là 1 hàm trong controller | `bvn-10-3/` |
| 11-3 | Viết `download.php?file=` cho tải ảnh đã upload ở 11-2; chặn đường dẫn lạ | `bvn-11-3/` |
| 10-5 | Tạo DB + bảng `students`; viết `getConnection()`, `getStudents()`, `addStudent()` bằng PDO | `bvn-10-5/` (chạy `students.sql` trước, sửa `DB_PASS`) |
| 11-5 | Upload file csv (`name,email`) và import vào `students`, bỏ qua dòng sai/email trùng | `bvn-11-5/` (có `students.csv` mẫu) |

## Ghi chú cho giảng viên
- Code mẫu đã kiểm tra bằng `php -l` và chạy thử bằng `php -S` cho các lab tại lớp và 10-3. **10-5 và 11-5 chưa chạy thử vì cần MySQL.**
- Có chủ ý để lại điểm "bắt lỗi" khi dạy: `'w'` thay `'a'` (mất dữ liệu), thiếu `enctype`, `echo` trước `header()`/`session_start()`.
