<?php
require __DIR__ . '/functions.php';
$path = __DIR__ . '/data.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && trim($_POST['line'] ?? '') !== '') {
    addTextFile(trim($_POST['line']), $path);
    header('Location: index.php');   // tránh submit lại khi F5
    exit;
}
?>
<form method="POST">
    <input type="text" name="line" placeholder="Nhập 1 dòng">
    <input type="submit" value="Lưu">
</form>
<h3>Nội dung data.txt</h3>
<pre><?= htmlspecialchars(readTextFile($path)) ?></pre>
