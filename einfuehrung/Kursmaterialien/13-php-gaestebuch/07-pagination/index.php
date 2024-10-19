<?php

require_once __DIR__ . '/inc/db-connect.php';
require_once __DIR__ . '/inc/functions.php';

$perPage = 2;

$stmtCount = $pdo->prepare('SELECT COUNT(*) AS `count` FROM `entries`');
$stmtCount->execute();
$countTotal = $stmtCount->fetch(PDO::FETCH_ASSOC)['count'];



$stmt = $pdo->prepare('SELECT * FROM `entries`');
$stmt->execute();
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ . '/views/index.view.php';