<?php

function autoload($className)
{
    $path = str_replace('\\', '/', $className.'.php');
    if (file_exists($path)){
        require $path;
    }
}

spl_autoload_register('autoload');
