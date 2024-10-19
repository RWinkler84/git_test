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

for ($x = 0; $x <= 5; $x++) {
    var_dump($x);
}

echo "----\n";

// for ($y = 0; $y <= 10; $y = $y + 2) {
for ($y = 0; $y <= 10; $y+=2) {
    if ($y === 4) {
        continue;
    }
    var_dump($y);
}

echo "----\n";

for ($x = 10; $x > 0; $x--) {
    var_dump($x);
}


?>
</pre>
</body>
</html>