<?php

namespace controllers;

use core\AbstractController;
use models\PostsModel;

/**
 * Description of PostsController
 *
 * @author web
 */
class PostsController extends AbstractController {

    public function index() {
	$this->view->posts = $this->_getModel()->all();
	$this->view->render('posts_index_view');
    }
    
    public function authors(){
	$this->view->render('posts_authors_view');
    }

        public function item(){
	$id = filter_input(INPUT_GET, 'id');
	var_dump($id);
	exit();
	//TODO выбор и отображение новости
    }

    /**
     * create and return model object
     * 
     * @return PostsModel
     */
    protected function _getModel() {
	if (!$this->model) {
	    $this->model = new PostsModel();
	}
	return $this->model;
    }

}
