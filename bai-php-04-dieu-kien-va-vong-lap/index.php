<?php
/*
 * BÀI LÀM MẪU - PHP 04: Câu lệnh điều kiện và vòng lặp
 * Thử đổi giá trị 3 biến dưới đây rồi tải lại trang để xem kết quả thay đổi.
 */
$n   = 15;
$nam = 2024;
$thu = 3;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PHP 04 - Điều kiện và vòng lặp</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 40px auto; padding: 0 16px; }
        h2 { border-bottom: 2px solid #8892bf; padding-bottom: 4px; }
        .chan { color: #27ae60; font-weight: bold; }
        .le { color: #e74c3c; font-weight: bold; }
        .fizz { color: #2980b9; }
        .buzz { color: #8e44ad; }
        .fizzbuzz { color: #d35400; font-weight: bold; }
        pre { background: #f4f4f4; padding: 12px; }
    </style>
</head>
<body>
    <h1>Điều kiện và vòng lặp</h1>

    <h2>Phần A - Câu lệnh điều kiện</h2>

    <!-- 1. if / else -->
    <h3>1. Chẵn hay lẻ</h3>
    <?php
    if ($n % 2 == 0) {          // chia 2 dư 0 => số chẵn
        echo "<p>$n là số chẵn</p>";
    } else {
        echo "<p>$n là số lẻ</p>";
    }
    ?>

    <!-- 2. if / else + toán tử logic && (và), || (hoặc) -->
    <h3>2. Năm nhuận</h3>
    <?php
    if ($nam % 400 == 0 || ($nam % 4 == 0 && $nam % 100 != 0)) {
        echo "<p>$nam là năm nhuận (tháng 2 có 29 ngày)</p>";
    } else {
        echo "<p>$nam không phải năm nhuận (tháng 2 có 28 ngày)</p>";
    }
    ?>

    <!-- 3. switch / case -->
    <h3>3. Tên thứ trong tuần</h3>
    <?php
    switch ($thu) {
        case 1: $tenThu = "Thứ Hai"; break;   // break: thoát khỏi switch
        case 2: $tenThu = "Thứ Ba"; break;
        case 3: $tenThu = "Thứ Tư"; break;
        case 4: $tenThu = "Thứ Năm"; break;
        case 5: $tenThu = "Thứ Sáu"; break;
        case 6: $tenThu = "Thứ Bảy"; break;
        case 7: $tenThu = "Chủ nhật"; break;
        default: $tenThu = "Không hợp lệ";    // không khớp case nào
    }
    echo "<p>Thứ $thu là: <b>$tenThu</b></p>";
    ?>

    <h2>Phần B - Vòng lặp</h2>

    <!-- 4. for + if bên trong vòng lặp -->
    <h3>4. Các số từ 1 đến <?= $n ?></h3>
    <p>
        <?php
        for ($i = 1; $i <= $n; $i++) {
            $class = ($i % 2 == 0) ? "chan" : "le";
            echo "<span class='$class'>$i</span> ";
        }
        ?>
    </p>

    <!-- 5. for: cộng dồn -->
    <h3>5. Tổng từ 1 đến <?= $n ?></h3>
    <?php
    $tong = 0;
    for ($i = 1; $i <= $n; $i++) {
        $tong += $i;            // viết tắt của: $tong = $tong + $i;
    }
    echo "<p>1 + 2 + ... + $n = <b>$tong</b></p>";
    ?>

    <!-- 6. while: lặp khi điều kiện còn đúng -->
    <h3>6. Giai thừa <?= $n ?>!</h3>
    <?php
    $giaiThua = 1;
    $i = 1;
    while ($i <= $n) {
        $giaiThua *= $i;        // $giaiThua = $giaiThua * $i;
        $i++;                   // QUAN TRỌNG: quên dòng này sẽ bị lặp vô hạn
    }
    echo "<p>$n! = <b>" . number_format($giaiThua, 0, ",", ".") . "</b></p>";
    ?>

    <!-- 7. FizzBuzz: for + if / elseif / else -->
    <h3>7. FizzBuzz từ 1 đến 30</h3>
    <p>
        <?php
        for ($i = 1; $i <= 30; $i++) {
            // Phải kiểm tra "chia hết cho cả 3 và 5" TRƯỚC, nếu không sẽ không bao giờ in FizzBuzz
            if ($i % 3 == 0 && $i % 5 == 0) {
                echo "<span class='fizzbuzz'>FizzBuzz</span> ";
            } elseif ($i % 3 == 0) {
                echo "<span class='fizz'>Fizz</span> ";
            } elseif ($i % 5 == 0) {
                echo "<span class='buzz'>Buzz</span> ";
            } else {
                echo "$i ";
            }
        }
        ?>
    </p>

    <!-- 8. Vòng lặp lồng nhau -->
    <h3>8. Tam giác sao</h3>
    <pre><?php
for ($dong = 1; $dong <= 5; $dong++) {        // vòng ngoài: chạy qua từng dòng
    for ($cot = 1; $cot <= $dong; $cot++) {   // vòng trong: dòng thứ k in k dấu sao
        echo "* ";
    }
    echo "\n";                                 // xuống dòng
}
?></pre>
</body>
</html>
