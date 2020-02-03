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
        foreach ($arr as $key => $val){
            $this->add($key, $val);
        }
    }

    public function add($route, $params){
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match(){
        $url = explode('?', trim($_SERVER['REQUEST_URI'], '/'));
        $this->globalParams($url[1]);

        foreach($this->routes as $route => $params){
            if(preg_match($route, $url[0])){
                $this->params = $params;
                return true;
            }

        }
        return false;
    }

    public function run(){
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = DEFAULT_LANG;
        }

        if ($this->match()) {
            $controller = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';

            if (class_exists($controller)) {
                $action = $this->params['action'].'Action';
                if(method_exists($controller, $action)){
                    $objController = new $controller($this->params);
                    $objController->$action($this->params);
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

    public function globalParams($getParams){
        $getParams = explode('&', $getParams);

        foreach($getParams as $val){
            $mapArr = explode   ('=', $val);
            $key = $mapArr[0];
            $value = $mapArr[1];
            $this->getDataListener($key, $value);
        }
    }

    private function getDataListener($key, $value){
        if($key == 'lang'){
            $_SESSION['lang'] = $value;
        }
    }
}