<?php

require __DIR__ . '/inc/all.php';

$alphabet = generate_alphabet();


$char = (string) ($_GET['char'] ?? 'A');
$cities = get_cities_starts_with($char);

require __DIR__ . '/views/index.view.php';