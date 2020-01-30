<?php
require_once 'app/lib/autoload.php';
if (file_exists('config.php')) {
    require_once 'config.php';
}
else {
    echo 'Rename file \"config-simple.php\" to \"config.php\" and fill settings\n';
    exit();
}


use app\core\Router;

session_start();

$router = new Router;
$router->run();