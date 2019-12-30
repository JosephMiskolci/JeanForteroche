<section id="TopPicture">
    <figure class="HeroPicture">
      <ul>
        <li class="FrontPicture"><img src="public/images/img/Bookshelf.jpg" alt="Image01">
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
while ($data = $datas["posts"]->fetch()) {
    ?>
    <hr>
    <div class="Articles">
      <h3><a href="index.php?action=post&amp;id=<?=$data['id']?>"><?=htmlspecialchars($data['title'])?></a></h3>
      <p class="ArticleText"><?=nl2br(strip_tags($data['content']))?></p>
      <p class="ArticleDate">Publié le <?=$data['creation_date_fr']?></p>
    </div>
  <?php
}
$datas["posts"]->closeCursor();
?>
</section>