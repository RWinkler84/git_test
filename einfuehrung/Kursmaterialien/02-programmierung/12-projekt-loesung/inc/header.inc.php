<?php
/*
if (!isset($pageTitle)) {
    $pageTitle = '';
}
*/

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./styles/simple.css">
    <?php /*
    <title><?php if (!empty($pageTitle)) { echo $pageTitle; } else { echo 'Das moderne Reisebüro'; } ?></title>
    */ ?>

    <?php if(!empty($pageTitle)): ?>
        <title><?php echo $pageTitle; ?></title>
    <?php else: ?>
        <title>Das Moderne Reisebüro</title>
    <?php endif; ?>
</head>
<body>
    <header>
        <h1>Das moderne Reisebüro</h1>

        <nav>
            <a href="./">Startseite</a>
            <a href="helsinki.php">Helsinki</a>
            <a href="mallorca.php">Mallorca</a>
        </nav>
    </header>

    <main>
        <?php if (!empty($pageTitle)): ?>
            <h2><?php echo $pageTitle; ?></h2>
        <?php endif; ?>