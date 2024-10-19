<?php

require_once __DIR__ . '/inc/all.php';

$container = new \App\Support\Container();
$container->add('pdo', function() {
    return require __DIR__ . '/inc/db-connect.inc.php';
});
$container->add('pagesRepository', function() use($container) {
    return new \App\Pages\PagesRepository($container->get('pdo'));
});
$container->add('pagesController', function() use($container) {
    return new \App\Controller\PagesController(
        $container->get('pagesRepository')
    );
});
$container->add('pagesAdminController', function() use($container) {
    return new \App\Controller\Admin\PagesAdminController(
        $container->get('pagesRepository')
    );
});
$container->add('notFoundController', function() use($container) {
    return new \App\Controller\NotFoundController(
        $container->get('pagesRepository')
    );
});

// var_dump($container->get('pagesController'));
// die();

$route = @(string) ($_GET['route'] ?? 'page');

if ($route === 'page') {
    // var_dump("Gebe hier doch bitte die Startseite aus...");
    $pagesController = $container->get('pagesController');
    $page = @(string) ($_GET['page'] ?? 'index');
    $pagesController->showPage($page);
} 
else if ($route === 'admin/page') {
    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->index();
}
else if ($route === 'admin/page/create') {
    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->create();
}
else if ($route === 'admin/page/delete') {
    $pagesAdminController = $container->get('pagesAdminController');
    $id = @(int) ($_POST['id'] ?? 0);
    $pagesAdminController->delete($id);
}
else if ($route === 'admin/page/edit') {
    $pagesAdminController = $container->get('pagesAdminController');
    $id = @(int) ($_GET['id'] ?? 0);
    $pagesAdminController->edit($id);
}
else {
    // var_dump("Hier gebe die Fehlerseite aus (Error 404)");

    $notFoundController = $container->get('notFoundController');
    $notFoundController->error404();
}