<?php

require_once('model/MembersManager.php');

class MembersController {

  static function inscription() {
    $inscriptionManager = new \JeanForteroche\Blog\Model\MembersManager();
    $inscription = $inscriptionManager->membersInscription();
    $htmlinscription = getView('view/members/inscription.php', null);
    $htmlinscriptionInTemplate = loadTemplateMember($htmlinscription, "Inscrivez-vous sur le blog de Jean Forteroche",["public/css/styleArticle.css"]);
    return $htmlinscriptionInTemplate;
  }

  static function connexion() {

    $commentManager = new \JeanForteroche\Blog\Model\MembersManager();
    $comments = $commentManager->membersConnexion();
    $htmlListPosts = getView('view/members/connexion.php', null);
    $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Connectez-vous sur le blog de Jean Forteroche",["public/css/styleArticle.css"]);
    header('index.php?action=profile&id' . $_SESSION['id']);
    return $htmlListPostsInTemplate;
  }

  static function profile() {

    $membersManager = new \JeanForteroche\Blog\Model\MembersManager();
    $members = $membersManager->membersProfile();

    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $comments = $commentManager->getUserComment($_SESSION['pseudo']);

    $htmlListPosts = getView('view/members/profile.php', [
      "comments" => $comments
    ]);
    $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Connectez-vous sur le blog de Jean Forteroche",["public/css/styleArticle.css"]);
    return $htmlListPostsInTemplate;
  }

  static function disconnect() {

    $commentManager = new \JeanForteroche\Blog\Model\MembersManager();
    $comments = $commentManager->membersDisconnect();
    header("location:index.php");
  }

  static function memberEdition() {

    $commentManager = new \JeanForteroche\Blog\Model\MembersManager();
    $comments = $commentManager->membersEdition();
    $htmlinscription = getView('view/members/editProfile.php', null);
    $htmlinscriptionInTemplate = loadTemplateMember($htmlinscription, "Inscrivez-vous sur le blog de Jean Forteroche",["public/css/styleArticle.css"]);
    return $htmlinscriptionInTemplate;
  }
}
