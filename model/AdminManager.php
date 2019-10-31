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

   public function postEditedArticle()
 {
   $db = $this->dbConnect();

    if(isset($_POST['name']) AND isset($_POST['mytextarea'])) {
      $edit_id = htmlspecialchars($_GET['id']);
      $req_connect = $db->prepare('UPDATE posts SET title = :titre, content = :content WHERE id = :id');
      $req_connect->execute(array(
       'titre' => $_POST['name'],
       'content' => $_POST['mytextarea'],
       'id' => $edit_id));
   }
  }

  public function postDeleteArticle()
{
  $db = $this->dbConnect();

   if(isset($_POST['name']) AND isset($_POST['mytextarea']) AND isset($_POST['delete'])) {
     $edit_id = htmlspecialchars($_GET['id']);
     $req_connect = $db->prepare('DELETE FROM posts WHERE id = :id');
     $req_connect->execute(array(
      'id' => $edit_id));
  }
 }
}
