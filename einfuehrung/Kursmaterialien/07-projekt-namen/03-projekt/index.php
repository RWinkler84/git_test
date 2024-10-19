<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./styles/simple.css">
    <link rel="stylesheet" type="text/css" href="./styles/custom.css">
    <title>PHP-Kurs</title>
</head>
<body>
    <header>
        <h1>Geburtsstatistiken</h1>
        <p>Hier finden Sie die Geburtsstatistiken aus Amerika</p>
    </header>
<?php
include 'inc/names.php';

$firstLetters = [];
foreach($names AS $nameArray) {
    $nameFirstLetter = $nameArray['name'][0];

    if(empty($firstLetters[$nameFirstLetter])) {
        $firstLetters[$nameFirstLetter] = true;
    }
}
?>
<nav class="nav">
    <?php foreach($firstLetters AS $firstLetter => $_): ?>
        <a 
            href="index.php?char=<?php echo $firstLetter; ?>"
            <?php if(!empty($_GET['char']) && $_GET['char'] === $firstLetter):?>
                class="selected"
            <?php endif; ?>
        ><?php echo $firstLetter; ?></a>
    <?php endforeach; ?>
</nav>
</body>
</html>