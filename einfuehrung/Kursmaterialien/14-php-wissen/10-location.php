<?php

if (isset($_GET['page']) && $_GET['page'] === '1') {
    http_response_code(301);
    header('Location: 10-location.php');
    die();
}

$page = (int) ($_GET['page'] ?? 1);


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

var_dump($page);

?></pre>
</body></html>