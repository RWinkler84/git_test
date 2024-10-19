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

// echo $a = 'Hallo Welt';

$handle = opendir(__DIR__ . '/img');
$filenames = [];
while (($filename = readdir($handle)) !== false) {
    if (str_starts_with($filename, '.')) continue;
    if (!str_ends_with($filename, '.jpg')) continue;
    $filenames[] = $filename;
}
closedir($handle);


?></pre>
<main>
    <?php foreach($filenames AS $currentImage): ?>
        <img src="img/<?php echo $currentImage; ?>" alt="" />
    <?php endforeach; ?>
</main>
</body>
</html>