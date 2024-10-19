<?php
header('Content-Type: text/plain');


function f($str, $count = 4) {
    for ($x = 0; $x < $count; $x++) {
        var_dump($str);
    }
}

$z = 'Hallo Welt!';
f($z, 3);

echo "----\n";

f('Hallo Mars!', 5);

echo "----\n";

f('Hallo Venus');
