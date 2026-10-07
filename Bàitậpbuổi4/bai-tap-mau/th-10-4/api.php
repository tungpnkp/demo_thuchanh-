<?php
// TH 10-4: API trả JSON + HTTP code đúng.  Thử: api.php?id=1  |  api.php  |  api.php?id=99
header('Content-Type: application/json; charset=utf-8');

$products = [
    1 => ['id' => 1, 'name' => 'Bàn phím cơ', 'price' => 850000],
    2 => ['id' => 2, 'name' => 'Chuột không dây', 'price' => 350000],
];

function respond(int $code, array $data): void {
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

if (!isset($_GET['id'])) {
    respond(400, ['error' => 'Missing id']);
}
$id = (int)$_GET['id'];
if (!isset($products[$id])) {
    respond(404, ['error' => 'Not found']);
}
respond(200, $products[$id]);
