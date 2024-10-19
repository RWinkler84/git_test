<?php

class GalleryImageRepository {

    public function __construct(private PDO $pdo) {}

    public function fetchAll() {
        $stmt = $this->pdo->prepare('SELECT * FROM images ORDER BY id ASC');
        $stmt->execute();
       
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, GalleryImageModel::class);
        return $results;
    }

    public function handleNewUpload(string $title, string $tmpImagePath) {
        $finalFileName = uniqid('', true) . '.jpg';
        $resizeOk = resizeImage($tmpImagePath, __DIR__ . "/../images/{$finalFileName}");

        if ($resizeOk) {
            $stmt = $this->pdo->prepare('INSERT INTO images (title, src) VALUES (:title, :src)');
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':src', $finalFileName);
            $stmt->execute();
            return true;
        }
        else {
            return false;
        }
    }
}
