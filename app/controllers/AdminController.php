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

    public function addAction(){
        $this->view->render('Добавить пост');
    }

    public function editAction(){
        $this->view->render('Редактировать пост');
    }
    public function deleteAction(){
        $this->view->render('Удалить пост');
    }
}
