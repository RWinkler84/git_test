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

var_dump($_GET);

$query = http_build_query(['name' => 'Max & Moritz!']);
?></pre>

<a href="04-http-build-query.php?<?php echo $query; ?>">Link zu Max und Moritz!</a>
</body>
</html>