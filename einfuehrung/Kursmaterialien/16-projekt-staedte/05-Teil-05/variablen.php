<?php

header("Content-Type: text/plain");

/*
$varName = 'xyz';
${$varName} = 'Hallo Welt';
var_dump($xyz);
*/

$array = [
    'xyz' => 'Hallo Welt'
];

/*
foreach($array AS $key => $value) {
    ${$key} = $value;
}
*/
extract($array);

var_dump($xyz);