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

<form action="index.php" method="GET">
    <label for="city">Bitte wählen Sie die Stadt aus:</label>
    <br />
    <select name="city" id="city">
        <option value="budapest" <?php if(!empty($_GET['city']) && $_GET['city'] === 'budapest') echo 'selected'; ?>>Budapest (Ungarn)</option>
        <option value="helsinki" <?php if(!empty($_GET['city']) && $_GET['city'] === 'helsinki') echo 'selected'; ?>>Helsinki (Finnland)</option>
        <option value="london" <?php if(!empty($_GET['city']) && $_GET['city'] === 'london') echo 'selected'; ?>>London (United Kingdom)</option>
    </select>
    <input type="submit" value="Abschicken!" />
</form>

<hr />

<?php

if (!empty($_GET['city'])) {
    // include "texts/{$_GET['city']}.html";
    echo file_get_contents("texts/{$_GET['city']}.html");
}

?>

</body>
</html>