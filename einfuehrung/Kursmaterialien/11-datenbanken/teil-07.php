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
$id = (int) $_GET['id'];
$query = 'SELECT * FROM `news` WHERE `id` = ' . $id;
var_dump($query);
$stmt = $pdo->prepare($query);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($result);
*/

$stmt = $pdo->prepare('SELECT * FROM `news` WHERE `id` = :id');
$stmt->bindValue(':id', $_GET['id']);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($result);