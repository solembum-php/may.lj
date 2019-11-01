<?php

namespace models;

use core\AbstractModel;
use mysqli;

class AuthModel extends AbstractModel {
    /**
     *
     * @var mysqli
     */
    protected $db;


    public function __construct() {
	$this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($this->db->connect_errno){
	    die('failed connect to db');
	}
    }
    
    /**
     * add user to db
     * 
     * @param array $user
     */
    public function addUser($user) {
	$hash = password_hash($user['pass'], PASSWORD_BCRYPT);
	$query = "insert into users values (null, '{$user['login']}','$hash','{$user['email']}')";
	$this->db->query($query);
	if($this->db->errno){
	    die($this->db->error);
	}
    }
    
    public function authenticationUser(array $requestUser){
	$query = "select * from users where login = '{$requestUser['login']}';";
	$result = $this->db->query($query);
	if($result){
	    $user = $result->fetch_object();
	    if(!password_verify($requestUser['pass'], $user->pass)){
		return false;
	    }
	    $_SESSION['user'] = $user;
	    return true;
	}else{
	    return false;
	}
    }
    
    /**
     * check user in session
     * 
     * @return boolean
     */
    public static function haveAuthUser(){
	//return !empty($_SESSION['user']);
	if(empty($_SESSION['user'])){
	    return false;
	}else{
	    return true;
	}
    }
}
