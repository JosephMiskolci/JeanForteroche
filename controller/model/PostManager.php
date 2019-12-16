<?php

namespace JeanForteroche\Blog\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 3');

        return $req;
    }

    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts ORDER BY creation_date DESC');
        return $req;
    }

    public function getPost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array(
            $id
        ));
        $post = $req->fetch();

        return $post;
    }

    public function postArticle($title, $content)
    {
        $db = $this->dbConnect();

        $req_connect = $db->prepare("INSERT INTO posts(title,content,creation_date) VALUES(?,?,NOW())");
        $req_connect->execute(array(
            $title,
            $content
        ));
    }

    public function postEditedArticle($title, $content, $edit_id)
    {
        $db = $this->dbConnect();

        $req_connect = $db->prepare('UPDATE posts SET title = :titre, content = :content WHERE id = :id');
        $req_connect->execute(array(
            'titre' => $title,
            'content' => $content,
            'id' => $edit_id
        ));
    }

    public function postDeleteArticle($edit_id)
    {
        $db = $this->dbConnect();

        $req_connect = $db->prepare('DELETE FROM posts WHERE id = :id');
        $req_connect->execute(array(
            'id' => $edit_id
        ));
    }
}
