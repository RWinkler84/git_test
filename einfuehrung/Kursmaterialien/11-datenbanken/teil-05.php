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


$stmt = $pdo->prepare('SELECT `id`, `title` FROM `news`');
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($results);

?>

<ul>
    <?php foreach($results AS $result): ?>
        <li><?php echo $result['title']; ?></li>
    <?php endforeach; ?>
</ul>