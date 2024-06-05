<?php

require_once '../app/core/Router.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';
require_once '../app/core/Database.php';
require_once '../app/core/Validation.php';

session_start();

$router = new Router();

// Add routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('register', ['controller' => 'User', 'action' => 'register']);
$router->add('login', ['controller' => 'User', 'action' => 'login']);
$router->add('logout', ['controller' => 'User', 'action' => 'logout']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['REQUEST_URI']);