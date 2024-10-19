<h1>Admin: Seiten verwalten</h1>

<?php if (!empty($pages)): ?>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Slug</th>
                <th>Titel</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pages AS $page): ?>
                <tr>
                    <td><?php echo e($page->id); ?></td>
                    <td><?php echo e($page->slug); ?></td>
                    <td><?php echo e($page->title); ?></td>
                    <td>
                        <form method="POST" action="./?route=admin/page/delete">
                            <input type="hidden" name="id" value="<?php echo e($page->id); ?>" />
                            <input type="submit" value="Löschen" class="button-as-link" />
                        </form>
                        <a href="./?route=admin/page/edit&id=<?php echo e($page->id); ?>">Editieren</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Es wurden noch keine Seiten angelegt.</p>
<?php endif; ?>

<br /><hr /><br />
<a href="./?route=admin/page/create">Neue Seite anlegen</a>