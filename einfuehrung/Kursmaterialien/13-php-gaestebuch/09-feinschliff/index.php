<?php

require_once __DIR__ . '/inc/db-connect.php';
require_once __DIR__ . '/inc/functions.php';

$perPage = 15;
$currentPage = 1;
if (isset($_GET['page'])) {
    $currentPage = @(int) $_GET['page'];
    if ($currentPage <= 0) {
        $currentPage = 1;
    }
}


$stmtCount = $pdo->prepare('SELECT COUNT(*) AS `count` FROM `entries`');
$stmtCount->execute();
$countTotal = $stmtCount->fetch(PDO::FETCH_ASSOC)['count'];



$stmt = $pdo->prepare('SELECT * FROM `entries` ORDER BY `id` DESC LIMIT :offset, :perPage');
$stmt->bindValue('perPage', $perPage, PDO::PARAM_INT);
// Seite 1: Offset 0
// Seite 2: Offset $perPage
// Seite 3: Offset $perPage * 2
$stmt->bindValue('offset', ($currentPage - 1) * $perPage, PDO::PARAM_INT);
$stmt->execute();
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ . '/views/index.view.php';