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

$a = array(
    'apple' => 'Apfel',
    'orange' => 'Apfelsine',
);

// var_dump($a[0]);
var_dump($a['apple']);
var_dump($a);

var_dump(isset($a['apple']));
var_dump(!empty($a['orange']));

?></pre>
</body>
</html>