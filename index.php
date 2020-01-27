<?php

// Delete with production.
require 'app/lib/dev.php';

use app\core\Router;

function autoload($className)
{
    $path = str_replace('\\', '/', $className.'.php');
    if (file_exists($path)){
        require $fileName;
    }
}

spl_autoload_register('autoload');

session_start();

$router = new Router;
$router->run();