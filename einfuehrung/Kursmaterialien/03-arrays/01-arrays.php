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

// $a = array('Max Mustermann', 'Erika Mustermann');
$a = ['Max Mustermann', 'Erika Mustermann'];

$a[] = 'Monika Mustermann';

$a[0] = 'Max Müller';

$a[10] = 'Alexander Mustermann';

var_dump($a);

?></pre>
</body>
</html>