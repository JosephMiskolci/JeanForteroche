<section class="AdminTopTitle">
<h1>Managez vos publications :</h1>
</section>

<section id="Publications">
  
  <?php
  while ($data = $datas["comments"]->fetch())
  {
      ?>
  <div class="Articles">
    <h3><?= htmlspecialchars($data["title"]) ?></h3>
    <p class="ArticleText"><?= nl2br(htmlspecialchars($data['comment'])) ?></p>
    <p class="ArticleDate">Publié le <?= $data['comment_date'] ?> par <strong><?= htmlspecialchars($data['author']) ?></strong></p>
    <div class="AccessButtons">
      <a class="btn btn-info" href="index.php?action=validateComment&amp;id=<?= $data['id'] ?>" role="button">Valider</a>
      <a class="btn btn-warning" href="index.php?action=moderateComment&amp;id=<?= $data['id'] ?>" role="button">Modérer</a>
      <a class="btn btn-danger" href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>" role="button">Supprimer défintivement</a>
    </div>
  </div>
  <hr>
  </hr>
  <?php
  }
  $datas["comments"]->closeCursor();
  ?>
</section>
