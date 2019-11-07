<?php

require_once('model/PostManager.php');

class HomeController {

  /*
  Affiche la page avec la liste des posts dans un template
  */
  static function viewHome() {
    session_start();
    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $posts = $postManager->getPosts();
    $htmlListPosts = getView('view/home.php', ['posts' => $posts]);
    $htmlListPostsInTemplate = loadTemplate($htmlListPosts, "Page d'accueil");
    return $htmlListPostsInTemplate;
  }

  static function viewBibliography() {
    session_start();
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

}
