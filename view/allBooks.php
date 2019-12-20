<section id="slideshow-home">
    <span id="slideshow-link"></span>
    <div class="carousel-container">
        <figure class="carousel-slides">
            <div class="enabled">
                <img src="public/images/img/Writer2.jpg" alt="">
            </div>
        </figure>
</section>


<!-- Author's Biography -->

<section id="biography">
    <div class="PublicationsTitle">
        <h1>Tous les ouvrages de Jean Forteroche</h1>
    </div>
</section>

<section id="MajorBooks">
    <div class="firstBook">
        <img src="public/images/img/AlaskaNight.jpg" alt="Aller_simple_pour_l_Alaska_img">
        <div class="BookName">
            <h3>Aller simple pour l'Alaska</h3>
        </div>
        <div class="BookText">
            <p>Vivez le format de publication innovant du nouvel ouvrage de Jean Forteroche, <i>Aller simple pour l'Alaska</i>. Nathan, jeune adolescent turbulent issu du petit village d'Edwardsville dans le Kansas, commet son méfait de trop. La justice le condamne à six mois de travaux forcés dans la base militaire de Kirkland AFB, située en Alaska. Plusieurs
                évenements vont attiser la curiosité du jeune homme qui commence à remettre en question les véritables ambitions de la base... Dans son dernier ouvrage, Jean Forteroche entame le pari audacieux de découper son récit en épisodes distribués
                gratuitement sur son site internet.</p>
            <a class="btn btn-outline-secondary" href="#" role="button">Découvrez la page d'Aller simple pour l'Alaska</a>
        </div>
    </div>
</section>

<section id="MajorBooks">
    <div class="firstBook">
        <img src="public/images/img/DarkForest.jpg" alt="Dark_Forest_img">
        <div class="BookName">
            <h3>Au-delà du fleuve et sous les arbres</h3>
        </div>
        <div class="BookText">
            <p>Vivez le format de publication innovant du nouvel ouvrage de Jean Forteroche, <i>Aller simple pour l'Alaska</i>. Nathan, jeune adolescent turbulent issu du petit village d'Edwardsville dans le Kansas, commet son méfait de trop. La justice le condamne à six mois de travaux forcés dans la base militaire de Kirkland AFB, située en Alaska. Plusieurs
                évenements vont attiser la curiosité du jeune homme qui commence à remettre en question les véritables ambitions de la base... Dans son dernier ouvrage, Jean Forteroche entame le pari audacieux de découper son récit en épisodes distribués
                gratuitement sur son site internet.</p>
            <a class="btn btn-outline-secondary" href="#" role="button">Découvrez les oeuvres de l'auteur</a>
        </div>
    </div>
</section>

<section id="MajorBooks">
    <div class="firstBook">
        <img src="public/images/img/DarkWater.jpg" alt="Aller_simple_pour_l_Alaska_img">
        <div class="BookName">
            <h3>Le vieil homme et la mer</h3>
        </div>
        <div class="BookText">
            <p>À Cuba, le vieux Santiago ne remonte plus grand-chose dans ses filets, à peine de quoi survivre. La chance l’a déserté depuis longtemps. Seul Manolin, un jeune garçon, croit encore en lui. Désespéré, Santiago décide de partir pêcher en pleine mer. Un marlin magnifique et gigantesque mord à l’hameçon. Débute alors le plus âpre des duels… Combat de l’homme et de la nature, roman du courage et de l’espoir, <i>Le vieil homme et la mer</i> est un des plus grands livres de la littérature américaine.</p>
            <a class="btn btn-outline-secondary" href="index.php?action=bookOne" role="button">Découvrez "Le vieil homme et la mer"</a>
        </div>
    </div>
</section>

<section id="Publications">
    <div class="CommentsName">
        <h2>Découvrez les dernières actualitées de Jean Forteroche !</h2>
    </div>
    <?php
    while ($data = $datas["posts"]->fetch()) {
    ?>
        <div class="Articles">
            <h3><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a></h3>
            <p class="ArticleText"><?= nl2br(strip_tags($data['content'])) ?></p>
            <p class="ArticleDate">Publié le <?= $data['creation_date_fr'] ?></p>
        </div>
        <hr>
        </hr>
    <?php
       }
       $datas["posts"]->closeCursor();
    ?>
</section>