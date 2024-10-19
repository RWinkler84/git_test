<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./styles/simple.css">
    <title>PHP-Kurs</title>
<style>
.imageWrapper {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    margin: 0 auto;
    gap: 20px;
}

.imageContainer {
    border: solid 1px grey;
    border-radius: 10px;
    box-shadow: 5px 10px 10px lightgray;
    width: 30%;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    /* justify-content: flex-end; */
}
.imageDiv {
    display: flex;
    max-height: 180px;
    justify-content: center;
}

img {
    /* width: 300px; */
    height: 200px !important;
    max-width: unset !important;
}

.imageDescription {
    text-wrap: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 0.8em;
    font-weight: bold;
    padding: 5px 10px 0px 10px;

}
</style>

</head>
<body>
    <main>
        <?php
            include 'inc/data.php';
            include 'inc/functions.php';
        ?>
        <div class="imageWrapper">
            <?php  
            foreach ($images['titles'] as $key => $value): ?>
                <div class="imageContainer">
                <div class="imageDescription"><?php echo $value; ?></div>
                <div class="imageDiv">
                <a href="image.php?<?php echo 'image=' . urlencode($key) ?>"><img src="images/<?php echo urlencode($key); ?>"></a>
                </div>
                </div>
            <?php endforeach; ?>
        </div>

    </main>
</body>
</html>