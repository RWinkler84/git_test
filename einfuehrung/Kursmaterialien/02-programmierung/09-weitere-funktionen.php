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

$greeting = 'Hallo Welt';
unset($greeting);

if (isset($greeting)) {
    echo $greeting . "\n";
}

echo "\n------\n";

$pageTitle = 123;

if (!empty($pageTitle)) {
    echo ':::' . $pageTitle;
}

?></pre>
</body>
</html>