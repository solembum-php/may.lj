<?php

namespace controllers;

use core\AbstractController;

class AuthController extends AbstractController {

    public function index() {
	$this->view->render('auth_index_view');
    }
    
    public function registration(){
	$this->view->render('auth_register_view');
    }

}
