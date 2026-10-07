<?php
function product_list() {
    echo "<h1>Danh sách sản phẩm</h1><a href='?show=product&action=detail&id=2'>Xem sản phẩm 2</a>";
}
function product_detail() {
    $id = (int)($_GET['id'] ?? 0);
    if ($id <= 0) { http_response_code(400); exit("Thiếu id"); }
    echo "<h1>Chi tiết sản phẩm #$id</h1><a href='?show=product&action=list'>Quay lại</a>";
}
