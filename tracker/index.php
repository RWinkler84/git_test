<?php

use Controller\TasksController;

require_once __DIR__ . '/core/loader.php';

session_start();
if (empty($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    $_GET['a'] = 'loginPage';
    $_GET['c'] = 'user';
}

if (!isset($_GET['c'])) {
    $controller = new \Controller\TasksController;
} else {
    $controllerName = '\Controller\\' . ucfirst($_GET['c']) . 'Controller';
   
    if (class_exists($controllerName)) {
        $controller = new $controllerName; //hier kommt rein, was muss, wenn es mal mehr Controller geben sollte
    }
}

if (!isset($_GET['a'])) {
    $action = 'getTaskList';
} else {
    if (method_exists($controller, $_GET['a'])) {
        $action = $_GET['a'];
    } else {
        die('Darfst du nicht!');
    }
}

$controller->$action();
