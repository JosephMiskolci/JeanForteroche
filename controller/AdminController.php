<?php
require_once 'model/CommentManager.php';
require_once 'model/PostManager.php';
require_once 'model/AdminManager.php';

class AdminController
{

    /*
    Affiche la page avec la liste des posts dans un template
     */
    public static function viewHomeAdmin()
    {

        $htmlListPosts           = getView('view/admin/homeAdmin.php', null);
        $htmlListPostsInTemplate = loadTemplateAdmin($htmlListPosts, "Page d'administration du blog de Jean Forteroche");
        return $htmlListPostsInTemplate;
    }

    public static function viewWritingArticle()
    {

        $htmlListPosts           = getView('view/admin/publishArticle.php', null);
        $htmlListPostsInTemplate = loadTemplateAdmin($htmlListPosts, "Écrivez votre article - Blog de Jean Forteroche");
        return $htmlListPostsInTemplate;
    }

    public static function addArticle()
    {

        if (isset($_POST['name']) and isset($_POST['mytextarea'])) {
            $adminManager = new \JeanForteroche\Blog\Model\PostManager();
            $adminManager->postArticle($_POST['name'], $_POST['mytextarea']);
            header("location: index.php?action=manageArticle");
        }
    }

    public static function editArticle()
    {

        if (isset($_POST['name']) and isset($_POST['mytextarea'])) {
            $adminManager = new \JeanForteroche\Blog\Model\PostManager();
            $adminManager->postEditedArticle($_POST['name'], $_POST['mytextarea'], $_GET['id']);
            header("location: index.php?action=manageArticle");
        }
    }

    public static function deleteArticle()
    {

        if (isset($_POST['send'])) {
            $adminManager = new \JeanForteroche\Blog\Model\PostManager();
            $adminManager->postDeleteArticle($_GET['id']);
            header("location: index.php?action=manageArticle");
        } else {
            new Exception("error");
            header("location: index.php");
        }
    }

    public static function moderateComment()
    {

        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
        $comments       = $commentManager->getWaitingComments();
        $postView       = getView('view/admin/approveComments.php', ["comments" => $comments]);

        $htmlListPostsInTemplate = loadTemplateAdmin($postView, "Modérer ou supprimer les commentaires - Blog de Jean Forteroche");
        return $htmlListPostsInTemplate;
    }

    public static function moderateFlagComment()
    {

        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
        $comments       = $commentManager->getAllComments();
        $flags          = $commentManager->showFlagComment();

        $postView = getView('view/admin/manageComments.php', ["comments" => $comments, 'flags' => $flags]);

        $htmlListPostsInTemplate = loadTemplateAdmin($postView, "Modérer ou supprimer les commentaires - Blog de Jean Forteroche");
        return $htmlListPostsInTemplate;
    }

    public static function validateComment()
    {

        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
        $commentManager->confirmComments($_GET['id']);
        header("location: index.php?action=admin");
    }

    public static function postCommentUnValidated()
    {

        $adminManager = new \JeanForteroche\Blog\Model\CommentManager();
        $adminManager->postEditedComment($_GET['id'], $_POST['mytextarea']);
        header("location: index.php?action=manageComments");
    }

    public static function postCommentValidated()
    {

        $adminManager = new \JeanForteroche\Blog\Model\CommentManager();
        $adminManager->postEditedComment($_GET['id'], $_POST['mytextarea']);
        header("location: index.php?action=manageFlagComments");
    }

    public static function postCommentbyUser()
    {

        $adminManager = new \JeanForteroche\Blog\Model\CommentManager();
        $adminManager->postEditedComment($_GET['id'], $_POST['mytextarea']);
        header("location: index.php?action=profile");
    }

    public static function deleteComment()
    {

        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
        $commentManager->supprComments($_GET['id']);
        header("location: index.php?action=manageComments");
    }
    public static function deleteCommentbyUser()
    {

        $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
        $commentManager->supprComments($_GET['id']);
        header("location: index.php?action=profile");
    }

    public static function adminActionsUsers()
    {

        $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
        $users        = $usersManager->getAllUsers();
        $postView     = getView('view/admin/moderateUsers.php', ["member_space" => $users]);

        $htmlListPostsInTemplate = loadTemplateAdmin($postView, "Modérer ou supprimer les commentaires - Blog de Jean Forteroche");
        return $htmlListPostsInTemplate;
    }

    public static function adminUsers()
    {

        $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
        $users        = $usersManager->validAdminUsers($_GET['id']);
        header("location: index.php?action=manageUsers");
    }

    public static function RemoveAdminUsers()
    {

        $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
        $users        = $usersManager->unvalidAdminUsers($_GET['id']);
        header("location: index.php?action=manageUsers");
    }

    public static function moderatorUsers()
    {

        $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
        $users        = $usersManager->validModeratorUsers($_GET['id']);
        header("location: index.php?action=manageUsers");
    }

    public static function RemoveModeratorUsers()
    {

        $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
        $users        = $usersManager->unvalidModeratorUsers($_GET['id']);
        header("location: index.php?action=manageUsers");
    }

    public static function deleteUsers()
    {

        $usersManager = new \JeanForteroche\Blog\Model\AdminManager();
        $users        = $usersManager->deleteUsers($_GET['id']);
        header("location: index.php?action=manageUsers");
    }
}
