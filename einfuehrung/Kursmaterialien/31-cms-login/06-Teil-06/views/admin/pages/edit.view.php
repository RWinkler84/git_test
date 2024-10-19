<h1>Seite editieren</h1>

<?php if(!empty($error)): ?>
    <p><?php echo e($error); ?></p>
<?php endif; ?>

<form method="POST" action="./?route=admin/page/edit&id=<?php echo e($page->id);?>">
    <label for="pages-create-title">Titel:</label><br />
    <input type="text" name="title" id="pages-create-title" 
        value="<?php if(isset($_POST['title'])) { echo e($_POST['title']); } else { echo e($page->title); }?>" /><br />

    <label for="pages-create-content">Inhalt:</label><br />
    <textarea name="content" id="pages-create-content"><?php if(isset($_POST['content'])) echo e($_POST['content']); else echo e($page->content); ?></textarea><br />

    <input type="submit" value="Abschicken!" />
</form>