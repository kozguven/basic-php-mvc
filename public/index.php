<?php

require_once '../app/core/Router.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';
require_once '../app/core/Database.php';

session_start();

$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);