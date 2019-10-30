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
        if ($_GET['action'] == 'allArticles') {         AllArticlesController::AllArticles(); }
        if ($_GET['action'] == 'admin') {               AdminController::viewHomeAdmin(); }
        if ($_GET['action'] == 'viewWritingArticle') {  AdminController::viewWritingArticle(); }
        if ($_GET['action'] == 'postArticle') {         AdminController::addArticle(); }

    }
    else {
        HomeController::viewHome();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
