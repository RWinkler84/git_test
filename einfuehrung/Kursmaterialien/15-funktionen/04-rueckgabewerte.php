<?php
header('Content-Type: text/plain');


function add_five($number) {
    return $number + 5;
}

var_dump(add_five(4));

$z = add_five(3);
var_dump($z);

var_dump(add_five(1) * 2);

var_dump(add_five(add_five(3)));

function fetch_post() {
    return [
        'title' => 'Ich bin der Titel',
        'content' => 'Lorem Ipsum'
    ];
}

var_dump(fetch_post());