<?php
function readTextFile(string $path): string {
    if (!file_exists($path)) return '';
    $file = fopen($path, 'r') or die("Unable to open file!");
    $data = '';
    while (!feof($file)) {          // đọc từng dòng, hợp cả file lớn
        $data .= fgets($file);
    }
    fclose($file);
    return $data;
}

function addTextFile(string $text, string $path): void {
    $file = fopen($path, 'a') or die("Unable to open file!");   // 'a' = ghi nối cuối, 'w' sẽ xóa sạch nội dung cũ
    fwrite($file, $text . PHP_EOL);
    fclose($file);
}
