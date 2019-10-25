<?php

namespace JeanForteroche\Blog\Model;

require_once("model/Manager.php");

class AdminManager extends Manager
{

    public function postArticle($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $postArticles = $db->prepare('INSERT INTO posts(id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr) VALUES(?, ?, ?, NOW())');
        $postArticlesLines = $postArticles->execute(array($postId, $author, $comment));

        return $postArticlesLines;
    }
}
