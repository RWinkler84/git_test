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
    ['title' => 'Budapest', 'content' => 'Budapest ist die Hauptstadt von Ungarn.'],
    ['title' => 'Helsinki', 'content' => 'Helsinki ist die Hauptstadt von Finnland.'],
    ['title' => 'Stockholm', 'content' => 'Helsinki ist die Hauptstadt von Schweden.'],
];

// var_dump($a);
print_r($a);

?></pre>

<?php 
$firstEntry = $a[0];
var_dump($firstEntry['title']); 

var_dump($a[2]['title']);
?>
</body>
</html>