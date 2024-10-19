<?php

/*
if (file_exists(__DIR__ . '/b.php')) {
    include_once __DIR__ . '/b.php';
}
*/

require __DIR__ . '/b.php';
require_once __DIR__ . '/b.php';

var_dump('TEST...');


?>