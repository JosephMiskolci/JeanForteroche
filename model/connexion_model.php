<?php

public function searchUserbyMail()
{
$db = $this->dbConnect();
$searchbyMail = $db->prepare('SELECT * FROM member_space WHERE mail = :mail');
    $searchbyMail->execute(array(
'mail' => htmlspecialchars($_POST['mailconnect']
));

return $searchbyMail
}