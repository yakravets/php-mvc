<?php
require_once 'app/lib/autoload.php';

use app\core\Router;

session_start();

$router = new Router;
$router->run();