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
  <div class="BiographyName">
    <h1>
      <?= htmlspecialchars($datas["post"]['title']) ?>
    </h1>
  </div>
</section>

<!-- Publications -->
<section id="Publications">
  <div class="Articles">
    <p class="ArticleText">
    <?= nl2br(htmlspecialchars($datas["post"]['content'])) ?>
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
        <?= nl2br(htmlspecialchars($comment['comment'])) ?>
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

  <form action="index.php?action=addComment&amp;id=<?= $datas["post"]['id'] ?>" method="post">
    <div class="name-form-and-email-form">
      <p>
        <div class="name-form">
          <label for="pseudo">Pseudo :</label>
          <input type="text" name="author" id="author" />
        </div>
        <div class="email-form">
          <label for="pass">Courriel :</label>
          <input type="email" name="email">
        </div>
      </p>  
    </div>
    <div class="message-form">
      <p>
        <label for="ameliorer comment">
          Message :
        </label>
        <br />
        <textarea name="comment" id="comment" rows="10">
     </textarea>
      </p>
    </div>
        <input type="submit" class="btn btn-secondary comment-sending" value="Publiez votre message !">
  </form>
</section>
