<?php
session_start();   // luôn ở đầu trang, trước mọi output

if (!empty($_POST['username'])) {
    $_SESSION['username'] = trim($_POST['username']);   // chỉ lưu tên, KHÔNG lưu mật khẩu
}
if (!isset($_SESSION['username'])) { header('Location: form.php'); exit; }
?>
Hello, <?= htmlspecialchars($_SESSION['username']) ?>
<p><a href="result2.php">Sang trang 2</a></p>
