<?php

namespace App\Pages;

use PDO;

class PagesRepository {

    public function __construct(protected PDO $pdo) {}

    public function getNavigation(): array {
        $stmt = $this->pdo->prepare('SELECT * FROM `pages` ORDER BY `id` ASC');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, PagesModel::class);
    }

    public function fetchPage(string $key): ?PagesModel {
        $stmt = $this->pdo->prepare('SELECT * FROM `pages` WHERE `slug` = :slug');
        $stmt->bindValue(':slug', $key);
        $stmt->setFetchMode(PDO::FETCH_CLASS, PagesModel::class);
        $stmt->execute();
        $entry = $stmt->fetch();
        if (empty($entry)) {
            return null;
        } else {
            return $entry;
        }
    }
}
