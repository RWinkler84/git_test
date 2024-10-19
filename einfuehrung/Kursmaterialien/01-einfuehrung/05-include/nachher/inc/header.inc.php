<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./styles/simple.css">
    <title><?php if(!empty($pageTitle)){echo $pageTitle;} else {echo 'Besseren Urlaub gibt es nicht...';} ?></title>
</head>
<body>
    <header>
        <h1>Das moderne Reisebüro</h1>
        <nav>
                <a href="index.php" <?php if(!empty($page) && $page == 'Startseite'){echo 'class="active"';} ?>>Startseite</a>
                <a href="helsinki.php"<?php if(!empty($page) && $page == 'Helsinki'){echo 'class="active"';} ?>>Helsinki</a>
                <a href="mallorca.php"<?php if(!empty($page) && $page == 'Mallorca'){echo 'class="active"';} ?>>Mallorca</a>
            
        </nav>
    </header>

    <main>
        <h2><?php if(!empty($pageTitle)){echo $pageTitle;} else {echo 'Besseren Urlaub gibt es nicht...';} ?></h2>