<?php

$pdo = new PDO('mysql:host=localhost;dbname=php_course', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$stmt = $pdo->prepare('SELECT * FROM `news`');
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($results);

?>

<ul>
    <?php foreach($results AS $result): ?>
        <li><?php echo $result['title']; ?></li>
    <?php endforeach; ?>
</ul>