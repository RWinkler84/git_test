<?php
header('Content-Type: text/plain');

/*
function add_five(int|float $number) {
    return $number + 5;
}

var_dump(add_five(5));
*/

function print_5x(?string $str = null) {
    echo "{$str}\n";
    echo "{$str}\n";
    echo "{$str}\n";
    echo "{$str}\n";
    echo "{$str}\n";
}

print_5x();