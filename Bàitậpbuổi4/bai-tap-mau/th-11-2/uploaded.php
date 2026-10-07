<?php
// TH 11-2: nhận ảnh, kiểm tra (có file? đúng định dạng? đủ nhẹ?) rồi lưu vào uploads/
$targetDir = __DIR__ . '/uploads/';
$maxSize   = 800000;                    // ~800KB
$allowed   = ['jpg', 'jpeg', 'png', 'gif'];

$file = $_FILES['image-file'] ?? null;

// A. Có chọn file chưa?
if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) { exit("Bạn chưa chọn file"); }
if ($file['error'] !== UPLOAD_ERR_OK)               { exit("Upload lỗi (mã {$file['error']}), file có thể vượt giới hạn php.ini"); }

// B. Đúng định dạng ảnh? (kiểm tra đuôi + nội dung thật)
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($ext, $allowed, true) || getimagesize($file['tmp_name']) === false) {
    exit("Chỉ cho phép ảnh jpg, jpeg, png, gif");
}

// C. Dung lượng
if ($file['size'] > $maxSize) { exit("File quá lớn (tối đa 800KB)"); }

// D. Lưu: đặt tên ngẫu nhiên để không trùng/ghi đè và tránh tên file nguy hiểm
$newName = uniqid('img_', true) . '.' . $ext;
if (move_uploaded_file($file['tmp_name'], $targetDir . $newName)) {
    echo "Upload thành công: " . htmlspecialchars(basename($file['name'])) . "<br>";
    echo "<img src='uploads/$newName' width='300'>";
} else {
    echo "Lưu file thất bại (kiểm tra quyền ghi thư mục uploads/)";
}
