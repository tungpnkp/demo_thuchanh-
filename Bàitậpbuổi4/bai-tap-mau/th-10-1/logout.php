<?php
session_start();
session_unset();     // xóa các biến session
session_destroy();   // hủy session trên server
header('Location: form.php');
exit;
