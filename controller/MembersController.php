<?php

require_once('model/MembersManager.php');

class MembersController {

  static function inscription() {
    $commentManager = new \JeanForteroche\Blog\Model\MembersManager();
    $comments = $commentManager->membersInscription();
    $htmlListPosts = getView('members/inscription.php', null);
    $htmlListPostsInTemplate = loadTemplate($htmlListPosts, "Inscrivez-vous sur le blog de Jean Forteroche",["public/css/styleArticle.css"]);
    return $htmlListPostsInTemplate;
  }

  static function connexion() {
    $commentManager = new \JeanForteroche\Blog\Model\MembersManager();
    $comments = $commentManager->membersConnexion();
    $htmlListPosts = getView('members/connexion.php', null);
    $htmlListPostsInTemplate = loadTemplate($htmlListPosts, "Connectez-vous sur le blog de Jean Forteroche",["public/css/styleArticle.css"]);
    return $htmlListPostsInTemplate;
  }

}
