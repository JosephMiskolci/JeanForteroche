<?php
if($_SESSION['admin'] == "1")
{
?>

<section class="TopTitle">
<h2>Modérez les utilisateurs :</h2>
</section>

<section id="Publications">

  <?php
  while ($data = $datas["member_space"]->fetch())
  {
      ?>
  <div class="Articles">
    <h3><?= htmlspecialchars($data["pseudo"]) ?></h3>
    <p><?= htmlspecialchars($data["mail"]) ?></p>
    <p class="ArticleDate">Inscrit le <?= $data['date_creation'] ?></strong></p>
    <div class="AccessButtons">
      <?php
      if(($data['admin'] == "1")) { ?>
        <a class="btn btn-dark" href="index.php?action=removeAdminUser&amp;id=<?= $data['id'] ?>" role="button">Ne plus être Administrateur</a>
      <?php } else {?>
        <a class="btn btn-info" href="index.php?action=adminUser&amp;id=<?= $data['id'] ?>" role="button">Administrateur</a>
      <?php }
      if(($data['moderator'] == "1")) { ?>
        <a class="btn btn-dark" href="index.php?action=removeModeratorUser&amp;id=<?= $data['id'] ?>" role="button">Ne plus être Modérateur</a>
      <?php } else {?>
        <a class="btn btn-warning" href="index.php?action=moderatorUser&amp;id=<?= $data['id'] ?>" role="button">Modérateur</a>
      <?php } ?>
      <a class="btn btn-danger" href="index.php?action=deleteUser&amp;id=<?= $data['id'] ?>" role="button">Supprimer définitivement</a>
    </div>
  </div>
  <hr>
  </hr>
  <?php
  }
  $datas["member_space"]->closeCursor();
  ?>
</section>

<?php
} else {
  header("location: index.php?action=error");
}
?>
