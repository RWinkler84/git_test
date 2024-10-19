<?php

require __DIR__ . '/inc/all.php';

$searchTerm = @(string) ($_GET['search'] ?? '');


$cities = get_cities_by_search($searchTerm);


render(__DIR__ . '/views/search.view.php', [
    'cities' => $cities,
    'searchTerm' => $searchTerm
]);