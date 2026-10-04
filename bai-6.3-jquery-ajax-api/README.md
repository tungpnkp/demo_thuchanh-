# Bài 6.3 - Thực hành với Ajax API

## Mục tiêu
Gọi API bằng jQuery Ajax để lấy dữ liệu (GET) và gửi dữ liệu (POST) mà **không tải lại trang**.

API sử dụng: [JSONPlaceholder](https://jsonplaceholder.typicode.com) - API giả lập miễn phí, không cần đăng ký.

| API | Phương thức | Ý nghĩa |
|---|---|---|
| `/users` | GET | Danh sách người dùng |
| `/posts?userId=1` | GET | Bài viết của người dùng có id = 1 |
| `/posts` | POST | Tạo bài viết mới (giả lập, không lưu thật) |

## Kiến thức sử dụng
- `$.ajax({ url, method, data, success, error })` - cách viết đầy đủ
- `$.getJSON(url, thamSo).done(...).fail(...)` - cách viết gọn cho GET
- `JSON.stringify()` - chuyển object thành chuỗi JSON để gửi đi
- `e.preventDefault()` - chặn form tải lại trang
- `$.each()` - duyệt mảng dữ liệu trả về để hiển thị
- Hiển thị trạng thái: đang tải / thành công / lỗi

## Cách chạy
Mở file `index.html` bằng trình duyệt (cần có mạng).

Mẹo: mở **DevTools (F12) > tab Network** để xem request/response khi bấm nút.

## Bài tập mở rộng
1. Thêm ô tìm kiếm, lọc người dùng theo tên ngay trên bảng.
2. Thêm nút "Xóa" cho bài viết, gọi API `DELETE /posts/{id}`.
3. Gọi API `/comments?postId={id}` để hiển thị bình luận khi bấm vào một bài viết.
