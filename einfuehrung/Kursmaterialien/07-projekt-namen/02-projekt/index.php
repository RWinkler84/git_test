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
<?php
include 'inc/names.php';

$firstLetters = [];
foreach($names AS $nameArray) {
    $nameFirstLetter = $nameArray['name'][0];

    if(empty($firstLetters[$nameFirstLetter])) {
        $firstLetters[$nameFirstLetter] = true;
    }
}

var_dump($firstLetters);
?>
<p>
    <?php foreach($firstLetters AS $firstLetter => $_): ?>
        <a href="index.php?char=<?php echo $firstLetter; ?>"><?php echo $firstLetter; ?></a>
    <?php endforeach; ?>
</p>
</body>
</html>