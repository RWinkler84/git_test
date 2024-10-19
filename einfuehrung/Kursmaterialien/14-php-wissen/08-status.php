<?php

$id = (int) ($_GET['id'] ?? 0);

if ($id > 3) {
    http_response_code(404);
    echo 'Kein Eintrag gefunden...';
    die();
}

?><!DOCTYPE html>
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


?></pre>
</body></html>