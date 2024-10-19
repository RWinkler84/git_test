<?php

use Admin\User;
/*
function xyz($class) {
    if ($class === 'Admin\\User') {
        require_once __DIR__ . '/src/Admin/User.php';
    }
    var_dump($class);
}
spl_autoload_register('xyz');
*/

spl_autoload_register(function($class) {
    $file = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
    var_dump($class);
    var_dump($file);
    if (file_exists($file)) {
        require_once $file;
    }
});

$u = new User();
$u->printName();
