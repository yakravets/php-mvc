<?php

namespace app\core;

class View{

    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route){
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
        
    }

    public function render($title, $data = []){
        $path = 'app/views/' . $this->path . '.php';
        
        extract($data);

        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'app/view/layout/' . $this->layout . 'php';
        }
        else {
            echo 'View not found.';
        }
    }  
    
    public function redirect($url){
        header('Location: ' . $url);
        exit;
    }

    public static function errorCode($code){
        $path = 'app/views/errors/' . $code . '.php';        
        http_response_code($code);
        if (file_exists($path)) {
            require $path;
        }
        exit();
    }

    public function message($status, $text){
        exit(json_encode([
            'status' => $status,
            'message' => $text,
        ]));
    }

}
