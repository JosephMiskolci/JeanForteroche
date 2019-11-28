<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class PostCommentsController {

  static function viewPost() {

    if (!isset($_GET['id'])) {
      exit('Erreur fatale. <a href="index.php">Revenir à l\'accueil</a>');
  }

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

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

  static function editComment() {

    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $comments = $commentManager->showComment($_GET['id']);

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

  static function editCommentbyUser() {

    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $comments = $commentManager->showComment($_GET['id']);

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

    if (!isset($id)) { ?>
    <script>
      alert("Aucun identifiant de billet envoyé");
      window.location.replace('index.php?action=allArticles');
      </script>
      <?php
    }

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $post = $postManager->getPost($id);

    $postView = getView('view/admin/editArticles.php', [
      "post" => $post
    ]);

    $htmlPostInTemplate = loadTemplateAdmin(
      $postView,
      $post['title'],
      ["public/css/styleArticle.css"]
    );
    return $htmlPostInTemplate;
  }

  static function viewDeletePost($id) {

    if (!isset($id)) {?>
    <script>
      alert("Aucun identifiant de billet envoyé");
      window.location.replace('index.php?action=allArticles');
      </script>
      <?php
    }

    $postManager = new \JeanForteroche\Blog\Model\PostManager();
    $post = $postManager->getPost($id);

    $postView = getView('view/admin/deleteArticle.php', [
      "post" => $post
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
    $postView = getView('view/listArticles.php', [
      'posts' => $posts
      ] );

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
    $postView = getView('view/admin/manageArticles.php', [
      'posts' => $posts
      ] );

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
          $commentManager->postComment($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);
          header("location: index.php?action=post&id=" .$_GET['id']);

        }
        else {
          ?>
          <script>
            alert("Tous les champs ne sont pas remplis !");
            window.location.replace("index.php?action=allArticles");
            </script>
            <?php
        }
    }
    else {
      ?>
      <script>
        alert("Aucun identifiant de billet envoyé !");
        window.location.replace("index.php?action=allArticles");
        </script>
        <?php
    }

  }

}
