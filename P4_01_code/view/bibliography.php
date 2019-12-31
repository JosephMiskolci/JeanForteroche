<section id="TopPicture">
  <figure class="HeroPicture">
    <ul>
      <li class="FrontPicture"><img src="public/images/img/Writer2.jpg" alt="">
    </ul>
  </figure>
</section>

<!-- Author's Biography -->

<section id="biography">
  <div class="BiographyTitle">
    <h1> Biographie de Jean Forteroche</h1>
  </div>
</section>

<!-- Publications -->
<section id="Publications">
  <div class="Articles">
    <p class="ArticleText">
      Fils d'un médecin, gynécologue obstétricien, et d'une fille de commerçant, chanteuse d'opéra, avec qui il fut toute sa vie en conflit, il est le 2ème de six enfants. En 1913, il entre au lycée et délaisse la pêche et la chasse pour le sport. Ses premiers écrits paraissent dans la revue littéraire de l'école. En 1917, il refuse de suivre des études universitaires et entre comme journaliste au Kansas City Star.
      <br />
      <br />
      Lorsque la guerre éclate, il n'est pas incorporé à cause d'un œil défaillant. Il se fait engager par la Croix-Rouge et rejoint le front où il est blessé aux jambes par une explosion de mortier : essayant de sauver un camarade, il est mitraillé mais parvient quand même à revenir au centre de secours. Ces événements vont servir de fondement à son roman "L'Adieu aux armes" (1929).
      <br />
      <br />
      En 1922-23, il vient vivre à Paris avec sa première épouse. Au cours de cette période, il rencontre et subit l'influence des écrivains et des artistes modernistes des années 1920 connus sous le nom de Génération perdue. Son premier roman, "Le Soleil se lève aussi", est écrit en 1926. Divorcé et remarié de nouveau, il part pour l'Espagne et prend position en faveur des républicains durant la Guerre civile espagnole en tant que journaliste, ce qui lui permet d'écrire "Pour qui sonne le glas" (roman qui le rend d'autant plus célèbre, publié en 1940 après la victoire des Franquistes en Espagne). C'est pendant cette période qu'il rencontre Malraux.
      <br />
      <br />
      Durant la Seconde Guerre mondiale, il participe au débarquement et à la libération de Paris. Il était alors marié pour la troisième fois. Mariage qui se termine après la guerre. En 1946, il se remarie une quatrième et dernière fois.
      <br />
      <br />
      Il reçoit le Prix Nobel de littérature (1954, «pour le style puissant et nouveau par lequel il maîtrise l'art de la narration moderne, comme vient de le prouver "Le Vieil Homme et la Mer"») et le Prix Pulitzer (1953, pour "Le Vieil Homme et la Mer"). Il laisse aussi des recueils de nouvelles dont "Les Neiges du Kilimandjaro".
      <br />
      <br />
      Atteint de diabète et devenant aveugle, il se suicide en 1961. Le dossier médical d'Hemingway, montre qu'il souffrait d'hémochromatose (une maladie génétique qui provoque de sévères dommages physiques et mentaux).
    </p>
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