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
$a = [1, 2, 3, 4, 5, 6, 7];

$sum = 0;
foreach($a AS $value) {
    $sum = $sum + $value;
}
var_dump($sum);
*/

$a = [
    [1, 2, 3, 4],
    [7, 8, 9, 10]
];

$sum = 0;
foreach($a AS $b) {
    foreach($b AS $value) {
        $sum = $sum + $value;
    }
}
var_dump($sum);

?></pre>
</body>
</html>