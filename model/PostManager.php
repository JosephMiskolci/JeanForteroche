<?php
namespace JeanForteroche\Blog\Model;

require_once ("model/Manager.php");

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

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array(
            $postId
        ));
        $post = $req->fetch();

        return $post;
    }

    public function postArticle()
    {
        $db = $this->dbConnect();

        if (isset($_POST['name']) and isset($_POST['mytextarea']))
        {
            $title = $_POST['name'];
            $content = $_POST['mytextarea'];
            $req_connect = $db->prepare("INSERT INTO posts(title,content,creation_date) VALUES(?,?,NOW())");
            $req_connect->execute(array(
                $title,
                $content
            ));
        }
    }

    public function postEditedArticle()
    {
        $db = $this->dbConnect();

        if (isset($_POST['name']) and isset($_POST['mytextarea']))
        {
            $edit_id = htmlspecialchars($_GET['id']);
            $req_connect = $db->prepare('UPDATE posts SET title = :titre, content = :content WHERE id = :id');
            $req_connect->execute(array(
                'titre' => $_POST['name'],
                'content' => $_POST['mytextarea'],
                'id' => $edit_id
            ));
        }
    }

    public function postDeleteArticle()
    {
        $db = $this->dbConnect();

        $edit_id = htmlspecialchars($_GET['id']);
        $req_connect = $db->prepare('DELETE FROM posts WHERE id = :id');
        $req_connect->execute(array(
            'id' => $edit_id
        ));
    }
}
