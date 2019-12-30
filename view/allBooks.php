<section id="TopPicture">
    <figure class="HeroPicture">
        <ul>
            <li class="enabled"><img src="public/images/img/Writer2.jpg" alt="">
        </ul>
    </figure>
</section>

<!-- Author's Biography -->

<section id="biography">
    <div class="BiographyTitle">
        <h1>Tous les ouvrages de Jean Forteroche</h1>
    </div>
</section>

<section id="MajorBooks">
    <img src="public/images/img/ParisLargePicture.jpg" alt="Paris_est_une_fête_img">
    <div class="BookName">
        <h3>Paris est une fête</h3>
    </div>
    <div class="BookText">
        <p>Au cours de l'été 1957, Hemingway commença à travailler sur les «Vignettes parisiennes», comme il appelait alors Paris est une fête. Il y travailla à Cuba et à Ketchum, et emporta même le manuscrit avec lui en Espagne pendant l'été 59, puis à Paris, à l'automne de cette même année. Le livre, qui resta inachevé, fut publié de manière posthume en 1964. Pendant les trois années, ou presque, qui s'écoulent entre la mort de l'auteur et la première publication, le manuscrit subit d'importants amendements de la main des éditeurs. Se trouve aujourd'hui restitué et présenté pour la première fois le texte manuscrit original tel qu'il était au moment de la mort de l'écrivain en 1961. Ainsi, «Le poisson-pilote et les riches», l'un des textes les plus personnels et intéressants, retrouve ici ces passages, supprimés par les premiers éditeurs, dans lesquels Hemingway assume la responsabilité d'une rupture amoureuse, exprime ses remords ou encore parle de «l'incroyable bonheur» qu'il connut avec Pauline, sa deuxième épouse. Quant à «Nada y pues nada», autre texte inédit et capital, écrit en trois jours en 1961, il est le reflet de l'état d'esprit de l'écrivain au moment de la rédaction, trois semaines seulement avant une tentative de suicide. Hemingway y déclare qu'il était né pour écrire, qu'il «avait écrit et qu'il écrirait encore»...</p>
        <a class="btn btn-outline-secondary" href="index.php?action=bookThree" role="button">Découvrez la page de "Paris est une fête"</a>
    </div>
</section>

<section id="MajorBooks">
    <img src="public/images/img/VeniseLargePicture.jpg" alt="Au_dela_du_fleuve_et_sous_les_arbres_img">
    <div class="BookName">
        <h3>Au-delà du fleuve et sous les arbres</h3>
    </div>
    <div class="BookText TwoLinesBookName">
        <p>«Ils passèrent dans la gondole, et ce fut de nouveau le même enchantement : la coque légère et le balancement soudain quand on monte, et l'équilibre des corps dans l'intimité noire une première fois puis une seconde, quand le gondoliere se mit à godiller, en faisant se coucher la gondole un peu sur le côté, pour mieux la tenir en main.
            - Voilà, dit la jeune fille. Nous sommes chez nous maintenant et je t'aime. Embrasse-moi et mets-y tout ton amour.
            Le colonel la tint serrée et la tête rejetée en arrière ; il l'embrassa jusqu'à ce que le baiser n'eût plus qu'un goût de désespoir.»</p>
        <a class="btn btn-outline-secondary" href="index.php?action=bookTwo" role="button">Découvrez "Au-delà du fleuve et sous les arbres"</a>
    </div>
</section>

<section id="MajorBooks">
    <img src="public/images/img/DarkWater.jpg" alt="Aller_simple_pour_l_Alaska_img">
    <div class="BookName">
        <h3>Le vieil homme et la mer</h3>
    </div>
    <div class="BookText TwoLinesBookName">
        <p>À Cuba, le vieux Santiago ne remonte plus grand-chose dans ses filets, à peine de quoi survivre. La chance l’a déserté depuis longtemps. Seul Manolin, un jeune garçon, croit encore en lui. Désespéré, Santiago décide de partir pêcher en pleine mer. Un marlin magnifique et gigantesque mord à l’hameçon. Débute alors le plus âpre des duels… Combat de l’homme et de la nature, roman du courage et de l’espoir, <i>Le vieil homme et la mer</i> est un des plus grands livres de la littérature américaine.</p>
        <a class="btn btn-outline-secondary" href="index.php?action=bookOne" role="button">Découvrez "Le vieil homme et la mer"</a>
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
            <h3><a href="index.php?action=post&amp;id=<?=$data['id']?>"><?=htmlspecialchars($data['title'])?></a></h3>
            <p class="ArticleText"><?=nl2br(strip_tags($data['content']))?></p>
            <p class="ArticleDate">Publié le <?=$data['creation_date_fr']?></p>
        </div>
        <hr>
        </hr>
    <?php
}
$datas["posts"]->closeCursor();
?>
</section>