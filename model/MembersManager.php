<?php
namespace JeanForteroche\Blog\Model;

require_once ("model/Manager.php");

class MembersManager extends Manager
{
    public function searchUserByMail() {
        $db = $this->dbConnect();
        $mail = htmlspecialchars($_POST['mail']);

        $reqmail = $db->prepare("SELECT * FROM member_space WHERE mail = ?");
        $reqmail->execute(array(
            $mail
        ));
        return $reqmail;
    }

    public function searchUserbyPseudo() {
        $db = $this->dbConnect();
        $pseudo = htmlspecialchars($_POST['pseudo']);

        $reqpseudo = $db->prepare("SELECT * FROM member_space WHERE pseudo = ?");
        $reqpseudo->execute(array(
            $pseudo
        ));
        return $reqpseudo;
    }

    public function insertNewMembers() {

        $db = $this->dbConnect();
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mdpHached = password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);

        $insertmbr = $db->prepare("INSERT INTO member_space (pseudo, mail, password, admin, moderator) VALUES (?, ?, ?, 0, 0)");
        $insertmbr->execute(array(
            $pseudo,
            $mail,
            $mdpHached
        ));
        return $insertmbr;
    }
    public function connectUserByMail()
    {
        $db = $this->dbConnect();
        $mail = htmlspecialchars($_POST['mailconnect']);

        $reqmail = $db->prepare("SELECT * FROM member_space WHERE mail = ?");
        $reqmail->execute(array(
            $mail
        ));
        return $reqmail;
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

    public function searchUserbySessionID()
    {
        $db = $this->dbConnect();

        $requser = $db->prepare("SELECT * FROM member_space WHERE id = ?");
        $requser->execute(array(
            $_SESSION['id']
        ));
        return $requser;
    }

    public function editPasswordbyUser()
    {
        $db = $this->dbConnect();
        $mdp1Hached = password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);

        $insertmdp = $db->prepare("UPDATE member_space SET password = ? WHERE id = ?");
        $insertmdp->execute(array(
            $mdp1Hached,
            $_SESSION['id']
        ));
        return $insertmdp;
    }
}
