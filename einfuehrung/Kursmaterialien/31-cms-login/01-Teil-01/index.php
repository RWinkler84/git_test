<?php

$password = md5('top-secret');

var_dump($password);

$input = 'top-secret';

if (md5($input) === $password) {
    var_dump("Login OKAY!");
}