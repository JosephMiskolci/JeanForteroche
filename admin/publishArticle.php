<section class="publishArticle">
  <h1>Publiez votre nouvel article :</h1>
    <form action="index.php?action=postArticle" method="POST" onsubmit="">
      <div class="ArticleTitleText">
        <label for="ArticleTitle">Choisissez le titre de votre article :</label>
        <input type="text" name="name" id="name" required>
      </div>
      <textarea id="mytextarea" name="mytextarea"></textarea>
      <input name="send" id="send" type="submit" value="Envoyez votre article !">
    </form>
    </section>
