<section class="TopTitle">
  <h2>Profil de <?php echo $_SESSION['pseudo']; ?></h2>
</section>
<section class="ProfileText">

  <div class="ProfileInformations">
    <p><b>Pseudo</b> = <?php echo $_SESSION['pseudo']; ?></p>
    <p><b>Mail</b> = <?php echo $_SESSION['mail']; ?></p>
    <br />
    <div class="editionProfile">
      <a href="index.php?action=edition&amp;id=<?= $_SESSION['id'] ?>">Éditer mon profil</a>
      <br />
      <a href="index.php?action=disconnect">Se déconnecter</a>
    </div>
  </div>
</section>

<section class="TopTitle">
  <h2>Retrouvez tous vos commentaires :</h2>

  <?php
  if ($datas["comments"]->rowCount() > 0) {
    while ($data = $datas["comments"]->fetch()) {
      ?>
      <div class="Articles">
        <h3><?= htmlspecialchars($data["title"]) ?></h3>
        <p class="ArticleText"><?= nl2br($data['comment']) ?></p>
        <div class="AccessButtons">
          <a class="btn btn-warning" href="index.php?action=moderatebyUser&amp;id=<?= $data['com_id'] ?>" role="button">Éditer</a>
          <a class="btn btn-danger" href="index.php?action=deleteCommentbyUser&amp;id=<?= $data['com_id'] ?>" role="button">Supprimer définitivement</a>
        </div>
        <div class="ArticleDateProfile">
          <p>Publié le <?= $data['comment_date'] ?> par <strong><?= htmlspecialchars($data['author']) ?></strong> -
            <?php
                if ($data['validated'] === "0") { ?>
              <i>Commentaire en attente de validation</i>
            <?php } else { ?>
              <i>Commentaire validé !</i>
            <?php } ?></p>
        </div>


      </div>
      <hr>
      </hr>
    <?php
      }
      $datas["comments"]->closeCursor();
    } else { ?>
    <div class="Articles">
      <h3>Vous n'avez publié aucun commentaire !</h3>
    </div>
    <hr>
    </hr>
  <?php } ?>
</section>