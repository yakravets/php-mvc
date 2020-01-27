<?php

namespace app\core;

use app\core\View;

class Router
{

    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require 'app/config/routes.php';
        foreach ($ar as $key => $val)
            $this->add($key, $val);
    }

    public function add($route, $params){
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;

    }

    public function match(){
        $url = trim($_SERVER['REQUEST_URI'], '/';
        foreach($this->routes as $route => $params){
            if(preg_match($route, $url)){
                $this->params = $params;
                return true;
            }

        }
        return false;
    }

    public function run(){
        if ($this->match()) {
            $path = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($controller)) {
                $controller = $this->params['action'].'Action';
                if(method_exists($controller, $action)){
                    $objController = new $controller;
                    $objController->$action($this->params;);
                }
                else {
                    View::errorCode(404);
                }
            }
            else {
                View::errorCode(404);
            }
        }
        else {
            View::errorCode(404);
        }
    }

}