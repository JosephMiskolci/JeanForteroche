<?php

session_start();
// ini_set('display_errors', 1);
require('controller/controllers.php');
require('utils.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'home') {                          HomeController::viewHome(); }
        if ($_GET['action'] == 'bibliography') {                  HomeController::viewBibliography(); }
        if ($_GET['action'] == 'allBooks') {                      HomeController::viewAllBooks(); }
        if ($_GET['action'] == 'bookOne') {                       HomeController::viewBookOne(); }
        if ($_GET['action'] == 'bookTwo') {                       HomeController::viewBookTwo();}
        if ($_GET['action'] == 'bookThree') {                     HomeController::viewBookThree();}
        if ($_GET['action'] == 'bookFour') {                      HomeController::viewBookFour();}
        if ($_GET['action'] == 'post') {                          CommentsController::viewPost($_GET['id']); }
        if ($_GET['action'] == 'addComment') {                    CommentsController::addComment(); }
        if ($_GET['action'] == 'flagComment') {                   CommentsController::flagComment(); }
        if ($_GET['action'] == 'unflagComment') {                 CommentsController::unflagComment(); }
        if ($_GET['action'] == 'allArticles') {                   CommentsController::AllArticles(); }
        if ($_GET['action'] == 'admin') {                         AdminController::viewHomeAdmin(); }
        if ($_GET['action'] == 'viewWritingArticle') {            AdminController::viewWritingArticle(); }
        if ($_GET['action'] == 'postArticle') {                   AdminController::addArticle(); }
        if ($_GET['action'] == 'manageArticle') {                 CommentsController::AllArticlesAdmin(); }
        if ($_GET['action'] == 'edit') {                          CommentsController::editPost($_GET['id']); }
        if ($_GET['action'] == 'editArticle') {                   AdminController::editArticle(); }
        if ($_GET['action'] == 'delete') {                        CommentsController::viewDeletePost($_GET['id']); }
        if ($_GET['action'] == 'deleteArticle') {                 AdminController::deleteArticle();}
        if ($_GET['action'] == 'manageUsers') {                   AdminController::adminActionsUsers(); }
        if ($_GET['action'] == 'adminUser') {                     AdminController::adminUsers(); }
        if ($_GET['action'] == 'moderatorUser') {                 AdminController::moderatorUsers(); }
        if ($_GET['action'] == 'removeAdminUser') {               AdminController::RemoveAdminUsers(); }
        if ($_GET['action'] == 'removeModeratorUser') {           AdminController::RemoveModeratorUsers(); }
        if ($_GET['action'] == 'deleteUser') {                    AdminController::deleteUsers(); }
        if ($_GET['action'] == 'manageComments') {                AdminController::moderateComment(); }
        if ($_GET['action'] == 'manageFlagComments') {            AdminController::moderateFlagComment($_GET['id']); }
        if ($_GET['action'] == 'validateComment') {               AdminController::validateComment(); }
        if ($_GET['action'] == 'moderate') {                      CommentsController::editComment(); }
        if ($_GET['action'] == 'moderatebyUser') {                CommentsController::editCommentbyUser(); }
        if ($_GET['action'] == 'postModerateComment') {           AdminController::editComment(); }
        if ($_GET['action'] == 'postModerateCommentbyUser') {     AdminController::editCommentbyUser(); }
        if ($_GET['action'] == 'deleteComment') {                 AdminController::deleteComment(); }
        if ($_GET['action'] == 'deleteCommentbyUser') {           AdminController::deleteCommentbyUser(); }
        if ($_GET['action'] == 'inscription') {                   MembersController::viewInscription(); }
        if ($_GET['action'] == 'sendInscription') {               MembersController::inscription(); }
        if ($_GET['action'] == 'connexion') {                     MembersController::connexion(); }
        if ($_GET['action'] == 'profile') {                       MembersController::profile(); }
        if ($_GET['action'] == 'disconnect') {                    MembersController::disconnect(); }
        if ($_GET['action'] == 'edition') {                       MembersController::memberEdition(); }
        if ($_GET['action'] == 'contact') {                       HomeController::form();}
        if ($_GET['action'] == 'sendcontact') {                   HomeController::sendform();}
        if ($_GET['action'] == 'error') {                         HomeController::error(); }

    }
    else {
        HomeController::viewHome();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
