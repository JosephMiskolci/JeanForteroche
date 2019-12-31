<?php
require_once('model/MembersManager.php');

class MembersController
{

  static function viewInscription()
  {
    $htmlinscription = getView('view/members/inscription.php', null);
    $htmlinscriptionInTemplate = loadTemplateMember($htmlinscription, "Inscrivez-vous sur le blog de Jean Forteroche", ["public/css/styleArticle.css"]);
    return $htmlinscriptionInTemplate;
  }

  static function inscription()
  {
    $pseudo = $_POST['pseudo'];
    $mail = $_POST['mail'];
    $mail2 = $_POST['mail2'];
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['mdp2'];
    $mdpHached = password_hash(($_POST['mdp']), PASSWORD_DEFAULT);

    // on vérifie si le pseudo est déjà pris
    if (isset($pseudo) || isset($mail) || isset($mail2) || isset($mdp) || isset($mdp2)) {
    $pseudoManager = new \JeanForteroche\Blog\Model\MembersManager();
    $pseudo2 = $pseudoManager->searchUserByPseudo($pseudo);
    $pseudoAlreadyUse = $pseudo2->rowCount();

    // on vérifie si l'email est déjà pris
    $memberManager = new \JeanForteroche\Blog\Model\MembersManager();
    $resUserByMail = $memberManager->searchUserByMail($mail);
    $mailAlreadyUse = $resUserByMail->rowCount();
    }

    $errors = [
      "BAD_LOGIN" => [
        "message" => "Pseudo déjà utilisé !",
        "condition" => $pseudoAlreadyUse
      ],
      "BAD_PASSWD_VERIF" => [
        "message" => "Vos mots de passes ne correspondent pas !",
        "condition" => ($mdp != $mdp2)
      ],
      "EMAIL_ALREADY_USE" => [
        "message" => "Adresse mail déjà utilisée !",
        "condition" => $mailAlreadyUse
      ],
      "EMAIL_NOT_VALID"   => [
        "message" => "Votre adresse mail n'est pas valide !",
        "condition" => (filter_var($mail, FILTER_VALIDATE_EMAIL) == false)
      ],
      "BAD_EMAIL_VERIF" => [
        "message" => "Vos adresses mail ne correspondent pas !",
        "condition" => ($mail != $mail2)
      ],
      "PSEUDO_TOO_LONG" => [
        "message" => "Votre pseudo ne doit pas dépasser 255 caractères !",
        "condition" => (strlen($pseudo) > 255)
      ],
      "FILL_ALL" => [
        "message" => "Tous les champs doivent être complétés ! Vous devez recommencer votre inscription.",
        "condition" => (empty($pseudo) || empty($mail) || empty($mail2) || empty($mdp) || empty($mdp2))
      ]
    ];

    $numberOfErrors = 0;
    foreach ($errors as $error) {
      if ($error["condition"]) {
        $numberOfErrors++;
        $errortext = $error['message'];
      }
    }

    if ($numberOfErrors == 0) {
      $pseudoManager = new \JeanForteroche\Blog\Model\MembersManager();
      $pseudo = $pseudoManager->insertNewMembers($pseudo, $mail, $mdpHached);

      $withAlert = 'Votre compte a bien été créé ! Cliquez sur "OK" pour retourner sur la page de connexion et connectez-vous !';
      $withReplace = 'index.php?action=connexion';
    }

    $htmlinscription = getView('view/members/inscription.php', ["errortext" => $errortext, 'numberOfErrors' => $numberOfErrors]);
    $htmlinscriptionInTemplate = loadTemplateMember($htmlinscription, "Inscrivez-vous sur le blog de Jean Forteroche", ["public/css/styleArticle.css"], $withAlert, $withReplace);
    return $htmlinscriptionInTemplate;
  }

