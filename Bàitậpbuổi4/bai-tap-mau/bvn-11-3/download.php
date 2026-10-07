<?php
// BVN 11-3: tải file ảnh trong ../th-11-2/uploads/ — cách có kiểm soát: ?file=ten-anh.jpg
$dir  = realpath(__DIR__ . '/../th-11-2/uploads');
$name = basename($_GET['file'] ?? '');            // basename chặn ../ (path traversal)
$path = $dir . DIRECTORY_SEPARATOR . $name;

if ($name === '' || !is_file($path)) { http_response_code(404); exit("Không tìm thấy file"); }

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $name . '"');
header('Content-Length: ' . filesize($path));
readfile($path);
