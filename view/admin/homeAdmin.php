<?php
if($_SESSION['admin'] == "1" OR $_SESSION['moderator'] == "1")
{
?>

<section class="TopTitle">
<h1>Bienvenue dans l'interface de gestion du blog de Jean Forteroche :</h1>
</section>

<section id="Admin-full-width" class="WriteArticleAdmin">
  <a class="linkAdmin" href="index.php?action=viewWritingArticle">
  <div class="AdminHalfTitle">
    <h3>Rédiger un article</h3>
  </div>
</a>
</section>

<div class="sectionAdminHalfWidth">

<section id="Admin-half-width" class="DeleteArticleAdmin">
  <a class="linkAdmin" href="index.php?action=manageArticle">
  <div class="AdminHalfTitle">
    <h3>Éditer ou supprimer un article</h3>
  </div>
</a>
</section>

<section id="Admin-half-width" class="EditMembersAdmin">
  <a class="linkAdmin" href="index.php?action=manageUsers">
  <div class="AdminHalfTitle">
    <h3>Modérer les utilisateurs</h3>
  </div>
</a>
</section>

<section id="Admin-half-width" class="EditCommWaitingAdmin">
  <a class="linkAdmin" href="index.php?action=manageComments">
  <div class="AdminHalfTitle">
    <h3>Modérer les commentaires en attente</h3>
  </div>
</a>
</section>

<section id="Admin-half-width" class="EditCommPostedAdmin">
  <a class="linkAdmin" href="tinyMCE.html">
  <div class="AdminHalfTitle">
    <h3>Modérer les commentaires déjà publiés</h3>
  </div>
</a>
</section>
</div>

<?php
} else {
  header("location: index.php?action=error");
}
?>
