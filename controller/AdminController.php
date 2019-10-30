<?php

require_once('model/AdminManager.php');

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
    $adminManager = new \JeanForteroche\Blog\Model\AdminManager();
    $adminManager->postArticle();
    header("location: index.php?action=viewWritingArticle");


  }
}
