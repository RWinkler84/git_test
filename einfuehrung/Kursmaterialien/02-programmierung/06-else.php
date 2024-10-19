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

$greeting = 'Hallo Welt.......';

if (strlen($greeting) < 15) {
    echo 'Greeting ist kürzer als 15 Zeichen';
}
else {
    echo 'Greeting ist länger gleich als 15 Zeichen';
}

echo "\n-----\n";

if (strlen($greeting) > 20) {
    echo 'Greeting ist länger als 20 Zeichen.';
}
else if (strlen($greeting) > 15) {
    echo 'Greeting ist länger als 15 Zeichen.';
}
else {
    echo 'Greeting ist kürzer oder gleich 15 Zeichen';
}


?></pre>
</body>
</html>