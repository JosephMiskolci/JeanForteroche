<div class="centertext">
  <section class="TopTitle">
    <h2>Modification du mot de passe</h2>
  </section>

  <?php if ($datas['numberOfErrors'] >= 1) {?>
    <div class="error_text"> <?php echo $datas['errortext'] ?></div> <?php
}?>

  <section class="ProfileEdit">

    <div class="ProfileCommentaries">
      <h3>Éléments impossibles à modifier !</h3>
      <b>Pseudo</b> = <?php echo $_SESSION['pseudo']; ?>
      <br />
      <b>Mail</b> = <?php echo $_SESSION['mail']; ?>
      <br /><br />
    </div>

    <div class="FormEditionProfile">
      <form method="POST" action="" enctype="multipart/form-data">
        <table>
          <tr>
            <td>
              <input type="password" name="newmdp1" placeholder=" Nouveau mot de passe" /><br /><br />
            </td>
          </tr>
          <tr>
            <td>
              <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
            </td>
          </tr>
        </table>
        <input type="submit" value="Mettre à jour mon profil !" />
      </form>
  </section>