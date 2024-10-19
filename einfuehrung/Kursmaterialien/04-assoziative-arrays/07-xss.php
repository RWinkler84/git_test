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

function e($html) {
    return htmlspecialchars($html, ENT_QUOTES, 'UTF-8', true);
}

?></pre>
<h1><?php echo e($_GET['name']); ?></h1>

<form action="07-xss.php" method="GET">
    <input type="text" name="name" value="<?php echo e($_GET['name']); ?>" />
    <input type="submit" value="Abschicken!" />
</form>

</body>
</html>