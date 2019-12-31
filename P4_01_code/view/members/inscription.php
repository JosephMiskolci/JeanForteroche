<div class="forminscription">
   <section class="TopTitle">
      <h2>Inscription</h2>
   </section>

   <?php if ($datas['numberOfErrors'] >= 1) {?>
      <div class="error_text"> <?php echo $datas['errortext'] ?></div> <?php
}?>

   <div class="forminscriptioncore">
      <h3>Créez un compte pour écrire des commentaires et partager votre avis sur les articles de Jean Forteroche !</h3>
      <form method="POST" action="index.php?action=sendInscription">
         <table>
            <tr>
               <td>
                  <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" />
               </td>
            </tr>
            <tr>
               <td>
                  <input type="email" placeholder="Votre mail" id="mail" name="mail" />
               </td>
            </tr>
            <tr>
               <td>
                  <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" />
               </td>
            </tr>
            <tr>
               <td>
                  <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
               </td>
            </tr>
            <tr>
               <td>
                  <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
               </td>
            </tr>
            <td class="centertext">
               <br />
               <input class="validateinscription" type="submit" name="forminscription" value="Je m'inscris" />
   </div>
   </table>
   </form>
</div>