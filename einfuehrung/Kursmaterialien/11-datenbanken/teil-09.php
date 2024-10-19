<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=php_course', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch(PDOException $e) {
    echo 'Probleme mit der Datenbankverbindung...';
    die();
}

/*
$stmt = $pdo->prepare('UPDATE `news` SET `title` = :title WHERE `id` = :id');
$stmt->bindValue(':id', 7);
$stmt->bindValue(':title', 'Hallo Jupiter');
$stmt->execute();
*/

$stmt = $pdo->prepare('DELETE FROM `news` WHERE `id` = :id');
$stmt->bindValue(':id', 7);
$stmt->execute();

