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

$a = [
    'Max Mustermann', 
    'Erika Mustermann', 
    'Monika Mustermann', 
    'Alexander Mustermann'
];

foreach ($a AS $student) {
    if ($student === 'Max Mustermann') continue;
    if ($student === 'Erika Mustermann') continue;

    var_dump($student);

    /*
    if ($student !== 'Erika Mustermann' && $student !== 'Max Mustermann') {
        var_dump($student);
    }
    */
}

$counter = 0;
foreach ($a AS $student) {
    $counter++;
    var_dump($student);

    if ($counter >= 3) break;
    // if ($student === 'Monika Mustermann') break;
}

?></pre>

<?php foreach($a AS $student): ?>
    <p><?php echo $student; ?></p>
<?php endforeach; ?>

</body>
</html>