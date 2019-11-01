<?php

namespace models;

use core\AbstractModel;
use mysqli;


class NewsModel extends AbstractModel{
    
    public function addPost($post) {
	$query = "insert into users values (null, '{$post['title']}','{$post['text']}')";
	$this->db->query($query);
	if ($this->db->errno) {
	    die($this->db->error);
	}
    }
}
