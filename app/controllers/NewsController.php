<?php

namespace controllers;

use core\AbstractController;
use mysqli;
use core\Route;
use models\NewsModel;


class NewsController extends AbstractController {
    public function index(){
	$this->view->render('news_index_view');
    }
    
}
