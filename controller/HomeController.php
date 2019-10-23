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

}
