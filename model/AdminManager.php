<?php
namespace JeanForteroche\Blog\Model;

require_once ("model/Manager.php");

class AdminManager extends Manager
{
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

        if (isset($_POST['name']) and isset($_POST['mytextarea']) and isset($_POST['delete']))
        {
            $edit_id = htmlspecialchars($_GET['id']);
            $req_connect = $db->prepare('DELETE FROM posts WHERE id = :id');
            $req_connect->execute(array(
                'id' => $edit_id
            ));
        }
    }

    public function getAllUsers()
    {
        $db = $this->dbConnect();
        $getAllUsers = $db->prepare('SELECT * FROM member_space ORDER BY date_creation DESC');
        $getAllUsers->execute();

        return $getAllUsers;
    }

    public function validAdminUsers()
    {
        $db = $this->dbConnect();

        $comment_id = htmlspecialchars($_GET['id']);
        $comments = $db->prepare('UPDATE member_space SET admin = "1" WHERE id = :id');
        $confirmedComment = $comments->execute(array(
            'id' => $comment_id
        ));

        return $confirmedComment;
    }

    public function unvalidAdminUsers()
    {
        $db = $this->dbConnect();

        $comment_id = htmlspecialchars($_GET['id']);
        $comments = $db->prepare('UPDATE member_space SET admin = "0" WHERE id = :id');
        $confirmedComment = $comments->execute(array(
            'id' => $comment_id
        ));

        return $confirmedComment;
    }

    public function validModeratorUsers()
    {
        $db = $this->dbConnect();

        $comment_id = htmlspecialchars($_GET['id']);
        $comments = $db->prepare('UPDATE member_space SET moderator = "1" WHERE id = :id');
        $confirmedComment = $comments->execute(array(
            'id' => $comment_id
        ));

        return $confirmedComment;
    }

    public function unvalidModeratorUsers()
    {
        $db = $this->dbConnect();

        $comment_id = htmlspecialchars($_GET['id']);
        $comments = $db->prepare('UPDATE member_space SET moderator = "0" WHERE id = :id');
        $confirmedComment = $comments->execute(array(
            'id' => $comment_id
        ));

        return $confirmedComment;
    }

    public function DeleteUsers()
    {
        $db = $this->dbConnect();

        $edit_id = htmlspecialchars($_GET['id']);
        $req_connect = $db->prepare('DELETE FROM member_space WHERE id = :id');
        $req_connect->execute(array(
            'id' => $edit_id
        ));
    }
}
