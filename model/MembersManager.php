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
                           $insertmbr = $db->prepare("INSERT INTO member_space (pseudo, mail, password) VALUES(?, ?, ?)");
                           $insertmbr->execute(array($pseudo, $mail, $mdpHached));
                           $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                           echo " <p class='error_text'>$erreur </p>";
                        } else {
                           $erreur = "Vos mots de passes ne correspondent pas !";
                           echo " <p class='error_text'>$erreur </p>";
                        }
                     } else {
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
                          $_SESSION['password'] = $resultat['password'];
                          $erreur = 'Vous êtes connecté ! :-)<br/>';
                          echo " <p class='error_text'>$erreur </p>";
                          header("Location: profil.php?id=".$_SESSION['id']);
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
            }
