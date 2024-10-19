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

$a = [
    'Max Mustermann', 
    'Erika Mustermann', 
    'Monika Mustermann', 
    'Alexander Mustermann'
];

echo count($a) . "\n";

$winner = rand(0, count($a) - 1);
var_dump($winner);
var_dump($a[$winner]);


?></pre>
</body>
</html>