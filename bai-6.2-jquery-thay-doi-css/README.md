# Bài 6.2 - Áp dụng jQuery để thay đổi CSS

## Mục tiêu
Thay đổi giao diện (màu nền, cỡ chữ, bo góc, chế độ tối...) của phần tử bằng jQuery.

## Kiến thức sử dụng
| Cú pháp | Tác dụng |
|---|---|
| `.css('color', 'red')` | Đặt 1 thuộc tính CSS |
| `.css('font-size')` | Đọc giá trị CSS hiện tại |
| `.css({ color: 'red', ... })` | Đặt nhiều thuộc tính cùng lúc |
| `.css('color', '')` | Bỏ style đã đặt, quay về CSS gốc |
| `.addClass()` / `.removeClass()` | Thêm / bớt class |
| `.toggleClass()` | Có class thì bỏ, chưa có thì thêm |
| `.data('mau')` | Đọc thuộc tính `data-mau` |

## Cách chạy
Mở file `index.html` bằng trình duyệt (cần có mạng để tải jQuery từ CDN).

## Bài tập mở rộng
1. Thêm nút đổi màu chữ và đổi font chữ.
2. Khi rê chuột vào hộp (`hover`) thì phóng to hộp, rời chuột thì trở lại.
3. Bấm vào từng dòng của một bảng để tô màu dòng đó (dùng `toggleClass`).
