<?php

require_once __DIR__ . '/src/User/User.php';
require_once __DIR__ . '/src/Admin/User.php';

$u = new Admin\User();
$u->printName();

$u2 = new User\User();
$u2->printName();