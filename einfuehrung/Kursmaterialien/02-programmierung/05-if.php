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

if (strlen($greeting) < 15) {
    echo 'Die Bedingung war erfüllt.';
    var_dump($greeting);
}

if (strlen($greeting) < 15) var_dump($greeting);

if ($greeting === 'Hallo Welt') echo "Ja!\n";
if ($greeting !== 'Hallo Welt') echo "Nein!\n";

?></pre>
</body>
</html>