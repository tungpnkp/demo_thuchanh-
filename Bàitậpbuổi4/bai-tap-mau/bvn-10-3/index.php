<?php
// BVN 10-3: ?show=product&action=list | detail&id=2
$show   = $_GET['show'] ?? 'product';
$action = $_GET['action'] ?? 'list';
$file   = __DIR__ . "/controller/$show.php";

if (!in_array($show, ['product', 'news'], true) || !file_exists($file)) {
    http_response_code(404); exit("Không có trang này");
}
require $file;

$fn = $show . '_' . $action;       // vd: product_detail
if (!function_exists($fn)) { http_response_code(404); exit("Không có chức năng này"); }
$fn();
