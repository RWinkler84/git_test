<pre><?php
/*
var_dump(microtime(true));
var_dump(uniqid('', true));
var_dump(rand(0, 1000000000));
die();
*/

require_once __DIR__ . '/functions.inc.php';

var_dump($_POST);
echo '<strong>$_FILES:</strong><br />';
var_dump($_FILES);


if (
    !empty($_FILES['image']) && 
    $_FILES['image']['error'] === UPLOAD_ERR_OK && 
    $_FILES['image']['type'] === 'image/jpeg') {

    $uploadedImage = $_FILES['image']['tmp_name'];
    if (!is_uploaded_file($uploadedImage)) die();

    $toImage = __DIR__ . '/uploads/' . uniqid('', true) . '.jpg';
    $resizeOk = resizeImage($uploadedImage, $toImage);
    if ($resizeOk) {
        @chmod($toImage, 0777);
    }
    else {
        echo "Es ist beim Upload ein Fehler aufgetreten";
    }
}

?></pre>

<form action="index.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" /><br />
    <input type="file" name="image" />
    <input type="submit" value="Abschicken!" />
</form>