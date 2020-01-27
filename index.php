<?php
require_once 'app/lib/autoload.php';

// Delete with production.
require 'app/lib/dev.php';

use app\core\Router;

session_start();

$router = new Router;
$router->run();