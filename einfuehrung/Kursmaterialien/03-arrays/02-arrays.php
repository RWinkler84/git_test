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

var_dump($a);
// var_dump($a[3]);

var_dump(in_array('Max', $a));

if (in_array('Max Mustermann', $a)) {
    echo "Max Mustermann ist im Array enthalten. \n";
}

if (in_array('Max Müller', $a)) {
    echo "Max Müller ist im Array enthalten. \n";
}

?></pre>
</body>
</html>