<section id="slideshow-home">
  <span id="slideshow-link"></span>
  <div class="carousel-container">
    <figure class="carousel-slides">
      <ul>
        <li class="enabled"><img src="public/images/img/Bookshelf.jpg" alt="Image01">
      </ul>
    </figure>
</section>

<section id="biography">
  <div class="PublicationsTitle">
    <h2>Découvrez les dernières publications de Jean Forteroche :</h2>
  </div>
</section>

<section id="Publications">
  <?php
while ($data = $datas["posts"]->fetch())
{
?>
  <div class="Articles">
    <h3><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a></h3>
    <p class="ArticleText"><?= nl2br(htmlspecialchars($data['content'])) ?></p>
    <p class="ArticleDate">Publié le <?= $data['creation_date_fr'] ?></p>
  </div>
  <hr>
  </hr>
  <?php
}
$datas["posts"]->closeCursor();
?>
</section>
