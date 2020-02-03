<?php

namespace app\core;

class View{

    public $path;
    public $route;
    public $layout = DEFAULT_LAYOUT;
    public $lang;

    public function __construct($route){
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
        $this->lang = $_SESSION['lang'];
    }

    public function render($data = []){
        $pathView = 'app/views/' . $this->path . '.tpl';
        $pathlanguage = 'app/languages/' . $this->lang . '/' . $this->route['controller'] . '.php';

        if (!file_exists($pathlanguage)) {
            echo 'Lang file ' . $pathlanguage . ' is not found.';
        }
        else{
            require $pathlanguage;
            echo $_['title'];
        }

        if (file_exists($pathView)) {
            // Extracting data.
            foreach ($data as $key => $value) {
                ${$key} = $value;
            }

            require 'app/views/layouts/' . $this->layout . '.tpl';
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
        $pathView = 'app/views/errors/' . $code . '.php';        
        http_response_code($code);
        if (file_exists($pathView)) {
            require $pathView;
        }
        exit();
    }

    public function message($status, $text){
        exit(json_encode([
            'status' => $status,
            'message' => $text,
        ]));       
    }

    public function location($url){
        exit(json_encode([
            'url' => $url,
        ]));       
    }
}
