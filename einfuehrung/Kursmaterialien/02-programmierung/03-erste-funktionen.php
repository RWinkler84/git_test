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

// echo 'Hallo Welt';

var_dump('Hallo Welt');
var_dump(123);
var_dump(42.123);

$irgendeineVariable = 'Hallöchen!';
var_dump($irgendeineVariable . '!!');

var_dump(strlen('Hallo Welt'));

$len = strlen('Hallo Welt');
var_dump($len);

echo strlen('Hallo Welt') + 1;

?></pre>
</body>
</html>