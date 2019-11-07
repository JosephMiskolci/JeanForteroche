<?php

require_once('model/MembersManager.php');

class MembersController {

  static function inscription() {
    $inscriptionManager = new \JeanForteroche\Blog\Model\MembersManager();
    $inscription = $inscriptionManager->membersInscription();
    $htmlinscription = getView('members/inscription.php', null);
    $htmlinscriptionInTemplate = loadTemplateMember($htmlinscription, "Inscrivez-vous sur le blog de Jean Forteroche",["public/css/styleArticle.css"]);
    return $htmlinscriptionInTemplate;
  }

  static function connexion() {
    session_start();
    $commentManager = new \JeanForteroche\Blog\Model\MembersManager();
    $comments = $commentManager->membersConnexion();
    $htmlListPosts = getView('members/connexion.php', null);
    $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Connectez-vous sur le blog de Jean Forteroche",["public/css/styleArticle.css"]);
    return $htmlListPostsInTemplate;
  }
  static function profile() {
    session_start();
    $membersManager = new \JeanForteroche\Blog\Model\MembersManager();
    $members = $membersManager->membersProfile();
    $htmlListPosts = getView('members/profile.php', null);
    $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Connectez-vous sur le blog de Jean Forteroche",["public/css/styleArticle.css"]);
    return $htmlListPostsInTemplate;
  }
  static function disconnect() {
    session_start();
    $commentManager = new \JeanForteroche\Blog\Model\MembersManager();
    $comments = $commentManager->membersDisconnect();
    header("location:index.php");
  }
  static function memberEdition() {
    session_start();
    $commentManager = new \JeanForteroche\Blog\Model\MembersManager();
    $comments = $commentManager->membersEdition();
    $htmlinscription = getView('members/editProfile.php', null);
    $htmlinscriptionInTemplate = loadTemplateMember($htmlinscription, "Inscrivez-vous sur le blog de Jean Forteroche",["public/css/styleArticle.css"]);
    return $htmlinscriptionInTemplate;
  }
}
