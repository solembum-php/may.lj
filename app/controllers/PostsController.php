<?php

namespace controllers;

use core\AbstractController;
use models\PostsModel;
use core\Route;

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

    public function authors() {
        $this->view->render('posts_authors_view');
    }

    public function item() {
        $id = filter_input(INPUT_GET, 'id');
        var_dump($id);
        exit();
        //TODO выбор и отображение новости
    }

    public function add() {
        $this->view->render('posts_add_view');
    }

    public function postproc() {
        $this->_checkMethod('POST');

        $post = filter_input_array(INPUT_POST);

        $model = $this->_getModel();
        $model->addPost($post);
        Route::redirect(url('/posts'));
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

    /**
     * check HTTP method or die
     * 
     * @param string $method
     */
    protected function _checkMethod(string $method) {
        $method = strtoupper($method);
        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            die('not available request method');
        }
    }

}
