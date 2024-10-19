<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./styles/simple.css">
    <title>PHP-Kurs</title>
</head>
<body>
<pre><?php

$arr = [
    'Hallo Welt',
    'Hallo Welt',
];

var_dump(is_array($arr));
var_dump(is_string($arr));
var_dump(is_string($arr[0]));

var_dump(array_unique($arr));

?></pre></body></html>