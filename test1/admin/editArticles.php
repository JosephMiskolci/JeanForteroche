<section class="publishArticle">
  <h1>Modifier votre article :</h1>

    <form action="index.php?action=editArticle&amp;id=<?= $datas["post"]['id'] ?>" method="POST" onsubmit="">
      <div class="ArticleTitleText">
        <label for="ArticleTitle">Modifiez ou conservez le titre de votre article :</label>
        <textarea id="text" type="text" name="name" rows="1"><?= htmlspecialchars($datas["post"]['title']) ?></textarea>
      </div>
      <textarea id="mytextarea" name="mytextarea"><?= nl2br(htmlspecialchars($datas["post"]['content'])) ?></textarea>
      <input name="send" id="send" type="submit" value="Envoyez votre article !">
    </form>
    </section>
