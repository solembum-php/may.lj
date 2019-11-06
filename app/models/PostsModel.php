<?php

namespace models;

use core\AbstractModel;


class PostsModel extends AbstractModel {

    public function all() {
        $query = "select posts.id as id, posts.title as title, posts.text as text, users.login as author from users inner join posts on posts.user_id = users.id order by id desc;";
        $result = $this->db->query($query);
        if (!$result) {
            die($this->db->error);
        }
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        array_walk($posts, function (&$post) {
            $maxLengh = 100;
            if (mb_strlen($post['text'], "UTF-8") > $maxLengh) {
                $textCut = mb_substr($post['text'], 0, $maxLengh, "UTF-8");
                $words = explode(" ", $textCut);
                unset($words[count($words) - 1]);
                $shortText = implode(" ", $words);
                $post['text'] = $shortText . "...";
            }
        });
//	$posts = [];
//	while ($post = $result->fetch_object()) {
//	    $posts[] = $post;
//	}
        return $posts;
    }

    /**
     * add new post
     * 
     * @param array $post
     */
    public function addPost($post) {
//        $_SESSION['user'] = $user;
//	$post['user_id'] = $user['id'];
	$query = "insert into posts values (null, '{$post['title']}', '{$post['text']}', null)";
        $this->db->query($query);
        if ($this->db->errno) {
            die($this->db->error);
        }
    }

}
