<?php
session_start();
// Đã có tên trong session thì cho đi tiếp luôn
if (isset($_SESSION['username'])) { header('Location: result2.php'); exit; }
?>
<form action="result.php" method="POST">
    Tên của bạn: <input type="text" name="username" required>
    <input type="submit" value="Gửi">
</form>
