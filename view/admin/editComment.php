<?php
if($_SESSION['admin'] == "1")
{
?>

<section class="publishArticle">
  <h2>Modifier ce commentaire :</h2>

  <?php
  while ($comment = $datas["comments"]->fetch())
  {
  ?>
    <form action="index.php?action=postModerateComment&amp;id=<?= $comment['id'] ?>" method="POST" onsubmit="">
      <textarea id="mytextarea" name="mytextarea"><?= nl2br(htmlspecialchars($comment['comment'])) ?></textarea>
      <input name="send" id="send" type="submit" value="Publiez le commentaire !">
    </form>
    </section>
    <?php
    }
    $datas["comments"]->closeCursor();
    ?>

<?php
    } else {
      header("location: index.php?action=error");
    }
    ?>
