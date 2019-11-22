<?php
require_once('model/MembersManager.php');

class MembersController
{

  static function inscription()
  {
    if (isset($_POST['forminscription'])) {

      $pseudo = htmlspecialchars($_POST['pseudo']);
      $mail = htmlspecialchars($_POST['mail']);
      $mail2 = htmlspecialchars($_POST['mail2']);
      $mdp = htmlspecialchars($_POST['mdp']);
      $mdp2 = htmlspecialchars($_POST['mdp2']);

      // Si le formulaire est intégralement rempli
      if (!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2'])) {
        $pseudolength = strlen($pseudo);

        // Si le pseudo est plus court que 20 caractères
        if ($pseudolength <= 20) {

          // Si le mot de passe et la confirmation du mot de passe correspondent
          if ($mail == $mail2) {

            //Si la rédaction du mail est bien conforme à xxx@xxx.xxx
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
              $commentManager = new \JeanForteroche\Blog\Model\MembersManager();
              $comments = $commentManager->searchUserByMail();
              $mailexist = $comments->rowCount();

              //Si le mail n'existe pas dans la bdd
              if ($mailexist == 0) {

                // Si le mot de passe et le mot de passe de confirmation correspondent
                if ($mdp == $mdp2) {
                  $pseudoManager = new \JeanForteroche\Blog\Model\MembersManager();
                  $pseudo2 = $pseudoManager->searchUserByPseudo();
                  $pseudoexist = $pseudo2->rowCount();

                  //Si le pseudo n'existe pas dans la bdd, alors le compte est créé
                  if ($pseudoexist == 0) {
                    $pseudoManager = new \JeanForteroche\Blog\Model\MembersManager();
                    $pseudo2 = $pseudoManager->insertNewMembers();
                    ?>
                    <script>
                      alert("Votre compte a bien été créé ! Cliquez sur 'OK' pour retourner sur la page de connexion et connectez-vous !");
                      window.location.replace('index.php?action=connexion');
                    </script>
                  <?php
                                    } else {
                                      ?>
                    <script>
                      alert("Pseudo déjà utilisé !");
                    </script>
                  <?php
                                    }
                                  } else {
                                    ?>
                  <script>
                    alert("Vos mots de passes ne correspondent pas !");
                  </script>
                <?php
                                }
                              } else {
                                ?>
                <script>
                  alert("Adresse mail déjà utilisée !");
                </script>
              <?php
                            }
                          } else {
                            ?>
              <script>
                alert("Votre adresse mail n'est pas valide !");
              </script>
            <?php
                        }
                      } else {
                        ?>
            <script>
              alert("Vos adresses mail ne correspondent pas !");
            </script>
          <?php
                    }
                  } else {
                    ?>
          <script>
            alert("Votre pseudo ne doit pas dépasser 255 caractères !");
          </script>
        <?php
                }
              } else {
                ?>
        <script>
          alert("Tous les champs doivent être complétés ! Vous devez recommencer votre inscription.");
        </script>
        <?php
              }
            }

            $htmlinscription = getView('view/members/inscription.php', null);
            $htmlinscriptionInTemplate = loadTemplateMember($htmlinscription, "Inscrivez-vous sur le blog de Jean Forteroche", ["public/css/styleArticle.css"]);
            return $htmlinscriptionInTemplate;
          }

          static function connexion()
          {

            if (isset($_POST['formconnexion'])) {

              // Permet d'éviter l'attaque par force brute en instaurant une pause d'une seconde entre chaque utilisation de la fonction connexion()
              sleep(1);

              //Si le formulaire est intégralement rempli
              if (!empty($_POST['mailconnect']) and !empty($_POST['mdpconnect'])) {
                $membersManager = new \JeanForteroche\Blog\Model\MembersManager();
                $members = $membersManager->connectUserByMail();
                $resultat = $members->fetch();

                //Si le formulaire n'est pas intégralement rempli ou que le mot de passe ne correspond pas
                if (!$resultat or !password_verify($_POST['mdpconnect'], $resultat['password'])) {
                  ?>
          <script>
            alert("Identifiant ou mot de passe incorrect.");
          </script>
        <?php
                  //Si le formulaire est intégralement rempli et que le mot de passe correspond, l'utilisateur est connecté
                } else {
                  $_SESSION['id'] = $resultat['id'];
                  $_SESSION['pseudo'] = $resultat['pseudo'];
                  $_SESSION['mail'] = $resultat['mail'];
                  $_SESSION['password'] = $resultat['password'];
                  $_SESSION['admin'] = $resultat['admin'];
                  $_SESSION['moderator'] = $resultat['moderator'];
                  ?>
          <script>
            alert("Vous êtes désormais connecté ! Cliquez sur 'OK' pour être redirigé vers votre profil.");
            window.location.replace('index.php?action=profile');
          </script>
        <?php
                }
                $members->closeCursor();
              } else {
                ?>
        <script>
          alert("Renseignez un pseudo et un mot de passe.");
        </script>
        <?php
              }
            }

            $htmlListPosts = getView('view/members/connexion.php', null);
            $htmlListPostsInTemplate = loadTemplateMember($htmlListPosts, "Connectez-vous sur le blog de Jean Forteroche", ["public/css/styleArticle.css"]);
            return $htmlListPostsInTemplate;
          }

          static function profile()
          {

            $membersManager = new \JeanForteroche\Blog\Model\MembersManager();
            $members = $membersManager->membersProfile();

            $commentManager = new \JeanForteroche\Blog\Model\CommentManager();
            $comments = $commentManager->getUserComment($_SESSION['pseudo']);

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

            if (isset($_SESSION['id'])) {
              $membersManager = new \JeanForteroche\Blog\Model\MembersManager();
              $members = $membersManager->searchUserbySessionID();
              $user = $members->fetch();

              if (isset($_POST['newmdp1']) and !empty($_POST['newmdp1']) and isset($_POST['newmdp2']) and !empty($_POST['newmdp2'])) {
                if ($_POST['newmdp1'] == $_POST['newmdp2']) {
                  $membersManager = new \JeanForteroche\Blog\Model\MembersManager();
                  $members = $membersManager->editPasswordbyUser();
                  header('index.php?action=profile&id' . $_SESSION['id']);

                  ?>
          <script>
            alert("Votre mot de passe à bien été modifié !");
          </script>
        <?php
                } else {
                  ?>
          <script>
            alert("Vos deux mots de passe ne correspondent pas !");
          </script>
        <?php
        }
      }
    }
    $htmlinscription = getView('view/members/editProfile.php', null);
    $htmlinscriptionInTemplate = loadTemplateMember($htmlinscription, "Inscrivez-vous sur le blog de Jean Forteroche", ["public/css/styleArticle.css"]);
    return $htmlinscriptionInTemplate;
  }
}
