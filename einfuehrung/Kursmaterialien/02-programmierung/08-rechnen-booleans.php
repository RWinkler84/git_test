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
$b = false;

// Boolean umdrehen:
var_dump(!$a);
var_dump(!$b);
echo "\n-----\n";

// Logisches Und:
var_dump($a AND $b);
var_dump($a && $b);

// Logisches Oder:
var_dump($a OR $b);
var_dump($a || $b);

// Logisches entweder-oder:
var_dump($a XOR $b);


echo "-----\n";

$age = 19;
$agb = true;

if ($age >= 18 && $agb) {
    echo 'Bestellung okay...';
}
else {
    echo 'Bestellung: Fehler aufgetreten';
}

?></pre>
</body>
</html>