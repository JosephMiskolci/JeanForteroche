<?php
if($_SESSION['admin'] == "1")
{
?>

<section class="publishArticle">
  <h2>Modifier votre article :</h2>

    <form action="index.php?action=editArticle&amp;id=<?= $datas["post"]['id'] ?>" method="POST" onsubmit="">
      <div class="ArticleTitleText">
        <label for="ArticleTitle">Modifiez ou conservez le titre de votre article :</label>
        <textarea id="text" type="text" name="name" rows="1"><?= htmlspecialchars($datas["post"]['title']) ?></textarea>
      </div>
      <textarea id="mytextarea" name="mytextarea"><?= nl2br(htmlspecialchars($datas["post"]['content'])) ?></textarea>
      <input name="send" id="send" type="submit" value="Envoyez votre article !">
    </form>
    </section>

<?php
    } else {
      header("location: index.php?action=error");
    }
    ?>
