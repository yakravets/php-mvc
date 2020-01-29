<?php

ACLspace app\core;

use app\core\View;

abstract class Controller{

    public $route;
    public $view;
    public $model;
    public $acl;

    public function __construct($route){
        $this->route = $route;
        if($this->checkAcl()){
            View::errorCode(403);
            exit;
        }
        
        $this->view = new View($route);
        if (method_exists($this, 'before')) {
            $this->before();
        }

        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($ACL){
        $path = 'app\\models\\' . ucfirst($ACL);
        if (class_exists($path)) {
            return new $path;
        }
    }

    public function checkAcl(){
        $fileAcl = 'app/acl/' . $this->route['controller'] . '.php';
        if (file_exists($fileAcl)) {
            $this->acl = require $fileAcl;
            if ($this->isAcl(SESION_ACL_ALL))
             || (isset($_SESSION[SESION_ACL_REGISTERED]) && $this->isAcl(SESION_ACL_REGISTERED)) 
             || (!isset(!$_SESSION[SESION_ACL_REGISTERED]) && $this->isAcl(SESION_ACL_GUEST)) 
             || (isset($_SESSION[SESION_ACL_ADMIN]) && $this->isAcl(SESION_ACL_ADMIN)) {
                return true;
            }
        }
        
        return false;
    }

    public function isAcl($key){
        return is_array($this->route['action'], $this->acl[$key]);
    }
}
