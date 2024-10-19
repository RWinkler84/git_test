<?php

require_once __DIR__ . '/../inc/all.php';

$galleryImageRepository = new GalleryImageRepository($pdo);

if (!empty($_POST)) {

} else {
    $entry = $galleryImageRepository->findById(@(int) $_GET['id']);
    var_dump($entry);
}



?>
<input type="text" name="title" value="<?php echo e($entry->title); ?>" />
<input type="hidden" name="id" value="<?php echo e($entry->id); ?>" />