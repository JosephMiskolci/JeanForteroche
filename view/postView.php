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

<?php
if ($datas["comments"]->rowCount() > 0) { ?>
  <section id="Comments">
    <div class="CommentsName">
      <h2>Commentaires</h2>
    </div>
    <?php
      while ($comment = $datas["comments"]->fetch()) {
        ?>
      <div class="Comment">
        <div class="Commentaries">
          <?php if($_SESSION['id']) {

            $db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
            $dislikes = $db->prepare('SELECT id FROM flag_comments WHERE id_comments = ?');
            $dislikes->execute(array($comment['id']));
            $dislikes = $dislikes->rowCount(); ?>

          <form class="FlagForm" action="index.php?action=flagComment&amp;id=<?= $comment['id'] ?>" method="post">
                      <?php if ($dislikes >= "1") {
             ?>     
              <button type="submit" class="FlagCommentsRed"><i class="fas fa-exclamation-circle"></i> <?= $dislikes ?></button>
            <?php } else { ?>
              <button type="submit" class="FlagComments"><i class="fas fa-exclamation-circle"></i> <?= $dislikes ?></button>
            <?php } ?>
          </form>
          <?php }?>
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
    } else { ?>
    <div class="Articles">
      <h3>Aucun commentaire n'a été publié !</h3>
    </div>
    <hr>
    </hr>
  <?php
  } ?>

  <div class="CommentsName CommentsPost">
    <h2>Postez votre commentaire !</h2>
  </div>

  <?php
  if (isset($_SESSION['pseudo'])) {
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