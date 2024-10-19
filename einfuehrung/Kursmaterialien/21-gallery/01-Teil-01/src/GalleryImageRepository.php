<?php

class GalleryImageRepository {

    public function __construct(private PDO $pdo) {}

    public function fetchAll() {
        $stmt = $this->pdo->prepare('SELECT * FROM images ORDER BY id ASC');
        $stmt->execute();
       
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, GalleryImageModel::class);
        return $results;
    }
}
