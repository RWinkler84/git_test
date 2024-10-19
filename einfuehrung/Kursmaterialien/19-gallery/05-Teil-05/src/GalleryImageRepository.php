<?php


class GalleryImageRepository {

    public function __construct(private PDO $pdo) {}

    public function fetchAll() {
        $stmt = $this->pdo->prepare('SELECT * FROM images ORDER BY id ASC');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'GalleryImageModel');

        // var_dump($results[0]->title);
        var_dump($results);
        return $results;
    }
}
