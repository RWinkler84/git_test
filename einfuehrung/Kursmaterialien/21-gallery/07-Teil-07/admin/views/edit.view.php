<form action="edit.php" method="POST">
    <input type="hidden" name="id" value="<?php echo e($galleryImage->id); ?>" />

    <input type="text" name="title" value="<?php echo e($galleryImage->title); ?>" />

    <input type="submit" value="Abschicken!" />
</form>