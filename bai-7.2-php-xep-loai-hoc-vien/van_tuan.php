<?php
$name = "Nguyen Van An";
$diem = 4.5;


$ketQua = "Bạn đã đạt";
if ($diem >= 8) {
    $xepLoai = "Giỏi";
} elseif ($diem >= 6.5) {
    $xepLoai = "Khá";
} elseif ($diem >= 5) {
    $xepLoai = "Trung bình";
} else {
    $ketQua = "Bạn chưa đạt";
    $xepLoai = "Không đạt";
}

echo "Học viên: " . $name . "\n";
echo "Điểm: " . $diem . "\n";
echo "Xếp loại: " . $xepLoai . "\n";
echo "Kết quả: " . $ketQua . "\n";
?>