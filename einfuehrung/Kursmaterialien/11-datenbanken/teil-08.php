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

$stmt = $pdo->prepare('INSERT INTO `news` (`title`, `content`) VALUES (:title, :content)');
$stmt->bindValue(':title', 'Hallo Venus');
$stmt->bindValue(':content', 'Das hier ist der Inhalt dieser Nachricht...');
$stmt->execute();

var_dump($pdo->lastInsertId());