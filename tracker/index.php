<?php

use Controller\TasksController;
use View\ViewRenderer;

require_once __DIR__ . '/core/loader.php';

session_start();
if (empty($_SESSION['userToken'])){
    $_GET['a'] = 'login';
}

error_log($_GET['a']);
// echo $_SESSION['userToken'];

if (!isset($_GET['c'])){
    $controller = new TasksController;
} else {
    if (class_exists($_GET['c'] . 'Controller')){
    
    $controller = new $_GET['c'] . 'Controller'; //hier kommt rein, was muss, wenn es mal mehr Controller geben sollte

    }
}

if (!isset($_GET['a'])){
    $action = 'getTaskList';
} else {
    if (method_exists($controller, $_GET['a'])){
        $action = $_GET['a'];
    }
}

$controller->$action();