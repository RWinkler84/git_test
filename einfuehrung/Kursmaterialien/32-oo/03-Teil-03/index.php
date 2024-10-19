<?php

function e($html) {
    return htmlspecialchars($html, ENT_QUOTES, 'UTF-8', true);
}


// var_dump(htmlspecialchars('<p class="test">Absatz!</p>', ENT_QUOTES, 'UTF-8', true));

// var_dump(ENT_QUOTES);

// define('TEST', 5);
// var_dump(TEST);

define('APP_PATH', __DIR__);
define('PUBLIC_PATH', __DIR__ . '/public');
