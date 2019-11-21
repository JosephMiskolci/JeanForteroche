<?php
namespace JeanForteroche\Blog\Model;

require_once ("model/Manager.php");

class MembersManager extends Manager
{
    public function membersInscription()
    {
        $db = $this->dbConnect();

        if (isset($_POST['forminscription']))
        {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mail = htmlspecialchars($_POST['mail']);
            $mail2 = htmlspecialchars($_POST['mail2']);
            $mdp = htmlspecialchars($_POST['mdp']);
            $mdp2 = htmlspecialchars($_POST['mdp2']);

            $mdpHached = password_hash($mdp, PASSWORD_DEFAULT);
            if (!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2']))
            {
                $pseudolength = strlen($pseudo);
                if ($pseudolength <= 255)
                {
                    if ($mail == $mail2)
                    {
                        if (filter_var($mail, FILTER_VALIDATE_EMAIL))
                        {
                            $reqmail = $db->prepare("SELECT * FROM member_space WHERE mail = ?");
                            $reqmail->execute(array(
                                $mail
                            ));
                            $mailexist = $reqmail->rowCount();
                            if ($mailexist == 0)
                            {
                                if ($mdp == $mdp2)
                                {
                                    $reqpseudo = $db->prepare("SELECT * FROM member_space WHERE pseudo = ?");
                                    $reqpseudo->execute(array(
                                        $pseudo
                                    ));
                                    $pseudoexist = $reqpseudo->rowCount();
                                    if ($pseudoexist == 0)
                                    {

                                        $insertmbr = $db->prepare("INSERT INTO member_space (pseudo, mail, password, admin, moderator) VALUES (?, ?, ?, 0, 0)");
                                        $insertmbr->execute(array(
                                            $pseudo,
                                            $mail,
                                            $mdpHached
                                        ));
                                        ?>
                                        <script>
                                          alert("Votre compte a bien été créé ! Cliquez sur 'OK' pour retourner sur la page de connexion et connectez-vous !");
                                          window.location.replace('index.php?action=connexion');
                                        </script>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <script>
                                          alert("Pseudo déjà utilisé !");
                                        </script>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <script>
                                      alert("Vos mots de passes ne correspondent pas !");
                                    </script>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <script>
                                  alert("Adresse mail déjà utilisée !");
                                </script>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <script>
                              alert("Votre adresse mail n'est pas valide !");
                            </script>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <script>
                          alert("Vos adresses mail ne correspondent pas !");
                        </script>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <script>
                      alert("Votre pseudo ne doit pas dépasser 255 caractères !");
                    </script>
                    <?php
                }
            }
            else
            {
              ?>
              <script>
                alert("Tous les champs doivent être complétés ! Vous devez recommencer votre inscription.");
              </script>
              <?php
            }
        }
    }

    public function membersConnexion()
    {
        $db = $this->dbConnect();

        if (isset($_POST['formconnexion']))
        {
            // Permet d'éviter la connexion en brute force
            sleep(1);

            $mailconnect = htmlspecialchars($_POST['mailconnect']);

            if (!empty($_POST['mailconnect']) and !empty($_POST['mdpconnect']))
            {
                $req = $db->prepare('SELECT * FROM member_space WHERE mail = :mail');
                $req->execute(array(
                    'mail' => $mailconnect
                ));

                $resultat = $req->fetch();

                if (!$resultat or !password_verify($_POST['mdpconnect'], $resultat['password']))
                {
                    ?>
                    <script>
                      alert("Identifiant ou mot de passe incorrect.");
                    </script>
                    <?php
                }
                else
                {
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
                $req->closeCursor();
            }
            else
            {

                ?>
                <script>
                  alert("Renseignez un pseudo et un mot de passe.");
                </script>
                <?php
            }
        }
    }

    public function membersProfile()
    {
        $db = $this->dbConnect();

        if (isset($_GET['id']) and $_GET['id'] > 0)
        {
            $getid = intval($_GET['id']);
            $requser = $db->prepare('SELECT * FROM member_space WHERE id = ?');
            $requser->execute(array(
                $getid
            ));
        }
    }

    public function membersEdition()
    {
        $db = $this->dbConnect();

        if (isset($_SESSION['id']))
        {
            $requser = $db->prepare("SELECT * FROM member_space WHERE id = ?");
            $requser->execute(array(
                $_SESSION['id']
            ));
            $user = $requser->fetch();
            if (isset($_POST['newmdp1']) and !empty($_POST['newmdp1']) and isset($_POST['newmdp2']) and !empty($_POST['newmdp2']))
            {
                $mdp1Hached = password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);
                $mdp2Hached = password_hash($_POST['newmdp2'], PASSWORD_DEFAULT);
                if ($_POST['newmdp1'] == $_POST['newmdp2'])
                {
                    $insertmdp = $db->prepare("UPDATE member_space SET password = ? WHERE id = ?");
                    $insertmdp->execute(array(
                        $mdp1Hached,
                        $_SESSION['id']
                    ));
                    header('index.php?action=profile&id' . $_SESSION['id']);
                }
                else
                {
                  ?>
                  <script>
                    alert("Vos deux mots de passe ne correspondent pas !");
                  </script>
                  <?php
                }
            }
        }
    }
}
