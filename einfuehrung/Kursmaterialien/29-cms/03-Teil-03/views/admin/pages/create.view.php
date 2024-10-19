<h1>Eine neue Seite anlegen</h1>

<form method="POST" action="./?route=admin/page/create">
    <label for="pages-create-title">Titel:</label><br />
    <input type="text" name="title" id="pages-create-title" /><br />

    <label for="pages-create-slug">Slug:</label><br />
    <input type="text" name="slug" id="pages-create-slug" /><br />

    <label for="pages-create-content">Inhalt:</label><br />
    <textarea name="content" id="pages-create-content"></textarea><br />

    <input type="submit" value="Abschicken!" />
</form>