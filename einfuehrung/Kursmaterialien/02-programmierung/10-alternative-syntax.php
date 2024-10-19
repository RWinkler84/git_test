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

$pageTitle = 'Urlaubsberichte';
$bgColor = 'green';
?>
<p>Lorem Ipsum...</p>

<?php if (!empty($pageTitle)) { ?>
    <h2><?php echo $pageTitle; ?></h2>
<?php } ?>

<?php if (!empty($pageTitle)): ?>
    <h2><?php echo $pageTitle; ?></h2>
<?php else: ?>
    <h2>Keine Überschrift definiert</h2>
<?php endif; ?>


</body>
</html>