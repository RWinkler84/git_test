<?php

require_once __DIR__ . '/../inc/all.php';

$galleryImageRepository = new GalleryImageRepository($pdo);

$title = $_POST['title'];

if (!empty($_FILES['image']) && 
    $_FILES['image']['error'] === UPLOAD_ERR_OK &&
    $_FILES['image']['type'] === 'image/jpeg' &&
    is_uploaded_file($_FILES['image']['tmp_name'])) {
    
    $galleryImageRepository->handleNewUpload($title, $_FILES['image']['tmp_name']);
}
// var_dump($_POST);
// var_dump($_FILES);