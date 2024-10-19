<?php

require __DIR__ . '/inc/all.php';

$searchTerm = @(string) ($_GET['search'] ?? '');

// Suchlogik
function get_cities_by_search(string $search): ?array {
    global $pdo;

    $stmt = $pdo->prepare('SELECT * FROM `cities` WHERE `title` LIKE :title');
    $stmt->bindValue(':title', "%{$search}%");
    $stmt->execute();

    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $cities;
}

$cities = get_cities_by_search($searchTerm);

var_dump($cities);
die();

render(__DIR__ . '/views/search.view.php', [
    'searchTerm' => $searchTerm
]);