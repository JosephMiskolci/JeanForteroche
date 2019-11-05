<?php

require_once('model/PostManager.php');

class MembersController {

  static function inscription() {
    $htmlListPosts = getView('members/inscription.php', null);
    $htmlListPostsInTemplate = loadTemplateAdmin($htmlListPosts, "Page d'administration du blog de Jean Forteroche",["public/css/styleArticle.css"]);
    return $htmlListPostsInTemplate;
  }

}
