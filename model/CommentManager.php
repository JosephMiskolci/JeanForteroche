<?php

namespace JeanForteroche\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? AND validated = "1" ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function showComment($comment_id)
    {
        $comment_id = htmlspecialchars($_GET['id']);
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = :id ORDER BY comment_date DESC');
        $comments->execute(array(
          'id' => $comment_id)
        );
        return $comments;
    }


    public function getUserComment($user_name)
    {
      $db = $this->dbConnect();
      $comments = $db->query('SELECT c.author, c.id AS com_id, c.comment, c.validated, c.comment_date, p.title
                              FROM comments c
                              INNER JOIN posts p
                              ON c.post_id = p.id
                              WHERE c.author = "' .$user_name. '"
                              ORDER BY comment_date DESC');

      return $comments;
    }

    public function getWaitingComments()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT c.author, c.id AS com_id, c.comment, c.comment_date, p.title
                                FROM comments c
                                INNER JOIN posts p
                                ON c.post_id = p.id
                                WHERE c.validated = "0"
                                ORDER BY comment_date DESC');

        return $comments;
    }

    public function confirmComments()
    {
        $db = $this->dbConnect();

        $comment_id = htmlspecialchars($_GET['id']);
        $comments = $db->prepare('UPDATE comments SET validated = "1" WHERE id = :id');
        $confirmedComment = $comments->execute(array(
          'id' => $comment_id)
        );

        return $confirmedComment;
    }

  public function postEditedComment()
  {
      $db = $this->dbConnect();

      $comment_id = htmlspecialchars($_GET['id']);
      $req_connect = $db->prepare('UPDATE comments SET comment = :comment WHERE id = :id');
      $req_connect->execute(array(
       'comment' => $_POST['mytextarea'],
       'id' => $comment_id));

      return $req_connect;
  }

  public function supprComments()
    {
      $db = $this->dbConnect();

      $edit_id = htmlspecialchars($_GET['id']);
      $req_connect = $db->prepare('DELETE FROM comments WHERE id = :id');
      $req_connect->execute(array(
        'id' => $edit_id));
    }

    public function postComment()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, validated, comment_date) VALUES(?, ?, ?, "0", NOW())');
        $commentedLines = $comments->execute(array($_GET['id'], $_SESSION['pseudo'], $_POST['comment']));

        return $commentedLines;
    }
}
