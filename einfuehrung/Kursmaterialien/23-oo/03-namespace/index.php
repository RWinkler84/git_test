<?php

use Admin\User;

require_once __DIR__ . '/src/User/User.php';
require_once __DIR__ . '/src/Admin/User.php';
require_once __DIR__ . '/src/Admin/Role.php';

$u = new User();
$u->printName();
