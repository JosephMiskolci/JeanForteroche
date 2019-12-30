<?php
require_once 'model/PostManager.php';

class HomeController
{

    /*
    Affiche la page avec la liste des posts dans un template
     */
    public static function viewHome()
    {
        $postManager             = new \JeanForteroche\Blog\Model\PostManager();
        $posts                   = $postManager->getPosts();
        $htmlListPosts           = getView('view/home.php', ['posts' => $posts]);
        $htmlListPostsInTemplate = loadTemplate($htmlListPosts, "Page d'accueil");
        return $htmlListPostsInTemplate;
    }

    public static function viewBibliography()
    {
        $postManager        = new \JeanForteroche\Blog\Model\PostManager();
        $posts              = $postManager->getPosts();
        $postView           = getView('view/bibliography.php', ['posts' => $posts]);
        $htmlPostInTemplate = loadTemplate($postView, "Bibliographie de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function viewAllBooks()
    {
        $postManager        = new \JeanForteroche\Blog\Model\PostManager();
        $posts              = $postManager->getPosts();
        $postView           = getView('view/allBooks.php', ['posts' => $posts]);
        $htmlPostInTemplate = loadTemplate($postView, "Découvrez tous les ouvrages de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function error()
    {
        $htmlListPosts           = getView('view/error.php', null);
        $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Erreur ! Cette page n'existe pas !", ["public/css/styleArticle.css"]);
        return $htmlListPostsInTemplate;
    }

    public static function form()
    {

        $htmlListPosts           = getView('view/formView.php', null);
        $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Contactez les gérants du site en cas de soucis technique", ["public/css/styleArticle.css"]);
        return $htmlListPostsInTemplate;
    }

    public static function viewBookOne()
    {
        $postView           = getView('view/bookOne.php', null);
        $htmlPostInTemplate = loadTemplate($postView, "Découvrez tous les ouvrages de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function viewBookTwo()
    {
        $postView           = getView('view/bookTwo.php', null);
        $htmlPostInTemplate = loadTemplate($postView, "Découvrez tous les ouvrages de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function viewBookThree()
    {
        $postView           = getView('view/bookThree.php', null);
        $htmlPostInTemplate = loadTemplate($postView, "Découvrez tous les ouvrages de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function viewBookFour()
    {
        $postView           = getView('view/allBooks.php', null);
        $htmlPostInTemplate = loadTemplate($postView, "Découvrez tous les ouvrages de Jean Forteroche", ["public/css/styleArticle.css"]);
        return $htmlPostInTemplate;
    }

    public static function sendform()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $envoi = null;

            $to   = "nielebung@gmail.com";
            $from = "jean-forteroche";

            ini_set("SMTP", "smtp.mondomaine.com"); // Pour les hébergements mutualisés Windows de OVH
            $Subject = $_POST['objet'];
            $message = $_POST['message'];
            $mail    = $_POST['mail'];

            $mail_Data = "$message <br> \n";

            $mail_Data .= "$mail <br> \n";

            $headers = "MIME-Version: 1.0 \n";

            $headers .= "Content-type: text/html; charset=iso-8859-1 \n";

            $headers .= "From: $from  \n";

            $headers .= "Disposition-Notification-To: $from  \n";

            $headers .= "X-Priority: 1  \n";

            $headers .= "X-MSMail-Priority: High \n";

            $CR_Mail = true;

            $CR_Mail = @mail($to, $Subject, $mail_Data, $headers);

            if ($CR_Mail === false) {

                $envoi = false;
            } else {

                $envoi = true;
            }
        }

        $htmlListPosts           = getView('view/formView.php', ["envoi" => $envoi]);
        $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Contactez les gérants du site en cas de soucis technique", ["public/css/styleArticle.css"]);
        return $htmlListPostsInTemplate;
    }
}
