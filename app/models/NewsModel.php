<?php

namespace models;

use core\AbstractModel;
use mysqli;

class NewsModel extends AbstractModel {

    /**
     * add new post
     * 
     * @param array $post
     */
    public function addPost($post) {
        $query = "insert into posts values (null, '{$post['title']}','{$post['text']}',null)";
        $this->db->query($query);
        if ($this->db->errno) {
            die($this->db->error);
        }
    }

    public function getAllPosts() {
        $query = "select * from posts";
        $this->db->query($query);
        if ($query) {
            $posts = $query->fetch_all(MYSQLI_ASSOC);
            if ($this->db->errno) {
                die($this->db->error);
            }
            return $posts;
        }
    }

}
