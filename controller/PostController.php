<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class PostCommentsController {

  static function viewPost($id) {
    session_start();
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
      $post['title'],
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function editComment($postId) {

    session_start();
    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $comments = $commentManager->showComment($postId);

    $postView = getView('admin/editComment.php', [
      "comments" => $comments
    ]);

    $htmlPostInTemplate = loadTemplateAdmin(
      $postView,
      "Modifiez ce commentaire ! - Blog de Jean Forteroche",
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function editPost($id) {
    session_start();
    if (!isset($id)) throw new Exception('Aucun identifiant de billet envoyé');

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $post = $postManager->getPost($id);

    $postView = getView('admin/editArticles.php', [
      "post" => $post,
    ]);

    $htmlPostInTemplate = loadTemplateAdmin(
      $postView,
      $post['title'],
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function viewDeletePost($id) {
    session_start();
    if (!isset($id)) throw new Exception('Aucun identifiant de billet envoyé');

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $post = $postManager->getPost($id);

    $postView = getView('admin/deleteArticle.php', [
      "post" => $post,
    ]);

    $htmlPostInTemplate = loadTemplateAdmin(
      $postView,
      $post['title'],
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function AllArticles() {
    session_start();
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

  static function AllArticlesAdmin() {
    session_start();
    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $posts = $postManager->getAllPosts();
    $postView = getView('admin/manageArticles.php', ['posts' => $posts] );

    $htmlPostInTemplate = loadTemplateAdmin(
      $postView,
      "Éditer ou supprimer un article - Blog de Jean Forteroche",
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function addComment($postId, $author, $comment) {
    session_start();
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
