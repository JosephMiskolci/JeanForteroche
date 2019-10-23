<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class PostController {

  static function viewPost($id) {
    if (!isset($id)) throw new Exception('Aucun identifiant de billet envoyé');

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();

    $post = $postManager->getPost($id);
    $comments = $commentManager->getComments($id);

    $postView = getView('view/postView.php', [
      "post" => $post,
      "comments" => $comments
    ]);

    $htmlPostInTemplate = loadTemplate(
      $postView,
      "Publication - mon super nom de publication",
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function addComment($postId, $author, $comment) {
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

}
