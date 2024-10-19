<?php

require_once __DIR__ . '/inc/all.php';

$page = @(string) ($_GET['page'] ?? 'index');


if ($page === 'index') {
    // var_dump("Gebe hier doch bitte die Startseite aus...");
    $pagesController = new \App\Controller\PagesController(
        new \App\Pages\PagesRepository()
    );
    $pagesController->showPage('index');
}
else {
    // var_dump("Hier gebe die Fehlerseite aus (Error 404)");

    $notFoundController = new \App\Controller\NotFoundController();
    $notFoundController->error404();
}