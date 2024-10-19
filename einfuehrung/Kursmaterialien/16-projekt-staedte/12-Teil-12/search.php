<?php

require __DIR__ . '/inc/all.php';

$searchTerm = @(string) ($_GET['search'] ?? '');


$cities = get_cities_by_search($searchTerm);

var_dump($cities);
die();

render(__DIR__ . '/views/search.view.php', [
    'searchTerm' => $searchTerm
]);