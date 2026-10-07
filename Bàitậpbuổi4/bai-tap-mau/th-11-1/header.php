<?php
// TH 11-1: gắn header vào response. Header PHẢI nằm trước mọi output.
header('X-Author: ten-ban');
header('Content-Type: text/plain; charset=utf-8');

// Bỏ comment dòng dưới để thử chuyển hướng:
// header('Location: https://example.com'); exit;

echo "Xin chào! Mở DevTools > Network > header.php > Response Headers để thấy X-Author.";
