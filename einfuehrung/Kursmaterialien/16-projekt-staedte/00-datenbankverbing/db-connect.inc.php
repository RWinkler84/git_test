<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=php_cities', 'php_cities', '7UAyThtHhMaCd4ed', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch(PDOException $e) {
    echo 'Probleme mit der Datenbankverbindung...';
    die();
}


var_dump($pdo);



?>