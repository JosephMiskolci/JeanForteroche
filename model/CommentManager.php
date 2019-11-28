<?php
namespace JeanForteroche\Blog\Model;

require_once ("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, flag_comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = :id AND validated = "1" ORDER BY comment_date DESC');
        $comments->execute(array(
            'id' => $postId
        ));

        return $comments;
    }

    public function showComment($comment_id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, flag_comment DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = :id ORDER BY comment_date DESC');
        $comments->execute(array(
            'id' => $comment_id
        ));
        return $comments;
    }

    public function getUserComment($user_name)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT c.author, c.id AS com_id, c.comment, c.validated, c.flag_comment, c.comment_date, p.title
                              FROM comments c
                              INNER JOIN posts p
                              ON c.post_id = p.id
                              WHERE c.author = :user_name
                              ORDER BY comment_date DESC');
        $comments->execute(array(
            'user_name' => $user_name
        ));
        return $comments;
    }

    public function getWaitingComments()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT c.author, c.id AS com_id, c.comment, c.flag_comment, c.comment_date, p.title
                                FROM comments c
                                INNER JOIN posts p
                                ON c.post_id = p.id
                                WHERE c.validated = "0"
                                ORDER BY comment_date DESC');
        $comments->execute();
        return $comments;
    }

    public function getFlagComments()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT c.author, c.id AS com_id, c.comment, c.flag_comment, c.comment_date, p.title
                                FROM comments c
                                INNER JOIN posts p
                                ON c.post_id = p.id
                                WHERE c.validated = "1"
                                ORDER BY flag_comment DESC');
        $comments->execute();
        return $comments;
    }

    public function confirmComments($comment_id)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('UPDATE comments SET validated = "1" WHERE id = :id');
        $confirmedComment = $comments->execute(array(
            'id' => $comment_id
        ));

        return $confirmedComment;
    }

    public function postEditedComment($comment_id, $comment_content)
    {
        $db = $this->dbConnect();

        $req_connect = $db->prepare('UPDATE comments SET comment = :comment WHERE id = :id');
        $req_connect->execute(array(
            'comment' => $comment_content,
            'id' => $comment_id
        ));

        return $req_connect;
    }

    public function supprComments($edit_id)
    {
        $db = $this->dbConnect();

        $req_connect = $db->prepare('DELETE FROM comments WHERE id = :id');
        $req_connect->execute(array(
            'id' => $edit_id
        ));
    }

    public function postComment($comment_id, $comment_pseudo, $comment_content)
    {
        $db = $this->dbConnect();
        
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, validated, flag_comment, comment_date) VALUES(:id, :pseudo, :content, "0", "0", NOW())');
        $commentedLines = $comments->execute(array(
            'id' => $comment_id,
            'pseudo' => $comment_pseudo,
            'content' => $comment_content
        ));

        return $commentedLines;
    }
}
