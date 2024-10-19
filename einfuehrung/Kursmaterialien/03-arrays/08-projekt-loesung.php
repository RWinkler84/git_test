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

$shoppingCart = [
    'Apfel',
    'Orange',
    'Banane',
    'Yoghurt',
    'Brot'
];

// var_dump($shoppingCart);

/**
 * Aufgabe:
 * 
 * 1) Überprüfe, ob das Array $shoppingCart Elemente enthält.
 *     Wenn ja:
 *        a) Gebe eine <ul>-Liste in HTML aus
 *        b) Generiere ein <li>-Element für jedes Element des Warenkorbes
 *     Wenn nicht:
 *        a) Gebe einen Absatz (<p>-Element) aus, wo der Nutzer darauf 
 *           hingewiesen wird, dass der Warenkorb leer ist.
 */
?>

<?php if (!empty($shoppingCart)): ?>
    <ul>
        <?php foreach($shoppingCart AS $item): ?>
            <li><?php echo $item; ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Der Warenkorb ist leer.</p>
<?php endif; ?>

</body>
</html>