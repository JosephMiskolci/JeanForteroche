<?php
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';

class CommentsController
{

    public static function viewPost()
    {
        if (!isset($_GET['id'])) {
            exit('Erreur fatale. <a href="index.php">Revenir à l\'accueil</a>');
        }

        $postManager    = new \JeanForteroche\Blog\Model\PostManager();
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();

        $post     = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
        $flags    = $commentManager->showFlagComment();

        $postView = getView('view/postView.php', ["post" => $post, "comments" => $comments, 'flags' => $flags]);

        $htmlPostInTemplate = loadTemplate($postView, $post['title'], ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function editComment()
    {
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
        $comments       = $commentManager->showComment($_GET['id']);

        $postView = getView('view/admin/editComment.php', ["comments" => $comments]);

        $htmlPostInTemplate = loadTemplateAdmin($postView, "Modifiez ce commentaire ! - Blog de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function editCommentValidated()
    {
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
        $comments       = $commentManager->showComment($_GET['id']);

        $postView = getView('view/admin/editCommentValidated.php', ["comments" => $comments]);

        $htmlPostInTemplate = loadTemplateAdmin($postView, "Modifiez ce commentaire ! - Blog de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function editCommentbyUser()
    {
        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
        $comments       = $commentManager->showComment($_GET['id']);

        $postView = getView('view/members/editCommentbyUser.php', ["comments" => $comments]);

        $htmlPostInTemplate = loadTemplateMember($postView, "Modifiez ce commentaire ! - Blog de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function editPost()
    {

        if (!isset($_GET['id'])) {
            $withAlert   = "Aucun identifiant de billet envoyé";
            $withReplace = 'index.php?action=allArticles';
        }

        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $post        = $postManager->getPost(($_GET['id']));

        $postView = getView('view/admin/editArticles.php', ["post" => $post]);

        $htmlPostInTemplate = loadTemplateAdmin($postView, $post['title'], ["public/css/styleArticle.css"], $withAlert, $withReplace);
        return $htmlPostInTemplate;
    }

    public static function viewDeletePost()
    {

        if (!isset($_GET['id'])) {
            $withAlert   = "Aucun identifiant de billet envoyé";
            $withReplace = 'index.php?action=allArticles';
        }

        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $post        = $postManager->getPost($_GET['id']);

        $postView = getView('view/admin/deleteArticle.php', ["post" => $post]);

        $htmlPostInTemplate = loadTemplateAdmin($postView, $post['title'], ["public/css/styleArticle.css"], $withAlert, $withReplace);
        return $htmlPostInTemplate;
    }

    public static function AllArticles()
    {

        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $posts       = $postManager->getAllPosts();
        $postView    = getView('view/listArticles.php', ['posts' => $posts]);

        $htmlPostInTemplate = loadTemplate($postView, "Découvrez les dernières publications de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function AllArticlesAdmin()
    {

        $postManager = new \JeanForteroche\Blog\Model\PostManager();
        $posts       = $postManager->getAllPosts();
        $postView    = getView('view/admin/manageArticles.php', ['posts' => $posts]);

        $htmlPostInTemplate = loadTemplateAdmin($postView, "Éditer ou supprimer un article - Blog de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function addComment()
    {

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['comment'])) {
                $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
                $commentManager->postComment($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);
                header("location: index.php?action=post&id=" . $_GET['id']);
            } else {
                $withAlert   = "Tous les champs ne sont pas remplis !";
                $withReplace = 'index.php?action=allArticles';
            }
        } else {
            $withAlert   = "Aucun identifiant de billet envoyé !";
            $withReplace = 'index.php?action=allArticles';
        }

        $postView           = getView(null, null, $withAlert, $withReplace);
        $htmlPostInTemplate = loadTemplateAdmin($postView, "", $withAlert, $withReplace);
        return $htmlPostInTemplate;

    }

    public static function flagComment()
    {
        if (isset($_SESSION['id'])) {
            $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
            $commentManager->addFlagComment($_GET['id'], $_SESSION['id']);
            header("location:" . $_SERVER['HTTP_REFERER']);
        } else {
            header("location: index.php?action=error");
        }
    }

    public static function unflagComment()
    {
        if (isset($_SESSION['id'])) {
            $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
            $commentManager->removeFlagComment($_GET['id'], $_SESSION['id']);
            header("location:" . $_SERVER['HTTP_REFERER']);
        } else {
            header("location: index.php?action=error");
        }
    }
}
