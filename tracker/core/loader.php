<?php 

//DB-Connector
require_once __DIR__ . '/database.php';

//Models
require_once __DIR__ . '/../Model/AbstractModel.php';
require_once __DIR__ . '/../Model/Task.php';
require_once __DIR__ . '/../Model/User.php';

//Controller
require_once __DIR__ . '/../Controller/AbstractController.php';
require_once __DIR__ . '/../Controller/TasksController.php';
require_once __DIR__ . '/../Controller/UserController.php';

//Views
require_once __DIR__ . '/../Views/ViewRenderer.php';
