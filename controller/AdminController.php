<?php

require_once('model/Manager.php');

class AdminController {

  /*
  Affiche la page avec la liste des posts dans un template
  */
  static function viewHomeAdmin() {
    $htmlListPosts = getView('admin/homeAdmin.php', null);
    $htmlListPostsInTemplate = loadTemplateAdmin($htmlListPosts, "Page d'administration du blog de Jean Forteroche");
    return $htmlListPostsInTemplate;
  }

  static function addArticle($postId, $author, $comment) {
    if (isset($postId) && $postId > 0) {
        if (!empty($author) && !empty($comment)) {
          $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
          $commentManager->postComment($postId, $author, $comment);
          header("location: index.php?action=post&id=" .$postId);

        }
        else {
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
    }
    else {
        throw new Exception('Aucun identifiant de billet envoyé');
    }
}
