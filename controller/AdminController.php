<?php

require_once('model/CommentManager.php');
require_once('model/PostManager.php');
require_once('model/AdminManager.php');

class AdminController {

  /*
  Affiche la page avec la liste des posts dans un template
  */
  static function viewHomeAdmin() {
    
    $htmlListPosts = getView('view/admin/homeAdmin.php', null);
    $htmlListPostsInTemplate = loadTemplateAdmin($htmlListPosts, "Page d'administration du blog de Jean Forteroche");
    return $htmlListPostsInTemplate;
  }

  static function viewWritingArticle() {

    $htmlListPosts = getView('view/admin/publishArticle.php', null);
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

    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $comments = $commentManager->getWaitingComments();
    $postView = getView('view/admin/approveComments.php', [
      "comments" => $comments
    ]);

    $htmlListPostsInTemplate = loadTemplateAdmin($postView, "Modérer ou supprimer les commentaires - Blog de Jean Forteroche");
    return $htmlListPostsInTemplate;
  }

  static function validateComment() {

    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $commentManager->confirmComments();
    header("location: index.php?action=manageComments");
  }

  static function editComment() {

    $adminManager = new \JeanForteroche\Blog\Model\CommentManager();
    $adminManager->postEditedComment();
    header("location: index.php?action=manageComments");
  }

  static function editCommentbyUser() {

    $adminManager = new \JeanForteroche\Blog\Model\CommentManager();
    $adminManager->postEditedComment();
    header("location: index.php?action=profile");
  }

  static function deleteComment() {

    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $commentManager->supprComments();
    header("location: index.php?action=manageComments");
  }
  static function deleteCommentbyUser() {

    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $commentManager->supprComments();
    header("location: index.php?action=profile");
  }

  static function adminActionsUsers() {

    $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
    $users = $usersManager->getAllUsers();
    $postView = getView('view/admin/moderateUsers.php', [
      "member_space" => $users
    ]);

    $htmlListPostsInTemplate = loadTemplateAdmin($postView, "Modérer ou supprimer les commentaires - Blog de Jean Forteroche");
    return $htmlListPostsInTemplate;
  }

  static function adminUsers() {

    $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
    $users = $usersManager->validAdminUsers();
    header("location: index.php?action=manageUsers");
  }

  static function RemoveAdminUsers() {

    $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
    $users = $usersManager->unvalidAdminUsers();
    header("location: index.php?action=manageUsers");
  }

  static function moderatorUsers() {

    $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
    $users = $usersManager->validModeratorUsers();
    header("location: index.php?action=manageUsers");
  }

  static function RemoveModeratorUsers() {

    $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
    $users = $usersManager->unvalidModeratorUsers();
    header("location: index.php?action=manageUsers");
  }

  static function deleteUsers() {

    $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
    $users = $usersManager->deleteUsers();
    header("location: index.php?action=manageUsers");
  }

  }
