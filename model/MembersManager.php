<?php
namespace JeanForteroche\Blog\Model;

require_once ("model/Manager.php");

class MembersManager extends Manager
{
    public function searchUserByMail($mail) {
        $db = $this->dbConnect();

        $reqmail = $db->prepare("SELECT * FROM member_space WHERE mail = :mail");
        $reqmail->execute(array(
            'mail' => $mail
        ));
        return $reqmail;
    }

    public function searchUserbyPseudo($pseudo) {
        $db = $this->dbConnect();

        $reqpseudo = $db->prepare("SELECT * FROM member_space WHERE pseudo = :pseudo");
        $reqpseudo->execute(array(
            'pseudo' => $pseudo
        ));
        return $reqpseudo;
    }

    public function insertNewMembers($pseudo, $mail, $mdpHached) {

        $db = $this->dbConnect();

        $insertmbr = $db->prepare("INSERT INTO member_space (pseudo, mail, password, admin, moderator) VALUES (:pseudo, :mail, :password, 0, 0)");
        $insertmbr->execute(array(
            'pseudo' => $pseudo,
            'mail' => $mail,
            'password' => $mdpHached
        ));
        return $insertmbr;
    }
    
    public function connectUserByMail($mail)
    {
        $db = $this->dbConnect();

        $reqmail = $db->prepare("SELECT * FROM member_space WHERE mail = :mail");
        $reqmail->execute(array(
            'mail' => $mail
        ));
        return $reqmail;
    }

    public function membersProfile($getid)
    {
        $db = $this->dbConnect();

        if (isset($_GET['id']) and $_GET['id'] > 0)
        {
            $requser = $db->prepare('SELECT * FROM member_space WHERE id = :id');
            $requser->execute(array(
                'id' => $getid
            ));
        }
    }

    public function searchUserbySessionID($sessionID)
    {
        $db = $this->dbConnect();

        $requser = $db->prepare("SELECT * FROM member_space WHERE id = :id");
        $requser->execute(array(
            'id' => $sessionID
        ));
        return $requser;
    }

    public function editPasswordbyUser($sessionID, $mdp1Hached)
    {
        $db = $this->dbConnect();

        $insertmdp = $db->prepare("UPDATE member_space SET password = :password WHERE id = :id");
        $insertmdp->execute(array(
            'password' => $mdp1Hached,
            'id' => $sessionID
        ));
        return $insertmdp;
    }
}
