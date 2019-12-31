<div class="forminscription">
  <section class="TopTitle">
    <h2>Connexion</h2>
  </section>

  <?php if ($datas['numberOfErrors'] >= 1) { ?>
    <div class="error_text"> <?php echo $datas['errortext'] ?></div> <?php
  } ?>

  <div class="forminscriptioncore">
    <h3 class="connexiontext">Connectez-vous et interagissez sur les articles de Jean Forteroche </h3>
    <form method="POST" action="">
      <input type="email" name="mailconnect" placeholder="Mail" />
      <br /><br />
      <input type="password" name="mdpconnect" placeholder="Mot de passe" />
      <br /><br />
      <input class="validateinscription" type="submit" name="formconnexion" value="Se connecter !" />
  </div>
  </form>
  <a class="btn btn-secondary inscriptionbutton" href="index.php?action=inscription" role="button">Vous n'avez pas de compte ? Inscrivez-vous !</a></button>
</div>