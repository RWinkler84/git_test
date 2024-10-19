<?php
header('Content-Type: text/plain');


function f($str) {    
    var_dump($str);
    var_dump($str);
    var_dump($str);
}

f('Hallo Mars' . '!');

echo "-----\n";

$greeting = 'Hallo Tesla!';
f($greeting);

