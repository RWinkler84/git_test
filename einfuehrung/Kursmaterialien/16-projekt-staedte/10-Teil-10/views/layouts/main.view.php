<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/simple.css">
</head>
<body>
    <header>
        <h1>Städte-Verzeichnis</h1>
        <p>Hier finden Sie eine Übersicht über alle Städte in Deutschland</p>
        <nav>
            <?php foreach($alphabet AS $char): ?>
                <a href="index.php?<?php echo http_build_query(['char' => $char]); ?>">
                    <?php echo e($char); ?>
                </a>
            <?php endforeach; ?>
        </nav>
        <hr />
        <form method="GET" action="search.php">
            <input type="text" name="search" value="<?php echo e($searchTerm ?? ''); ?>" />
            <input type="submit" value="Suchen!" />
        </form>
    </header>
    <main>
        <?php echo $content; ?>
    </main>
</body>
</html>