<?php

require __DIR__ . '/inc/all.php';

$searchTerm = @(string) ($_GET['search'] ?? '');

// Suchlogik

render(__DIR__ . '/views/search.view.php', [
    'searchTerm' => $searchTerm
]);