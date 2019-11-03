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

    public function getWaitingComments()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT c.author, c.comment, c.comment_date, p.title
                                FROM comments c
                                INNER JOIN posts p
                                ON c.post_id = p.id
                                WHERE c.validated = "0"
                                ORDER BY comment_date DESC');

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, validated, comment_date) VALUES(?, ?, ?, "0", NOW())');
        $commentedLines = $comments->execute(array($postId, $author, $comment));

        return $commentedLines;
    }
}
