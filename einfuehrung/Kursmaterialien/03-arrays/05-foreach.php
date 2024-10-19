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
    var_dump($student);
}

?></pre>

<?php foreach($a AS $student): ?>
    <p><?php echo $student; ?></p>
<?php endforeach; ?>

</body>
</html>