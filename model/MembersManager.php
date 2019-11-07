<?php

namespace JeanForteroche\Blog\Model;

require_once("model/Manager.php");

class MembersManager extends Manager
{
    public function membersInscription()
    {
      $db = $this->dbConnect();

      if(isset($_POST['forminscription'])) {
         $pseudo = htmlspecialchars($_POST['pseudo']);
         $mail = htmlspecialchars($_POST['mail']);
         $mail2 = htmlspecialchars($_POST['mail2']);
         $mdp = htmlspecialchars($_POST['mdp']);
         $mdp2 = htmlspecialchars($_POST['mdp2']);

         $mdpHached = password_hash($mdp, PASSWORD_DEFAULT);
         if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
            $pseudolength = strlen($pseudo);
            if($pseudolength <= 255) {
               if($mail == $mail2) {
                  if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                     $reqmail = $db->prepare("SELECT * FROM member_space WHERE mail = ?");
                     $reqmail->execute(array($mail));
                     $mailexist = $reqmail->rowCount();
                     if($mailexist == 0) {
                        if($mdp == $mdp2) {

                          if(filter_var($pseudo, FILTER_VALIDATE_EMAIL)) {
                             $reqpseudo = $db->prepare("SELECT * FROM member_space WHERE pseudo = ?");
                             $reqpsuedo->execute(array($pseudo));
                             $pseudoexist = $reqpseudo->rowCount();
                             if($pseudoexist == 0) {

                               $insertmbr = $db->prepare("INSERT INTO member_space (pseudo, mail, password) VALUES(?, ?, ?)");
                               $insertmbr->execute(array($pseudo, $mail, $mdpHached));
                               $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                               echo " <p class='error_text'>$erreur </p>";

                        } else {
                           $erreur = "Vos mots de passes ne correspondent pas !";
                           echo " <p class='error_text'>$erreur </p>";
                        }
                     }
                     else {
                        $erreur = "Pseudo déjà utilisé !";
                        echo " <p class='error_text'>$erreur </p>";
                      }
                    }
                     else {
                        $erreur = "Adresse mail déjà utilisée !";
                        echo " <p class='error_text'>$erreur </p>";
                     }
                  } else {
                     $erreur = "Votre adresse mail n'est pas valide !";
                     echo " <p class='error_text'>$erreur </p>";
                  }
               } else {
                  $erreur = "Vos adresses mail ne correspondent pas !";
                  echo " <p class='error_text'>$erreur </p>";
               }
            } else {
               $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
               echo " <p class='error_text'>$erreur </p>";
            }
         } else {
            $erreur = "Tous les champs doivent être complétés !";
            echo " <p class='error_text'>$erreur </p>";
         }
      }
    }
  }

  public function membersConnexion()
    {
      $db = $this->dbConnect();

      if(isset($_POST['formconnexion'])) {

        $mailconnect = htmlspecialchars($_POST['mailconnect']);
        $mdpconnect = htmlspecialchars($_POST['mdpconnect']);

        if (!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect']))
                  {
                      $req = $db->prepare('SELECT * FROM member_space WHERE mail = :mail');
                      $req-> execute(array(
                          'mail' => $mailconnect));

                      $resultat = $req->fetch();


                      if (!$resultat OR !password_verify($_POST['mdpconnect'], $resultat['password']))
                      {
                          $erreur = 'Identifiant ou Mot De Passe incorrect.<br/>';
                          echo " <p class='error_text'>$erreur </p>";
                      }
                      else
                      {
                          $_SESSION['id'] = $resultat['id'];
                          $_SESSION['pseudo'] = $resultat['pseudo'];
                          $_SESSION['mail'] = $resultat['mail'];
                          $_SESSION['password'] = $resultat['password'];
                          $erreur = 'Vous êtes connecté ! :-)<br/>';
                          echo " <p class='error_text'>$erreur </p>";
                      }
                      $req->closeCursor();
                  }
                  else
                  {
                      $erreur = 'Renseignez un Pseudo et un Mot De Passe.<br/>';
                      echo " <p class='error_text'>$erreur </p>";
                  }
                }
              }

    public function membersProfile()
      {
        $db = $this->dbConnect();

        if(isset($_GET['id']) AND $_GET['id'] > 0) {
            $getid = intval($_GET['id']);
            $requser = $db->prepare('SELECT * FROM membres WHERE id = ?');
            $requser->execute(array($getid));
      }
    }

    public function membersDisconnect()
        {
          $_SESSION = array();
          session_destroy();
        }

    public function membersEdition()
        {
          $db = $this->dbConnect();

          if(isset($_SESSION['id'])) {
            $requser = $db->prepare("SELECT * FROM member_space WHERE id = ?");
            $requser->execute(array($_SESSION['id']));
            $user = $requser->fetch();
              if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
                $mdp1Hached = password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);
                $mdp2Hached = password_hash($_POST['newmdp2'], PASSWORD_DEFAULT);
                if($_POST['newmdp1'] == $_POST['newmdp2']) {
                  $insertmdp = $db->prepare("UPDATE member_space SET password = ? WHERE id = ?");
                  $insertmdp->execute(array($mdp1Hached, $_SESSION['id']));
                  header('index.php?action=profile&id'.$_SESSION['id']);
                } else {
                  $msg = "Vos deux mdp ne correspondent pas !";
                }
              }
              }
        }
}
