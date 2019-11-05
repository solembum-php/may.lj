<?php

namespace controllers;

use core\AbstractController;
use mysqli;
use core\Route;
use controllers\AuthController;
use models\AuthModel;
use models\NewsModel;

class NewsController extends AbstractController {

    public function index() {
        $this->view->render('news_index_view');
    }

    public function addnews() {
        $this->view->render('add_news_view');
    }

    public function postproc() {
        $this->_checkMethod('POST');

        $post = filter_input_array(INPUT_POST);

        $model = $this->_getModel();
        $model->addPost($post);
        Route::redirect(url('/news'));
    }

    /**
     * create and return model object
     * 
     * @return AuthModel
     */
    protected function _getModel() {
        if (!$this->model) {
            $this->model = new NewsModel();
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
