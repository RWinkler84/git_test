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
$handle = opendir(__DIR__ . '/img');

$filename1 = readdir($handle);
var_dump($filename1);

$filename2 = readdir($handle);
var_dump($filename2);

$filename3 = readdir($handle);
var_dump($filename3);

$filename4 = readdir($handle);
var_dump($filename4);

$filename5 = readdir($handle);
var_dump($filename5);

$filename6 = readdir($handle);
var_dump($filename6);
*/

$handle = opendir(__DIR__ . '/img');

while (true) {
    $filename = readdir($handle);
    if ($filename === false) break;
    if (str_starts_with($filename, '.')) continue;
    var_dump($filename);
}

?></pre>
</body>
</html>