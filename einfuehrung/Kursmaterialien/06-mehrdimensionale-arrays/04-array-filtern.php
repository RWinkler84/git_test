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

var_dump('Berlin'[-1]);

$arr = [
    'Budapest',
    'Berlin',
    'Sofia',
    'Athen',
    'Madrid'
];

var_dump($arr[1][0]);
?></pre>
<ul>
    <?php foreach ($arr AS $city): ?>
        <?php if($city[0] === 'B'): ?>
            <li><?php echo $city; ?></li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>

<?php

$filtered = [];
foreach($arr AS $city) {
    if ($city[0] === 'B') {
        $filtered[] = $city;
    }
}
var_dump($filtered);
?>

<?php if(!empty($filtered)): ?>
    <ul>
        <?php foreach($filtered AS $city): ?>
            <li><?php echo $city; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
</body>
</html>