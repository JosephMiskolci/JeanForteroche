<section class="AdminTopTitle">
<h1>Managez vos publications :</h1>
</section>

<section id="Publications">
  <?php
while ($data = $datas["posts"]->fetch())
{
?>
  <div class="Articles">
    <h3><?= htmlspecialchars($data['title']) ?></h3>
    <p class="ArticleText"><?= nl2br(strip_tags($data['content'])) ?></p>
    <p class="ArticleDate">Publié le <?= $data['creation_date_fr'] ?></p>
    <div class="AccessButtons">
      <a class="btn btn-info" href="index.php?action=edit&amp;id=<?= $data['id'] ?>" role="button">Éditer</a>
      <a class="btn btn-danger" href="index.php?action=delete&amp;id=<?= $data['id'] ?>" role="button">Supprimer</a>
    </div>
  </div>
  <hr>
  </hr>
  <?php
}
$datas["posts"]->closeCursor();
?>
</section>
