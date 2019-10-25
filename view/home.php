<section id="slideshow-home">
  <span id="slideshow-link"></span>
  <div class="carousel-container">
    <figure class="carousel-slides">
      <ul>
        <li class="enabled"><img src="public/images/img/HeroPicture.jpg" alt="Image01">
          <div class="PresentationText">
            <h3 class="">Découvrez le nouveau roman de Jean Forteroche</h3>
            <h2>Billet simple pour l'Alaska</h2>
            <div class="AccessButtons">
              <a class="btn btn-outline-secondary" href="http://joseph-miskolci.com/pages/jeanforteroche/index.php?action=bibliography" role="button">Découvrez l'auteur</a>
              <a class="btn btn-outline-secondary" href="http://joseph-miskolci.com/pages/jeanforteroche/index.php?action=allArticles" role="button">Accédez aux chapitres</a>
            </div>
          </div>
      </ul>
    </figure>
</section>

<!-- Author's Biography -->

<section id="biography">
  <img src="public/images/img/Writer.jpg" alt="Jean_Forteroche">
  <div class="BiographyName">
    <h1>Jean Forteroche</h1>
  </div>
  <div class="BiographyText">
    <p> Jean Forteroche est d'abord journaliste avant de prendre part à la Première Guerre mondiale en tant qu'ambulancier en Italie et d'y être blessé. Son goût pour l'aventure l'amènera par la suite à être correspondant de guerre pendant la
      guerre d'Espagne et durant la Seconde Guerre mondiale. Parallèlement à son métier de journaliste, il publie des ouvrages littéraires, romans et recueils de nouvelles écrits dans un style réaliste et direct, tels que <i>In Our Time</i> en
      1985,
      <i>L'Adieu aux armes</i> en 1999, <i>Pour qui sonne le glas</i> en 2004 ou encore <i>Le Vieil Homme et la Mer </i> en 2012.</p>
    <a class="btn btn-outline-secondary" href="http://joseph-miskolci.com/pages/jeanforteroche/index.php?action=bibliography" role="button">Découvrez sa biographie complète</a>
  </div>
</section>

<!-- Publications -->

<section id="Publications">
  <h2 class="PublicationsTitle">Découvrez les dernières publications de Jean Forteroche :</h2>
  <?php
while ($data = $datas["posts"]->fetch())
{
?>
  <div class="Articles">
    <h3><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a></h3>
    <p class="ArticleText"><?= nl2br(htmlspecialchars($data['content'])) ?></p>
    <p class="ArticleDate">Publié le <?= $data['creation_date_fr'] ?></p>
  </div>
  <hr>
  </hr>
  <?php
}
$datas["posts"]->closeCursor();
?>
<div class="PublicationButton">
    <a class="btn btn-secondary" href="http://joseph-miskolci.com/pages/jeanforteroche/index.php?action=allArticles" role="button">Découvrez l'intégralité de ses publications</a>
    </div>
</section>

<!-- Publications -->

<section id="MajorBooks">
  <div class="firstBook">
    <img src="public/images/img/AlaskaNight.jpg" alt="Aller_simple_pour_l_Alaska_img">
    <div class="BookName">
      <h3>Bibliographie</h3>
    </div>
    <div class="BookText">
      <p>Vivez le format de publication innovant du nouvel ouvrage de Jean Forteroche, <i>Aller simple pour l'Alaska</i>. Nathan, jeune adolescent turbulent issu du petit village d'Edwardsville dans le Kansas, commet son méfait de trop. La justice le condamne à six mois de travaux forcés dans la base militaire de Kirkland AFB, située en Alaska. Plusieurs
        évenements vont attiser la curiosité du jeune homme qui commence à remettre en question les véritables ambitions de la base... Dans son dernier ouvrage, Jean Forteroche entame la pari audacieux de découper son récit en épisodes distribués
        gratuitement sur son site internet.</p>
      <a class="btn btn-outline-secondary" href="#" role="button">Découvrez les oeuvres de l'auteur</a>
    </div>
  </div>

</section>
