<?php

namespace JeanForteroche\Blog\Model;

require_once("model/Manager.php");

class AdminManager extends Manager
{

  public function postArticle($postId, $author, $comment)
  {
      $db = $this->dbConnect();
      $articles = $db->prepare('INSERT INTO posts(id, content, creation_date) VALUES(?, ?, NOW())');
      $publishedArticles = $articles->execute(array($postId, $author, $comment));

      return $publishedArticles;
}
