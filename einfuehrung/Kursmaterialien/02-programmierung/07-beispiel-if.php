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

$agb = true;
$age = 25;

if ($agb) {
    if ($age >= 18) {
        echo 'Bestellung okay!';
    }
    else {
        echo 'Bestellung wurde verweigert: Sie sind zu jung.';
    }
}
else {
    echo 'Bestellung wurde verweigert: AGB nicht akzeptiert';
}

echo "\n-----\n";

if ($agb === false) { // !$agb
    echo 'Bestellung wurde verweigert: AGB nicht akzeptiert';
}
else if ($age < 18) {
    echo 'Bestellung wurde verweigert: Sie sind zu jung.';
}
else {
    echo 'Bestellung okay!';
}



?></pre>
</body>
</html>