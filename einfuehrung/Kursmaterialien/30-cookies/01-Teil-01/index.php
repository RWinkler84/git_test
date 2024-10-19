<?php
/*
$d = [
    '20.12.2050',
    '19.12.2060'
];
sort($d);
var_dump($d);
*/
/*
$d = [
    '2050-12-20',
    '2060-12-19'
];
sort($d);
var_dump($d);
*/

// $d = time();
// var_dump($d);

$d = mktime(12, 4, 5, 12, 20, 2050);
var_dump($d);

var_dump(date('Y-m-d', $d));