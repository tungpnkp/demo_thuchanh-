# Bài 6.4 - Dùng jQuery chọn ngẫu nhiên 1 học sinh

## Mục tiêu
Hiển thị danh sách lớp và bấm nút để gọi tên ngẫu nhiên 1 học sinh.

## Kiến thức sử dụng
| Hàm | Tác dụng |
|---|---|
| `$.each()` | Duyệt mảng danh sách học sinh |
| `.append()` | Thêm từng dòng vào bảng |
| `Math.floor(Math.random() * n)` | Lấy số ngẫu nhiên từ 0 đến n - 1 |
| `.html()` | Ghi tên học sinh được chọn |
| `.eq(i)` | Lấy dòng thứ i trong bảng |
| `.addClass()` / `.removeClass()` | Tô màu / bỏ tô màu dòng được chọn |
| `.prop('disabled', ...)` | Khóa / mở khóa nút |
| `.fadeIn()` | Hiệu ứng hiện dần |
| `setInterval()` / `setTimeout()` | Tạo hiệu ứng "quay" tên trong 2 giây |

## Cách chạy
Mở file `index.html` bằng trình duyệt (cần có mạng để tải jQuery từ CDN).

## Bài tập mở rộng
1. Không gọi lại học sinh đã được gọi (xóa khỏi mảng sau khi chọn).
2. Hiển thị lịch sử các bạn đã được gọi bên dưới.
3. Thêm ô nhập để chọn ngẫu nhiên nhiều học sinh cùng lúc (ví dụ chia nhóm).
