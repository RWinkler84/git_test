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

/*
if (isset($_GET['page'])) {
    $page = @(int) $_GET['page'];
}
else {
    $page = 1;
}
var_dump($page);
*/

$page = @isset($_GET['page']) ? (int) $_GET['page'] : 1;
var_dump($page);

var_dump(isset($_GET['page']) ? 'Page ist gesetzt' : 'Page ist nicht gesetzt');
var_dump((isset($_GET['page']) ? 'Page ist gesetzt' : 'Page ist nicht gesetzt') . '!');

?></pre></body></html>