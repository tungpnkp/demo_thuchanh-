<?php
// BVN 11-5: upload file csv (name,email) rồi import vào bảng students
require __DIR__ . '/../bvn-10-5/db.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['csv'] ?? null;
    if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
        $message = 'Chưa chọn file hoặc upload lỗi';
    } elseif (strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) !== 'csv') {
        $message = 'Chỉ nhận file .csv';
    } else {
        $handle = fopen($file['tmp_name'], 'r');
        fgetcsv($handle);                      // bỏ dòng tiêu đề
        $ok = $skip = 0;
        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 2 || !filter_var($row[1], FILTER_VALIDATE_EMAIL)) { $skip++; continue; }
            addStudent(trim($row[0]), trim($row[1])) ? $ok++ : $skip++;   // email trùng cũng bị bỏ qua
        }
        fclose($handle);
        $message = "Đã thêm $ok dòng, bỏ qua $skip dòng";
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="csv" accept=".csv"> <input type="submit" value="Import">
</form>
<p><?= htmlspecialchars($message) ?></p>
<table border="1" cellpadding="4">
    <tr><th>ID</th><th>Tên</th><th>Email</th></tr>
    <?php foreach (getStudents() as $s): ?>
        <tr><td><?= $s['id'] ?></td><td><?= htmlspecialchars($s['name']) ?></td><td><?= htmlspecialchars($s['email']) ?></td></tr>
    <?php endforeach; ?>
</table>
