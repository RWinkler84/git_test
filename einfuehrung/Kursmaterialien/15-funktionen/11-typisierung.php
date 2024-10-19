<?php
declare(strict_types=1);

header('Content-Type: text/plain');

function get_count(): int {
    return (int) '5';
}

$count = get_count();
var_dump($count + 1);

