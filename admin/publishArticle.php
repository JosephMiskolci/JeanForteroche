<section class="publishArticle">
  <h1>Publiez votre nouvel article :</h1>
    <form method="post">
      <div class="ArticleTitleText">
        <label for="ArticleTitle">Choisissez le titre de votre article :</label>
        <input type="text" name="name" id="name" required>
      </div>
      <textarea id="mytextarea" name="mytextarea"></textarea>
      <input name="send" id="send" type="submit" value="Envoyez votre article !">
      <?php
          if($_POST){
          print_r($_POST);
          }
          ?>
          </pre>
    </form>
    </section>
