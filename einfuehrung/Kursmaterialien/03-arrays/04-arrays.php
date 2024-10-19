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
    '', 
    'Erika Mustermann', 
    'Monika Mustermann', 
    'Alexander Mustermann'
];

var_dump(empty($a));
var_dump(empty($a[0]));

var_dump(isset($a[0]));

unset($a[0]);

var_dump($a);

?></pre>

<pre><?php

$b = [
    'Orange',
    'Orange',
    'Apfel',
    'Banane',
    'Apfel',
    'Yoghurt'
];
var_dump(array_unique($b));

sort($b);

var_dump($b);


?></pre>

</body>
</html>