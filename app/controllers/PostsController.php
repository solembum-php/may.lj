<?php

namespace controllers;

use core\AbstractController;

/**
 * Description of PostsController
 *
 * @author web
 */
class PostsController extends AbstractController {

    public function index() {
	$this->view->render('posts_index_view');
    }

}
