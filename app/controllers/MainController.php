<?php

namespace app\controllers;
use app\core\Controller;

class MainController extends Controller{
    public function indexAction(){
        $this->view->render('Главная');
    }

    public function contactAction(){
        $this->view->render('Контакты');
    }

    public function aboutAction(){
        $this->view->render('Обо мне');
    }

    public function postAction(){
        $this->view->render('Пост');
    }

}
