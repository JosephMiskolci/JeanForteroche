<!-- Top Picture -->
<section id="TopPicture">
  <figure class="HeroPicture">
    <div class="FrontPicture">
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
if ($datas["comments"]->rowCount() > 0) {
?>
  <section id="Comments">
    <div class="CommentsName">
      <h2>Commentaires</h2>
    </div>
    <?php
    while ($comment = $datas["comments"]->fetch()) {
    ?>
      <div class="Comment">
        <div class="Commentaries">
          <?php if ($_SESSION['id']) {
            $dislikes = 0;
            foreach ($datas["flags"] as $flag) {
              if ($_SESSION['id'] == $flag['user_id'] && $comment['id'] == $flag['id_comments']) {
                $dislikes++;
              }
            }

            if ($_SESSION['id'] == $flag['user_id'] && $comment['id'] == $flag['id_comments']) { ?>
              <form class="FlagForm" action="index.php?action=unflagComment&amp;id=<?= $comment['id'] ?>" method="post">
                <button type="submit" class="FlagCommentsRed"><i class="fas fa-exclamation-circle"></i></button>
              </form>
            <?php
            } else {
            ?>
              <form class="FlagForm" action="index.php?action=flagComment&amp;id=<?= $comment['id'] ?>" method="post">
                <?php if ($dislikes >= 1) {
                ?>
                  <button type="submit" class="FlagCommentsRed"><i class="fas fa-exclamation-circle"></i></button>
                <?php
                } else { ?>
                  <button type="submit" class="FlagComments"><i class="fas fa-exclamation-circle"></i></button>
              <?php
                }
              }
              ?>
              </form>
            <?php
          } ?>
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
    <form class="MessageForm" action="index.php?action=addComment&amp;id=<?= $datas["post"]['id'] ?>" method="post">
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