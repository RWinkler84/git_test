<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./styles/simple.css">
    <title>PHP-Kurs</title>
    <style>


    </style>
</head>

<body>
    <?php include 'inc/data.php';
        include 'inc/functions.php';
    ?>
    <main>
        <div class="imageWrapper">
            <?php
            if (empty($_GET) || !isset($images['descriptions'][$_GET['image']])): ?>
                <p>Hier gibt es nichts zu sehen...</p>
                <p><a href="index.php">Zurück zur Übersicht</a></p>

            <?php else: ?>
                <h1><?php echo e($images['titles'][$_GET['image']]); ?></h1>
                <p><?php echo e($images['descriptions'][$_GET['image']]) ?></p>
                <img alt="<?php echo e($images['descriptions'][$_GET['image']]) ?>" src="images/<?php echo $_GET['image']; ?>">
                <p><a href="index.php">Zurück zur Übersicht</a></p>
            <?php endif; ?>



        </div>
    </main>
</body>

</html>