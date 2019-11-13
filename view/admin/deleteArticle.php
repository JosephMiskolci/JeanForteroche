<?php
if($_SESSION['admin'] == "1")
{
?>

<section class="publishArticle">
  <h2>Voulez-vous vraiment supprimer cet article ? :</h2>

    <form action="index.php?action=deleteArticle&amp;id=<?= $datas["post"]['id'] ?>" method="POST" onsubmit="">
        <label for="ArticleTitleDelete">Votre article :</label>
        <div class="textArticleDelete">

          <h3><?= htmlspecialchars($datas["post"]['title']) ?></h3>
          <p><?= nl2br(strip_tags($datas["post"]['content'])) ?></p>
        </div>
      <input name="send" id="send" type="submit" value="Supprimer cet article !">
    </form>
</section>

<?php
} else {
  header("location: index.php?action=error");
}
?>