  static function connexion()
  {
    if (isset($_POST['formconnexion'])) {
      $mail = $_POST['mailconnect'];

      // Permet d'éviter l'attaque par force brute en instaurant une pause d'une seconde entre chaque utilisation de la fonction connexion()
      sleep(1);

      //On vérifie dans la base de données les informations
      if (isset($_POST['formconnexion']) || isset($mail)) {
      $membersManager = new \JeanForteroche\Blog\Model\MembersManager();
      $members = $membersManager->connectUserByMail($mail);
      $resultat = $members->fetch();
      }

      $errors = [
        "BAD_PASSWD_VERIF" => [
          "message" => "Identifiant ou mot de passe incorrect.",
          "condition" => (!$resultat or !password_verify($_POST['mdpconnect'], $resultat['password']))
        ],
        "FILL_ALL" => [
          "message" => "Renseignez un pseudo et un mot de passe.",
          "condition" => (!$resultat)
        ]
      ];

      $numberOfErrors = 0;
      foreach ($errors as $error) {
        if ($error["condition"]) {
          $numberOfErrors++;
          $errortext = $error['message'];
        }
      }

      if ($numberOfErrors == 0) {
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $resultat['pseudo'];
        $_SESSION['mail'] = $resultat['mail'];
        $_SESSION['password'] = $resultat['password'];
        $_SESSION['admin'] = $resultat['admin'];
        $_SESSION['moderator'] = $resultat['moderator'];

        $withAlert = 'Vous êtes désormais connecté ! Cliquez sur "OK" pour être redirigé vers votre profil.';
        $withReplace = 'index.php?action=profile';
      }
      $members->closeCursor();
    }

    $htmlListPosts = getView('view/members/connexion.php', ["errortext" => $errortext, 'numberOfErrors' => $numberOfErrors]);
    $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Connectez-vous sur le blog de Jean Forteroche", ["public/css/styleArticle.css"], $withAlert, $withReplace);
    return $htmlListPostsInTemplate;
  }

  static function profile()
  {
    $sessionID = $_SESSION['id'];
    $pseudo = $_SESSION['pseudo'];

    $membersManager = new \JeanForteroche\Blog\Model\MembersManager();
    $members = $membersManager->membersProfile($sessionID);

    $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
    $comments = $commentManager->getUserComment($pseudo);

    $htmlListPosts = getView('view/members/profile.php', ["comments" => $comments]);
    $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Connectez-vous sur le blog de Jean Forteroche", ["public/css/styleArticle.css"]);
    return $htmlListPostsInTemplate;
  }

  static function disconnect()
  {

    $_SESSION = array();
    session_destroy();
    header("location:index.php");
  }

  static function memberEdition()
  {
    $sessionID = $_SESSION['id'];
    $mdp1Hached = password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);

    if (isset($_SESSION['id'])) {
      $membersManager = new \JeanForteroche\Blog\Model\MembersManager();
      $members = $membersManager->searchUserbySessionID($sessionID);
      $user = $members->fetch();

      $errors = [
        "BAD_PASSWD_VERIF" => [
          "message" => "Vos mots de passe ne correspondent pas !",
          "condition" => ($_POST['newmdp1'] != $_POST['newmdp2'])
        ],
        "FILL_ALL" => [
          "message" => "Tous les champs doivent être complétés ! Vous devez recommencer votre inscription.",
          "condition" => (empty($_POST['newmdp1']) || empty($_POST['newmdp1']) || empty($_POST['newmdp2']) || empty($_POST['newmdp2']))
        ]
      ];

      $numberOfErrors = 0;
      foreach ($errors as $error) {
        if ($error["condition"]) {
          $numberOfErrors++;
          $errortext = $error['message'];
        }
      }
      if ($numberOfErrors == 0) {
        $membersManager = new \JeanForteroche\Blog\Model\MembersManager();
        $members = $membersManager->editPasswordbyUser($sessionID, $mdp1Hached);
        header('index.php?action=profile&id' . $_SESSION['id']);
        $withAlert = "Votre mot de passe à bien été modifié !";

      }
    }
    $htmlinscription = getView('view/members/editProfile.php', ["errortext" => $errortext, 'numberOfErrors' => $numberOfErrors]);
    $htmlinscriptionInTemplate = loadTemplateMember($htmlinscription, "Inscrivez-vous sur le blog de Jean Forteroche", ["public/css/styleArticle.css"], $withAlert);
    return $htmlinscriptionInTemplate;
  }
}
