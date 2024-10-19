<?php
header('Content-Type: text/plain');

function get_count(): int {
    return ['5'];
}

$count = get_count();
var_dump($count + 1);