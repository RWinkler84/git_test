<?php

namespace App\Pages;

use PDO;

class PagesRepository {

    public function __construct(protected PDO $pdo) {}

    public function getNavigation(): array {
        return $this->fetchAll();
    }

    public function fetchAll(): array {
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

    public function findById(int $id): ?PagesModel {
        $stmt = $this->pdo->prepare('SELECT * FROM `pages` WHERE `id` = :id');
        $stmt->bindValue(':id', $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, PagesModel::class);
        $stmt->execute();
        $entry = $stmt->fetch();
        if (empty($entry)) {
            return null;
        } else {
            return $entry;
        }
    }

    public function create(string $title, string $slug, string $content): bool {
        $existsStmt = $this->pdo->prepare('SELECT COUNT(*) AS c FROM `pages` WHERE `slug` = :slug');
        $existsStmt->bindValue(':slug', $slug);
        $existsStmt->setFetchMode(PDO::FETCH_ASSOC);
        $existsStmt->execute();
        $existsValue = $existsStmt->fetch();
        if (empty($existsValue) || $existsValue['c'] != 0) {
            return false;
        }
        
        $stmt = $this->pdo->prepare('INSERT INTO `pages` (title, slug, content) VALUES (:title, :slug, :content)');
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':slug', $slug);
        $stmt->bindValue(':content', $content);
        $stmt->execute();
        return true;
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM `pages` WHERE id=:id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function updateTitleAndContent(int $id, string $title, string $content) {
        $stmt = $this->pdo->prepare('UPDATE `pages` SET `title` = :title, `content` = :content WHERE `id` = :id');
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->execute();
    }
}
