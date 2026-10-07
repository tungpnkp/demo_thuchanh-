<?php

function sum($x, $sum = 0) {
    for($a = 1; $a <= $x ; $a++) {
        $sum += $a;
    }
    return $sum;
}

echo sum(-1, 10);
?>