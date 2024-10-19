<?php

$password = password_hash('top-secret', PASSWORD_DEFAULT);

$input = 'top-secret...';


var_dump($password);
var_dump(password_verify($input, $password));