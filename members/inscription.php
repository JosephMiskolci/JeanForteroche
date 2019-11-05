<div class="forminscription">
  <section class="TopTitle">
  <h1>Inscription</h1>
  </section>
   <div class="forminscriptioncore">
   <h3>Créez un compte pour écrire des commentaires et partager votre avis sur les articles de Jean Forteroche !</h3>
   <form method="POST" action="">
      <table>
         <tr>
            <td>
               <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
            </td>
         </tr>
         <tr>
            <td>
               <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
            </td>
         </tr>
         <tr>
            <td>
               <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
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
            <td align="center">
               <br />
               <input class="validateinscription" type="submit" name="forminscription" value="Je m'inscris" />
                  </div>
      </table>
   </form>
   <?php
   if(isset($erreur)) {
      echo '<font color="red">'.$erreur."</font>";
   }
   ?>
</div>
