<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title ?></title>
  <meta name="description" content="Découvrez le blog de l'écrivain Jean Forteroche, auteur de son nouveau roman Billet simple pour l'Alaska, disponible en intégralité sur son site internet." />

  <!-- Font Awesome, CSS + Bootstrap-->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="./public/css/styleArticle.css">
  <script src="https://cdn.tiny.cloud/1/0okxd6h1z339m6jxcpm75mopcnf8uevzsdrg19ultrmq3qhc/tinymce/5/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: '#mytextarea',
      height: "600px"
    });
  </script>

  <!-- Google Fonts + Favicon -->

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Homemade+Apple&display=swap" rel="stylesheet">
  <link rel="shortcut icon" type="image/ico" href="images/ico/favicon.png" />
</head>

<body>
  <header>
    <span id="home-link"></span>
    <div id="navigation-bar">
      <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <a class="navbar-brand" href="index.php">Jean Forteroche</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=admin">Accueil Admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=disconnect">Déconnexion Admin</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>

  <?= $content ?>

  <!-- Footer -->

  <footer>
    <span id="contacts-link"></span>
    <div class="site-infos">
      <div class="footer-address">
        <p>Plan du site :</p>
        <a href="#">Accueil</a>
        <br>
        <a href="#">Auteur</a>
        <br>
        <a href="http://joseph-miskolci.com/pages/jeanforteroche/index.php?action=allArticles">Publications</a>
        <br>
        <a href="#">Ouvrages</a>
        <br>
        <a href="#">Contact</a>
        <br>
        <a <?php
            if (isset($_SESSION['id'])) {
              ?> href="index.php?action=profile&amp;id=<?= $_SESSION['id'] ?>">
        <?php
          echo 'Votre profil, ' . $_SESSION['pseudo'] . ' !';
        } else {
          ?>
          href="index.php?action=connexion">
        <?php
          echo 'Connexion';
        }
        ?></a>
      </div>
      <div class="footer-admin">
        <p>Administrateur :</p>
        <a href="index.php?action=disconnect">Déconnexion Admin</a>
      </div>
    </div>
    <p class="copyright">© Copyright 2019 Joseph Miskolci : Projet OpenClassRooms</p>
  </footer>

  <!-- jQuery & Google Maps Scripts -->

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <!-- Bootstrap JS Scripts -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>