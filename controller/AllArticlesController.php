<?php

require_once('model/PostManager.php');

class AllArticlesController {

  /*
  Affiche la page avec la liste des posts dans un template
  */
  static function AllArticles() {
    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $posts = $postManager->getAllPosts();
    $postView = getView('view/listArticles.php', ['posts' => $posts] );

    $htmlPostInTemplate = loadTemplate(
      $postView,
      "Découvrez les dernières publications de Jean Forteroche",
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

}
