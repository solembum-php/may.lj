<?php

namespace controllers;

use core\AbstractController;
use mysqli;
use core\Route;
use models\AuthModel;

class AuthController extends AbstractController {

    public function index() {
        $this->view->render('auth_index_view');
    }

    public function registration() {
        $this->view->render('auth_register_view');
    }

    public function regproc() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('not available request method');
        }
        
        $user = filter_input_array(INPUT_POST);
        $errors = Route::userValidate($user);

        if (!empty($errors)) {
            
            $_SESSION['errors'] = $errors;
            $_SESSION['login'] = $user['login'];
            $_SESSION['email'] = $user['email'];
            
            
            Route::redirect(url('/auth/registration'));
        } else {
            $model = $this->getModel();
            $model->addUser($user);
            Route::redirect(url('/auth'));
        }
        //TODO все проверки
    }

    protected function getModel() {
        if (!$this->model) {
            $this->model = new AuthModel();
        }
        return $this->model;
    }

}
