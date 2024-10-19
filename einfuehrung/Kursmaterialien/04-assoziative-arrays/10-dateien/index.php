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
$cities = [
    'budapest' => 'Budapest (Ungarn)',
    'helsinki' => 'Helsinki (Finnland)',
    'london' => 'London (United Kingdom)'
];

?>
<form action="index.php" method="GET">
    <label for="city">Bitte wählen Sie die Stadt aus:</label>
    <br />
    <select name="city" id="city">
        <?php foreach($cities AS $key => $value): ?>
            <option value="<?php echo $key; ?>" <?php if(!empty($_GET['city']) && $_GET['city'] === $key) echo 'selected'; ?>>
                <?php echo $value; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Abschicken!" />
</form>

<hr />

<?php

if (!empty($_GET['city']) && !empty($cities[$_GET['city']])) {
    // include "texts/{$_GET['city']}.html";
    echo file_get_contents("texts/{$_GET['city']}.html");
}

?>

</body>
</html>