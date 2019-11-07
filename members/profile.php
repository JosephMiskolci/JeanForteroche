<section class="TopTitle">
  <h2>Profil de <?php echo $_SESSION['pseudo']; ?></h2>
</section>
<section class="ProfileText">
  
  <div class="ProfileCommentaries">
    Pseudo = <?php echo $_SESSION['pseudo']; ?>
    <br />
    Mail = <?php echo $_SESSION['mail']; ?>
    <br /><br />
  </div>

  <div class="ProfileInformations">
  Pseudo = <?php echo $_SESSION['pseudo']; ?>
  <br />
  Mail = <?php echo $_SESSION['mail']; ?>
  <br /><br />
  <div class="editionProfile">
    <a href="index.php?action=edition&amp;id=<?= $_SESSION['id'] ?>">Éditer mon profil</a>
    <br />
    <a href="index.php?action=disconnect">Se déconnecter</a>
  </div>
    </div>
</section>
