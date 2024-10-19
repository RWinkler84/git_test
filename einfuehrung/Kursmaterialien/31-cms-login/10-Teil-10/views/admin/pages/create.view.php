<h1>Eine neue Seite anlegen</h1>

<?php if(!empty($error)): ?>
    <p><?php echo e($error); ?></p>
<?php endif; ?>

<form method="POST" action="./?route=admin/page/create">
    <label for="pages-create-title">Titel:</label><br />
    <input type="text" name="title" id="pages-create-title" value="<?php if(!empty($_POST['title'])) echo e($_POST['title']); ?>" /><br />

    <label for="pages-create-slug">Slug:</label><br />
    <input type="text" name="slug" id="pages-create-slug" value="<?php if(!empty($_POST['slug'])) echo e($_POST['slug']); ?>" /><br />

    <label for="pages-create-content">Inhalt:</label><br />
    <textarea name="content" id="pages-create-content"><?php if(!empty($_POST['content'])) echo e($_POST['content']); ?></textarea><br />

    <input type="submit" value="Abschicken!" />
</form>