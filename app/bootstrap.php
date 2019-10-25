<?php

spl_autoload_register(function($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $classPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $class . '.php';
    if (file_exists($classPath)) {
	include_once $classPath;
	return true;
    }
    return true;
});

include_once 'config.php';

\core\Route::init();
