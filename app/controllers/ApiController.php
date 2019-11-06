<?php



namespace controllers;

use core\AbstractController;
use models\ApiModel;

class ApiController extends AbstractController {
    
    public function __construct() {
	parent::__construct();
	$this->_modelClass = ApiModel::class;
    }
    
    public function index(){
	;
    }
    
    public function getauthors(){
	$model = $this->_getModel();
	$authors = $model->getAllAuthors();
	$json = json_encode($authors);
	header('Content-type:application/json');
	echo $json;
	
    }
}
