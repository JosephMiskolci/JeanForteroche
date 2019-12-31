<?php
if ($_SESSION['admin'] == "1") {
    ?>

<section class="publishArticle">
  <h2>Publiez votre nouvel article :</h2>
    <form action="index.php?action=postArticle" method="POST" onsubmit="">
      <div class="ArticleTitleText">
        <label for="ArticleTitle">Choisissez le titre de votre article :</label>
        <textarea id="text" type="text" name="name" rows="1"></textarea>
      </div>
      <textarea id="mytextarea" name="mytextarea"></textarea>
      <input name="send" id="send" type="submit" value="Envoyez votre article !">
    </form>
    </section>

<?php
} else {
    header("location: index.php?action=error");
}
?>
