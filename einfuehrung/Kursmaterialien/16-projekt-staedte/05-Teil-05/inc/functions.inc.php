<?php

function generate_alphabet() {
    $chars = [];
    $ordZ = ord('Z');
    for ($x = ord('A'); $x <= $ordZ; $x++) {
        $chars[] = chr($x);
    }
    return $chars;
}

function render($path, array $data = []) {
    $alphabet = generate_alphabet();
    extract($data);
    require $path;
}

function e($html) {
    return htmlspecialchars($html, ENT_QUOTES, 'UTF-8', true);
}