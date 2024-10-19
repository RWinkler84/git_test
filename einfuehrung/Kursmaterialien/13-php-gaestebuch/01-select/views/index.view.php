<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="./styles/lib/montserrat/webfonts/Montserrat.css" />
    <link rel="stylesheet" type="text/css" href="./styles/main.css" />
    <title>Gästebuch</title>
</head>
<body>
    <div class="container">
        <h1 class="guestbook-heading">Gästebuch</h1>
        <form>
            <label class="guestbook-entry-label" for="name">Dein Name:</label>
            <input 
                class="guestbook-entry-input"
                type="text"
                id="name"
                name="name" />

            <label class="guestbook-entry-label" for="title">Titel des Eintrags:</label>
            <input 
                class="guestbook-entry-input" 
                type="text" 
                id="title"
                name="title" />

            <label class="guestbook-entry-label" for="content">Inhalt des Eintrags:</label>
            <textarea 
                rows="4"
                class="guestbook-entry-input" 
                type="text" 
                id="content" 
                name="content"></textarea>

            <div class="guestbook-form-buttons">
                <input class="button" type="reset" value="Zurücksetzen">
                <input class="button" type="submit" value="Absenden">
            </div>
        </form>

        <hr class="guestbook-separator" />

        <pre><?php print_r($entries); ?></pre>

        <?php foreach($entries AS $entry): ?>
            <div class="guestbook-entry">
                <div class="guestbook-entry-header">
                    <h3 class="guestbook-entry-title">
                        <?php echo e($entry['title']); ?>
                    </h3>
                    <span class="guestbook-entry-author">
                        <?php echo e($entry['name']); ?>
                    </span>
                </div>
                <div class="guestbook-entry-content">
                    <p>
                        <?php echo e($entry['content']); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>

        

        <ul class="guestbook-pagination">
            <li class="guestbook-pagination-li">
                <a class="guestbook-pagination-a guestbook-pagination-active" href="#">1</a>
            </li>
            <li class="guestbook-pagination-li">
                <a class="guestbook-pagination-a" href="#">2</a>
            </li>
            <li class="guestbook-pagination-li">
                <a class="guestbook-pagination-a" href="#">3</a>
            </li>
            <li class="guestbook-pagination-li">
                <a class="guestbook-pagination-a" href="#">4</a>
            </li>
        </ul>

        <hr class="guestbook-separator" />

        <footer class="guestbook-footer">
            <p>Implementiert im PHP-Kurs</p>
        </footer>

    </div>
</body>
</html>