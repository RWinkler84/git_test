<?php
header('Content-Type: text/plain');

function e($html) {
    return htmlspecialchars($html, ENT_QUOTES, 'UTF-8', true);
}

if (!function_exists('e')) {
    function e($html) {
        return htmlspecialchars($html, ENT_QUOTES, 'UTF-8', true);
    }
}

echo e('<h1>Hallo Welt</h1>');