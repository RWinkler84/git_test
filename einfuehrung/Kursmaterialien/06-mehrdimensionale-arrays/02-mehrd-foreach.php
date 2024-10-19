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

$arr = [
    ['title' => 'Budapest', 'content' => 'Budapest ist die Hauptstadt von Ungarn.'],
    ['title' => 'Helsinki', 'content' => 'Helsinki ist die Hauptstadt von Finnland.'],
    ['title' => 'Stockholm', 'content' => 'Helsinki ist die Hauptstadt von Schweden.'],
];

print_r($arr);

foreach ($arr AS $key => $value) {
    print_r($value);
}

var_dump($arr[2]['title']);

?></pre>

<?php foreach($arr AS $value): ?>
    <h3><?php echo $value['title']; ?></h3>
    <p><?php echo $value['content']; ?></p>
<?php endforeach; ?>

</body>
</html>