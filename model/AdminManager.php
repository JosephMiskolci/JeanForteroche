<?php
namespace JeanForteroche\Blog\Model;

require_once ("model/Manager.php");

class AdminManager extends Manager
{
    public function postArticle($title, $content)
    {
        $db = $this->dbConnect();

            $req_connect = $db->prepare("INSERT INTO posts(title,content,creation_date) VALUES(?,?,NOW())");
            $req_connect->execute(array(
                $title,
                $content
            ));
    }

    public function postEditedArticle($edit_name, $edit_content, $edit_id)
    {
        $db = $this->dbConnect();

            $req_connect = $db->prepare('UPDATE posts SET title = :titre, content = :content WHERE id = :id');
            $req_connect->execute(array(
                'titre' => $edit_name,
                'content' => $edit_content,
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

    public function getAllUsers()
    {
        $db = $this->dbConnect();
        $getAllUsers = $db->prepare('SELECT * FROM member_space ORDER BY date_creation DESC');
        $getAllUsers->execute();

        return $getAllUsers;
    }

    public function validAdminUsers($comment_id)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('UPDATE member_space SET admin = "1" WHERE id = :id');
        $confirmedComment = $comments->execute(array(
            'id' => $comment_id
        ));

        return $confirmedComment;
    }

    public function unvalidAdminUsers($comment_id)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('UPDATE member_space SET admin = "0" WHERE id = :id');
        $confirmedComment = $comments->execute(array(
            'id' => $comment_id
        ));

        return $confirmedComment;
    }

    public function validModeratorUsers($comment_id)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('UPDATE member_space SET moderator = "1" WHERE id = :id');
        $confirmedComment = $comments->execute(array(
            'id' => $comment_id
        ));

        return $confirmedComment;
    }

    public function unvalidModeratorUsers($comment_id)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('UPDATE member_space SET moderator = "0" WHERE id = :id');
        $confirmedComment = $comments->execute(array(
            'id' => $comment_id
        ));

        return $confirmedComment;
    }

    public function DeleteUsers($edit_id)
    {
        $db = $this->dbConnect();

        $req_connect = $db->prepare('DELETE FROM member_space WHERE id = :id');
        $req_connect->execute(array(
            'id' => $edit_id
        ));
    }
}
