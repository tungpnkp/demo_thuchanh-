<?php
// ===== 1. BIẾN VÀ KIỂU DỮ LIỆU =====
// Biến trong PHP bắt đầu bằng dấu $
$hoTen   = "Nguyễn Văn An";   // string (chuỗi)
$tuoi    = 20;                // int (số nguyên)
$diemTB  = 7.5;               // float (số thực)
$daTotNghiep = false;         // bool (đúng/sai)

// ===== 2. MẢNG =====
// Mảng thường (chỉ số 0, 1, 2...)
$monHoc = ["Toán", "Lý", "Hóa", "Tin học"];

// Mảng kết hợp (key => value)
$sinhVien = [
    ["ten" => "An",   "diem" => 8.5],
    ["ten" => "Bình", "diem" => 6.0],
    ["ten" => "Chi",  "diem" => 4.5],
    ["ten" => "Dũng", "diem" => 9.2],
];

// ===== 3. HÀM =====
function xepLoai($diem)
{
    if ($diem >= 8) {
        return "Giỏi";
    } elseif ($diem >= 6.5) {
        return "Khá";
    } elseif ($diem >= 5) {
        return "Trung bình";
    } else {
        return "Yếu";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PHP 01 - Cơ bản</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 40px auto; padding: 0 16px; }
        table { border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 12px; text-align: center; }
        th { background: #8892bf; color: #fff; }
        .cuu-chuong td { width: 70px; }
    </style>
</head>
<body>
    <h1>PHP cơ bản</h1>

    <!-- 1. In biến ra HTML -->
    <h2>1. Biến và echo</h2>
    <?php
    echo "<p>Xin chào, tôi là <b>$hoTen</b></p>";          // nháy kép: biến được thay giá trị
    echo '<p>Năm nay tôi ' . $tuoi . ' tuổi</p>';           // nối chuỗi bằng dấu chấm (.)
    echo "<p>Năm sinh: " . (date("Y") - $tuoi) . "</p>";         // tính toán trong biểu thức
    ?>
    <?php /* Cách viết tắt: <?= $bien ?> tương đương <?php echo $bien; ?> */ ?>
    <p>Điểm trung bình: <?= $diemTB ?></p>

    <!-- 2. Câu lệnh điều kiện -->
    <h2>2. Câu lệnh if / else</h2>
    <?php if ($tuoi >= 18): ?>
        <p><?= $hoTen ?> đã đủ 18 tuổi.</p>
    <?php else: ?>
        <p><?= $hoTen ?> chưa đủ 18 tuổi.</p>
    <?php endif; ?>
    <p>Trạng thái: <?= $daTotNghiep ? "Đã tốt nghiệp" : "Đang học" ?></p>

    <!-- 3. Vòng lặp foreach với mảng thường -->
    <h2>3. Vòng lặp foreach - Danh sách môn học</h2>
    <ul>
        <?php foreach ($monHoc as $mon): ?>
            <li><?= $mon ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Có tất cả <?= count($monHoc) ?> môn học.</p>

    <!-- 4. foreach với mảng kết hợp + gọi hàm -->
    <h2>4. Bảng điểm và xếp loại (foreach + hàm)</h2>
    <table>
        <tr><th>STT</th><th>Tên</th><th>Điểm</th><th>Xếp loại</th></tr>
        <?php
        $tongDiem = 0;
        foreach ($sinhVien as $i => $sv):
            $tongDiem += $sv["diem"];
        ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $sv["ten"] ?></td>
                <td><?= $sv["diem"] ?></td>
                <td><?= xepLoai($sv["diem"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>Điểm trung bình cả lớp: <b><?= round($tongDiem / count($sinhVien), 2) ?></b></p>

    <!-- 5. Vòng lặp for lồng nhau -->
    <h2>5. Vòng lặp for - Bảng cửu chương 2 đến 5</h2>
    <table class="cuu-chuong">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <tr>
                <?php for ($j = 2; $j <= 5; $j++): ?>
                    <td><?= "$j x $i = " . ($j * $i) ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
</body>
</html>
