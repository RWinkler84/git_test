<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=cms', 'cms', 'Sn-sGH9rX@hExLmS', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    return $pdo;
}
catch(PDOException $e) {
    echo 'Probleme mit der Datenbankverbindung...';
    die();
}

