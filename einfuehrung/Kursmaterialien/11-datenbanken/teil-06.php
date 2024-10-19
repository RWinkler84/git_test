<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=php_course', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch(PDOException $e) {
    // var_dump($e->getMessage());
    echo 'Probleme mit der Datenbankverbindung...';
    die();
}


$stmt = $pdo->prepare('SELECT * FROM `news` WHERE `id` = 2');
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($result);
