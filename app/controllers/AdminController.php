<?php

namespace app\controllers;
use app\core\Controller;

class AdminController extends Controller{
    public function loginAction(){
        $this->view->render('Вход');
    }

    public function logoutAction(){
        $this->view->render('Выход');
    }
}
