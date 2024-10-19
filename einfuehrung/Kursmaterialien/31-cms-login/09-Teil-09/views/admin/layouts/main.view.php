<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./styles/simple.css" />
    <link rel="stylesheet" href="./styles/custom.css" />
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Admin-Bereich</h1>
        <p>Das hier ist der Admin-Bereich</p>
        <?php /* <nav></nav> */ ?>
    </header>
    <main>
        <?php echo $content; ?>
    </main>
    <footer>
        <p>Projekt: CMS vom PHP-Kurs <a href="./?route=admin/logout">(ausloggen)</a></p>
    </footer>
</body>
</html>