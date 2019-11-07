<?php

require_once('model/CommentManager.php');
require_once('model/PostManager.php');

class AdminController {

  /*
  Affiche la page avec la liste des posts dans un template
  */
  static function viewHomeAdmin() {
    session_start();
    $htmlListPosts = getView('admin/homeAdmin.php', null);
    $htmlListPostsInTemplate = loadTemplateAdmin($htmlListPosts, "Page d'administration du blog de Jean Forteroche");
    return $htmlListPostsInTemplate;
  }

  static function viewWritingArticle() {
    session_start();
    $htmlListPosts = getView('admin/publishArticle.php', null);
    $htmlListPostsInTemplate = loadTemplateAdmin($htmlListPosts, "Écrivez votre article - Blog de Jean Forteroche");
    return $htmlListPostsInTemplate;
  }

  static function addArticle() {
    session_start();
    $adminManager = new \JeanForteroche\Blog\Model\PostManager();
    $adminManager->postArticle();
    header("location: index.php?action=manageArticle");
  }

  static function editArticle() {
    session_start();
    $adminManager = new \JeanForteroche\Blog\Model\PostManager();
    $adminManager->postEditedArticle();
    header("location: index.php?action=manageArticle");
  }

  static function deleteArticle() {
    session_start();
    $adminManager = new \JeanForteroche\Blog\Model\PostManager();
    $adminManager->postDeleteArticle();
    header("location: index.php?action=manageArticle");
  }

  static function moderateComment() {
    session_start();
    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $comments = $commentManager->getWaitingComments();
    $postView = getView('admin/approveComments.php', [
      "comments" => $comments
    ]);

    $htmlListPostsInTemplate = loadTemplateAdmin($postView, "Modérer ou supprimer les commentaires - Blog de Jean Forteroche");
    return $htmlListPostsInTemplate;
  }

  static function validateComment() {
    session_start();
    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $commentManager->confirmComments();
    header("location: index.php?action=manageComments");
  }

  static function editComment() {
    session_start();
    $adminManager = new \JeanForteroche\Blog\Model\CommentManager();
    $adminManager->postEditedComment();
    header("location: index.php?action=manageComments");
  }

  static function deleteComment() {
    session_start();
    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $commentManager->supprComments();
    header("location: index.php?action=manageComments");
  }

  }
