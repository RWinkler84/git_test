<?php
header('Content-Type: text/plain');

function add_five(int $number) {
    // Log-Eintrag in die Datenbank schreiben...
    return $number + 5;
}

// var_dump($_GET);


// var_dump(add_five($_GET['id']));

var_dump(add_five(5));
var_dump(add_five(5.4));
var_dump(add_five([4]));