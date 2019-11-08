<?php

ini_set('display_errors', 1);
require('controller/controllers.php');
require('utils.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'home') {                HomeController::viewHome(); };
        if ($_GET['action'] == 'bibliography') {        HomeController::viewBibliography(); };
        if ($_GET['action'] == 'post') {                PostCommentsController::viewPost($_GET['id']); }
        if ($_GET['action'] == 'addComment') {          PostCommentsController::addComment($_GET['id'], $_POST['author'], $_POST['comment']); }
        if ($_GET['action'] == 'allArticles') {         PostCommentsController::AllArticles(); }
        if ($_GET['action'] == 'admin') {               AdminController::viewHomeAdmin(); }
        if ($_GET['action'] == 'viewWritingArticle') {  AdminController::viewWritingArticle(); }
        if ($_GET['action'] == 'postArticle') {         AdminController::addArticle(); }
        if ($_GET['action'] == 'manageArticle') {       PostCommentsController::AllArticlesAdmin(); }
        if ($_GET['action'] == 'edit') {                PostCommentsController::editPost($_GET['id']); }
        if ($_GET['action'] == 'editArticle') {         AdminController::editArticle(); }
        if ($_GET['action'] == 'delete') {              PostCommentsController::viewDeletePost($_GET['id']); }
        if ($_GET['action'] == 'deleteArticle') {       AdminController::deleteArticle(); }
        if ($_GET['action'] == 'manageComments') {      AdminController::moderateComment(); }
        if ($_GET['action'] == 'validateComment') {     AdminController::validateComment(); }
        if ($_GET['action'] == 'moderate') {            PostCommentsController::editComment($_GET['id']); }
        if ($_GET['action'] == 'postModerateComment') { AdminController::editComment(); }
        if ($_GET['action'] == 'deleteComment') {       AdminController::deleteComment(); }
        if ($_GET['action'] == 'inscription') {         MembersController::inscription(); }
        if ($_GET['action'] == 'connexion') {           MembersController::connexion(); }
        if ($_GET['action'] == 'profile') {             MembersController::profile(); }
        if ($_GET['action'] == 'disconnect') {          MembersController::disconnect(); }
        if ($_GET['action'] == 'edition') {             MembersController::memberEdition(); }

    }
    else {
        HomeController::viewHome();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
