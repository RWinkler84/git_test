<?php
/*
function iAmAFunction() {
    var_dump("Diese Funktion wurde ausgeführt...");
}


$s = 'iAmA' . 'Function';

$s();
$s();
*/

$s = function() {
    var_dump("Anonyme Funktion wurde ausgeführt...");
};

$s();

$variable2 = $s;


$variable2();