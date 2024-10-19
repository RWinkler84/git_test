<?php
header('Content-Type: text/plain');

/*
function f() {
    return 'Hallo Welt';
    var_dump('TEST');
    die();
    return 'Hallo Mars';
}

var_dump(f());
*/

function f2($number) {
    if ($number === 2) {
        return 0;
    }
    return $number;
}
var_dump(f2(2));
var_dump(f2(3));