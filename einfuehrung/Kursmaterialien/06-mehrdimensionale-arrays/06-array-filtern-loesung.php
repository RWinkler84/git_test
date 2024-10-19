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
    ['title' => 'Budapest'],
    ['title' => 'Berlin'],
    ['title' => 'Sofia'],
    ['title' => 'Athen'],
    ['title' => 'Madrid']
];

$filtered = [];
foreach($arr AS $value) {
    if ($value['title'][0] === 'B') {
        $filtered[] = $value;
    }
}

print_r($filtered);
?></pre>

<?php if(!empty($filtered)): ?>
    <ul>
        <?php foreach($filtered AS $value): ?>
            <li>
                <?php echo $value['title']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
</body>
</html>