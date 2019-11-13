<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class PostCommentsController {

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
      $post['title'],
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function editComment($postId) {

    
    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $comments = $commentManager->showComment($postId);

    $postView = getView('view/admin/editComment.php', [
      "comments" => $comments
    ]);

    $htmlPostInTemplate = loadTemplateAdmin(
      $postView,
      "Modifiez ce commentaire ! - Blog de Jean Forteroche",
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function editCommentbyUser($postId) {


    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $comments = $commentManager->showComment($postId);

    $postView = getView('view/members/editCommentbyUser.php', [
      "comments" => $comments
    ]);

    $htmlPostInTemplate = loadTemplateMember(
      $postView,
      "Modifiez ce commentaire ! - Blog de Jean Forteroche",
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function editPost($id) {

    if (!isset($id)) throw new Exception('Aucun identifiant de billet envoyé');

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $post = $postManager->getPost($id);

    $postView = getView('view/admin/editArticles.php', [
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

    if (!isset($id)) throw new Exception('Aucun identifiant de billet envoyé');

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $post = $postManager->getPost($id);

    $postView = getView('view/admin/deleteArticle.php', [
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

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $posts = $postManager->getAllPosts();
    $postView = getView('view/admin/manageArticles.php', ['posts' => $posts] );

    $htmlPostInTemplate = loadTemplateAdmin(
      $postView,
      "Éditer ou supprimer un article - Blog de Jean Forteroche",
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function addComment() {

    if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['comment'])) {
          $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
          $commentManager->postComment($postId, $author, $comment);
          header("location: index.php?action=post&id=" .$_GET['id']);

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
