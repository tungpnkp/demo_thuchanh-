<?php
session_start();
if (!isset($_SESSION['username'])) { header('Location: form.php'); exit; }
?>
Hello again, <?= htmlspecialchars($_SESSION['username']) ?>
<p><a href="logout.php">Đăng xuất</a></p>
