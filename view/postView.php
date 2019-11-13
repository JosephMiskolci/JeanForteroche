<!-- Slideshow Home -->
<section id="slideshow-home">
    <span id="slideshow-link"></span>
    <div class="carousel-container">
      <figure class="carousel-slides">
        <div class="enabled">
          <img src="public/images/img/HeroPicture.jpg" alt="">
        </div>
      </figure>
</section>


<!-- Author's Biography -->

<section id="biography">
  <div class="BiographyTitle">
    <h1>
      <?= htmlspecialchars($datas["post"]['title']) ?>
    </h1>
  </div>
</section>

<!-- Publications -->
<section id="Publications">
  <div class="Articles">
    <p class="ArticleText">
    <?= nl2br(html_entity_decode($datas["post"]['content'])) ?>
    </p>
    <p class="ArticleDate">Publié le <?= $datas["post"]['creation_date_fr'] ?></p>
  </div>
</section>

<!-- Comments -->

<section id="Comments">
  <div class="CommentsName">
    <h2>Commentaires</h2>
  </div>

  <?php
  while ($comment = $datas["comments"]->fetch())
{
  ?>
  <div class="Comment">
    <div class="Commentaries">
      <p class="CommentaryText">
        <?= nl2br(strip_tags($comment['comment'])) ?>
      </p>
      <p class="ArticleDate">Publié le <?= $comment['comment_date_fr'] ?> par <strong><?= htmlspecialchars($comment['author']) ?></strong></p>
    </div>
    <hr>
    </hr>
  </div>
  <?php
}
$datas["comments"]->closeCursor();
?>

  <div class="CommentsName CommentsPost">
    <h2>Postez votre commentaire !</h2>
  </div>

  <?php
    if(isset($_SESSION['pseudo']))
      {
  ?>
  <form action="index.php?action=addComment&amp;id=<?= $datas["post"]['id'] ?>" method="post">
    <div class="name-form-and-email-form">
    </div>
    <div class="message-form">
      <p>
        <label for="ameliorer comment">
          Message :
        </label>
        <br />
        <textarea name="comment" id="comment" rows="10"></textarea>
      </p>
    </div>
        <input type="submit" class="btn btn-secondary comment-sending" value="Publiez votre message !">
  </form>
</section>
<?php
} else {
?>
  <div class="name-form-and-email-form">
      <div class="CommentariesError">
        <p> Vous devez être connecté pour publier un commentaire ! </p>
        </div>
        </div>
  <?php
}
?>
