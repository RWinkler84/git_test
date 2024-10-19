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
    <main>
<?php
include './inc/data.php';
include './inc/functions.php';
?>

        <?php foreach($imageTitles AS $imageSrc => $imageTitle): ?>
            <a href="image.php?<?php echo http_build_query(['image' => $imageSrc]); ?>">
                <h4><?php echo e($imageTitle); ?></h4>
                <img src="images/<?php echo urlencode($imageSrc); ?>" alt="<?php echo e($imageTitle); ?>" />
            </a>
        <?php endforeach; ?>
    </main>
</body>
</html>