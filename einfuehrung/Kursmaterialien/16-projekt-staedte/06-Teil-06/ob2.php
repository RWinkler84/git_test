<?php


header('Content-Type: text/plain');



ob_start();
for($x = 0; $x <= 10; $x++) {
    echo 'Hallo Welt';
    echo "\n";
    var_dump($x);
    ?>Hallo Welt!!!<?php
}
$contents = ob_get_contents();
ob_end_clean();
var_dump($contents);