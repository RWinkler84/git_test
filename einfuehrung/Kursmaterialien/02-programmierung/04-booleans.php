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

$a = true;
// echo $a . "\n";
var_dump($a);

$b = false;
var_dump($b);

var_dump(12 < 15);
var_dump(12 > 15);
var_dump(12 <= 15);
var_dump(12 >= 15);

$w = 'Welt';
var_dump(('Hallo' . ' ' . $w) === "Hallo Welt");

$ergebnis = 10 + 2;
var_dump($ergebnis === 12);

var_dump(12 !== 12);

?></pre>
</body>
</html>