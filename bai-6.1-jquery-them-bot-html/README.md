# Bài 6.1 - Áp dụng jQuery để thêm/bớt thông tin HTML

## Mục tiêu
Quản lý danh sách sinh viên: thêm, xóa phần tử HTML bằng jQuery.

## Kiến thức sử dụng
| Hàm jQuery | Tác dụng |
|---|---|
| `$('<li></li>')` | Tạo thẻ HTML mới |
| `.append()` | Thêm vào cuối phần tử |
| `.prepend()` | Thêm vào đầu phần tử |
| `.remove()` | Xóa chính phần tử đó |
| `.empty()` | Xóa toàn bộ nội dung bên trong |
| `.text()` / `.val()` | Đọc/ghi nội dung chữ / giá trị input |
| `.on('click', '.con', ...)` | Bắt sự kiện cho phần tử được tạo sau |

## Cách chạy
Mở file `index.html` bằng trình duyệt (cần có mạng để tải jQuery từ CDN).

## Bài tập mở rộng
1. Thêm nút "Sửa" cho mỗi sinh viên (dùng `prompt()` và `.text()`).
2. Không cho thêm tên trùng với tên đã có trong danh sách.
3. Dùng `.before()` / `.after()` để chèn sinh viên trước/sau một người được chọn.
