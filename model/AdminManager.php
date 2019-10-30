<?php

namespace JeanForteroche\Blog\Model;

require_once("model/Manager.php");

class AdminManager extends Manager
{
    public function postArticle()
  {
    $db = $this->dbConnect();

     if(isset($_POST['name']) AND isset($_POST['mytextarea'])) {
      $title = $_POST['name'];
      $content = $_POST['mytextarea'];
      $req_connect = $db->prepare("INSERT INTO posts(title,content,creation_date) VALUES(?,?,NOW())");
      $req_connect->execute(array($title,$content));
    }
   }
}
