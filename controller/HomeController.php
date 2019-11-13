<?php

require_once('model/PostManager.php');

class HomeController {

  /*
  Affiche la page avec la liste des posts dans un template
  */
  static function viewHome() {

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $posts = $postManager->getPosts();
    $htmlListPosts = getView('view/home.php', ['posts' => $posts]);
    $htmlListPostsInTemplate = loadTemplate($htmlListPosts, "Page d'accueil");
    return $htmlListPostsInTemplate;
  }

  static function viewBibliography() {

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $posts = $postManager->getPosts();
    $postView = getView('view/bibliography.php', ['posts' => $posts] );

    $htmlPostInTemplate = loadTemplate(
      $postView,
      "Bibliographie de Jean Forteroche",
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function error() {
    
    $htmlListPosts = getView('view/error.php', NULL);
    $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Erreur ! Cette page n'existe pas !",["public/css/styleArticle.css"]);
    return $htmlListPostsInTemplate;

  }

}
