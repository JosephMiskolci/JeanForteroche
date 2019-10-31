<section class="publishArticle">
  <h1>Voulez-vous vraiment supprimer cet article ? :</h1>

    <form action="index.php?action=deleteArticle&amp;id=<?= $datas["post"]['id'] ?>" method="POST" onsubmit="">
      <div class="ArticleTitleText">
        <label for="ArticleTitle">Titre de votre article :</label>
        <h2><?= htmlspecialchars($datas["post"]['title']) ?></h2>
      </div>
      <p><?= nl2br(htmlspecialchars($datas["post"]['content'])) ?></p>
      <input name="send" id="send" type="submit" value="Supprimer cet article !">
    </form>
    </section>
