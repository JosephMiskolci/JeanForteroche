<?php

require_once('model/CommentManager.php');
require_once('model/PostManager.php');

class AdminController {

  /*
  Affiche la page avec la liste des posts dans un template
  */
  static function viewHomeAdmin() {
    $htmlListPosts = getView('admin/homeAdmin.php', null);
    $htmlListPostsInTemplate = loadTemplateAdmin($htmlListPosts, "Page d'administration du blog de Jean Forteroche");
    return $htmlListPostsInTemplate;
  }

  static function viewWritingArticle() {
    $htmlListPosts = getView('admin/publishArticle.php', null);
    $htmlListPostsInTemplate = loadTemplateAdmin($htmlListPosts, "Écrivez votre article - Blog de Jean Forteroche");
    return $htmlListPostsInTemplate;
  }

  static function addArticle() {
    $adminManager = new \JeanForteroche\Blog\Model\PostManager();
    $adminManager->postArticle();
    header("location: index.php?action=manageArticle");
  }

  static function editArticle() {
    $adminManager = new \JeanForteroche\Blog\Model\PostManager();
    $adminManager->postEditedArticle();
    header("location: index.php?action=manageArticle");
  }

  static function deleteArticle() {
    $adminManager = new \JeanForteroche\Blog\Model\PostManager();
    $adminManager->postDeleteArticle();
    header("location: index.php?action=manageArticle");
  }

  static function moderateComment() {
    $postManager = new \JeanForteroche\Blog\Model\CommentManager();
    $posts = $postManager->getWaitingComments();
    $postView = getView('admin/approveComments.php', $comments);

    $htmlListPostsInTemplate = loadTemplateAdmin($htmlListPosts, "Modérer ou supprimer les commentaires - Blog de Jean Forteroche");
    return $htmlListPostsInTemplate;
  }
  }
