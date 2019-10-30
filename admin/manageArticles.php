<section id="Publications">
  <h1>Managez vos publications :</h1>

  <?php
while ($data = $datas["posts"]->fetch())
{
?>
  <div class="Articles">
    <h3><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a></h3>
    <p class="ArticleText"><?= nl2br(htmlspecialchars(($data['content']))) ?></p>
    <p class="ArticleDate">Publié le <?= $data['creation_date_fr'] ?></p>
    <div class="AccessButtons">
      <a class="btn btn-outline-secondary" href="index.php?action=bibliography" role="button">Découvrez l'auteur</a>
      <a class="btn btn-outline-secondary" href="index.php?action=allArticles" role="button">Accédez aux chapitres</a>
    </div>
  </div>
  <hr>
  </hr>
  <?php
}
$datas["posts"]->closeCursor();
?>
</section>
