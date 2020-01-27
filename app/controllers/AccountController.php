<?php

namespace app\controllers;
use app\core\Controller;

class AccountController extends Controller{
    public function before(){
        $this->view->layaout = 'custom';
    }
    
    public function loginAction(){
        if (!empty($_POST)) {
           $this->view->message('error', 'Text error');
        } else {
            $this->view->render('Login');
        }
    }

    public function registerAction(){
        //$this->view->path = 'test/test'; - change default path view
        $this->view->render('Register');
    }
}
