<?php

declare(strict_types=1);

function get_cities_starts_with(string $char): ?array {
    global $pdo;

    $alphabet = generate_alphabet();
    if (!in_array($char, $alphabet)) {
        return null;
    }

    $stmt = $pdo->prepare('SELECT * FROM `cities` WHERE `title` LIKE :title ORDER BY `title` ASC, `zip` ASC');
    $stmt->bindValue(':title', "{$char}%");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($results);
    return $results;
}


function get_cities_by_search(string $search): ?array {
    global $pdo;

    $search = preg_replace("/[^A-Za-z0-9\ \.öäüßÖÄÜ,]/", '', $search);

    if (mb_strlen($search) <= 2) {
        return null;
    }

    $stmt = $pdo->prepare('SELECT * FROM `cities` WHERE `title` LIKE :title');
    $stmt->bindValue(':title', "%{$search}%");
    $stmt->execute();

    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $cities;
}