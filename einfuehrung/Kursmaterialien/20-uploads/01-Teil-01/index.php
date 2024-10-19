<pre><?php

var_dump($_POST);
echo '<strong>$_FILES:</strong><br />';
var_dump($_FILES);

if (!empty($_FILES['image'])) {
    $tmpName = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmpName, __DIR__ . '/test.jpg');
    @chmod(__DIR__ . '/test.jpg', 0777);
    var_dump("Es wurde eine Datei übertragen.");
}

?></pre>

<form action="index.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" /><br />
    <input type="file" name="image" />
    <input type="submit" value="Abschicken!" />
</form>