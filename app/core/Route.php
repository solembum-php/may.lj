<?php

namespace core;

use models\AuthModel;

class Route {

    /**
     * routing/controller/action
     */
    static public function init() {
	//######################################################################
	//получить дополнительный путь и разбить его на элементы по / если есть 
	//лишние элементы, то выдать 404. Если нет лишних, то первая часть - имя
	//контроллера(класса), вторая часть - имя экшна(метода). Если элементов 
	//меньше 2х, то экшн - index, контроллер main.Если указанного класса 
	//контроллера не существует, или метода экшн, то 404. сделать метод 
	//статический для ошибки 404
	//######################################################################
	//это значение останется в переменной, если не произойдет перезапись
	$controllerName = 'main';
	//это значение останется в переменной, если не произойдет перезапись
	$actionName = 'index';
	//забираем дополнительный путь документа в домене и разделяем его на список(это массив с числовым индексом)
	
	$routeItems = explode('/', explode('?',$_SERVER['REQUEST_URI'])[0]);
	//0-й элемент всегда содержит пустую строку поэтому удаляем его
	array_shift($routeItems);
	//проверяем последний элемент массва на пустое значение
	//при необходимости удаляем его
	if (empty($routeItems[count($routeItems) - 1])) {
	    array_pop($routeItems);
	}
	//если в массиве больше двух элементов, то 404
	if (count($routeItems) > 2) {
	    self::error404();
	}
	if (!empty($routeItems[0])) {
	    //для кириллицы
	    //$controllerName = mb_strtolower(urldecode($routeItems[0]));
	    $controllerName = strtolower($routeItems[0]);
	}
	if (!empty($routeItems[1])) {
	    //для кириллицы
	    //$actionName = mb_strtolower(urldecode($routeItems[1]));
	    $actionName = strtolower($routeItems[1]);
	}
	// для кириллицы
	//$controllerClassName = mb_convert_case($controllerName, MB_CASE_TITLE);
	$controllerClassName = 'controllers\\' . ucfirst($controllerName) . 'Controller';
	if (!class_exists($controllerClassName)) {
	    self::error404();
	}
	$controller = new $controllerClassName();
	if (!method_exists($controller, $actionName)) {
	    self::error404();
	}
	if ($controllerName !== 'auth' && !AuthModel::haveAuthUser()) {
	    Route::redirect(url('/auth'));
	}
	$controller->$actionName();
    }

    /**
     * create http status 404
     */
    static public function error404() {

	http_response_code(404);
	$view = new View();
	$view->render('error_404_view');
	exit();
    }

    /**
     * redirect to specified url
     * 
     * @param string $url
     */
    static public function redirect(string $url) {
	header('Location:' . $url);
    }

    /**
     * return error list from session
     * 
     * @return array
     */
    static public function getErrors() {

	if (empty($_SESSION['errors'])) {
	    $errors = [];
	} else {
	    $errors = $_SESSION['errors'];
	}
	return $errors;
    }

    /**
     * validate user and return error list
     * 
     * @param type $user
     * @return array
     */
    static public function userValidate($user) {
	$errors = [];

	if (strlen($user['login']) < 6) {
	    $errors[] = 'Too short login value';
	}
	if ($user['pass'] !== $user['pass_conf']) {
	    $errors[] = 'Passwords do not match';
	} else if (strlen($user['pass']) < 6) {
	    $errors[] = 'Too short password value';
	}
	if (empty($user['email'])) {
	    $errors[] = 'Email is required field';
	}
	if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
	    $errors[] = 'Incorrect email value';
	}
	return $errors;
    }

}
