<?php
/*
 * BÀI 7.2 - Đánh giá kết quả học viên
 * Kiến thức: if / elseif / else, toán tử so sánh
 * Chạy: php index.php
 */

$name  = "Nguyen Van An";
$score = 7.5;

// Xếp loại: kiểm tra từ điểm CAO xuống THẤP
if ($score >= 8) {
    $rank = "Giỏi";
} elseif ($score >= 6.5) {      // đến đây nghĩa là $score < 8
    $rank = "Khá";
} elseif ($score >= 5) {        // đến đây nghĩa là $score < 6.5
    $rank = "Trung bình";
} else {
    $rank = "Không đạt";
}

// Thông báo kết quả
if ($score >= 5) {
    $result = "Bạn đã đạt";
} else {
    $result = "Bạn chưa đạt";
}

// In kết quả ra terminal
echo "Học viên: $name\n";       // trong chuỗi nháy kép, biến được thay bằng giá trị
echo "Điểm: $score\n";
echo "Xếp loại: $rank\n";
echo "Kết quả: $result\n";
