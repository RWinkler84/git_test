<?php

$products = ['Orange', 'Notizblock', 'Käse!!!'];

/*
$s = '';
foreach($products AS $product) {
    $s = $s . $product . ', ';
}
var_dump($s);
*/

// var_dump(implode(', ', $products));


$str = 'Lorem Ipsum, Hallo Welt';
var_dump(explode(', ', $str));