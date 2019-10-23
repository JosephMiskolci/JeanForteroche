<?php $title = 'Découvrez les ouvrages de Jean Forteroche'; ?>

<?php ob_start(); ?>
<!-- Slideshow Home -->
<section id="slideshow-home">
    <span id="slideshow-link"></span>
    <div class="carousel-container">
      <figure class="carousel-slides">
        <div class="enabled">
          <img src="public/images/img/Writer.jpg" alt="">
        </div>
      </figure>
</section>


<!-- Author's Biography -->

<section id="biography">
  <div class="BiographyName">
    <h1>
      <?= htmlspecialchars($post['title']) ?>
    </h1>
  </div>
</section>

<!-- Publications -->
<section id="Publications">
  <div class="Articles">
    <p class="ArticleText">
    <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
    <p class="ArticleDate">Publié le <?= $post['creation_date_fr'] ?></p>
  </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/templates/templateArticle.php'); ?>
