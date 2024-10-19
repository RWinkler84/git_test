<?php

require_once __DIR__ . '/inc/all.php';

$route = @(string) ($_GET['route'] ?? 'page');

if ($route === 'page') {
    // var_dump("Gebe hier doch bitte die Startseite aus...");
    $pagesController = new \App\Controller\PagesController(
        new \App\Pages\PagesRepository($pdo)
    );
    $page = @(string) ($_GET['page'] ?? 'index');
    $pagesController->showPage($page);
}
else {
    // var_dump("Hier gebe die Fehlerseite aus (Error 404)");

    $notFoundController = new \App\Controller\NotFoundController(
        new \App\Pages\PagesRepository($pdo)
    );
    $notFoundController->error404();
}