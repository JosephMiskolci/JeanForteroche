<div align="center">
  <section class="TopTitle">
    <h2>Modification du mot de passe</h2>
 </section>

 <section class="ProfileEdit">

   <div class="ProfileCommentaries">
     <h3>Éléments impossibles à modifier !</h3>
     Pseudo = <?php echo $_SESSION['pseudo']; ?>
     <br />
     Mail = <?php echo $_SESSION['mail']; ?>
     <br /><br />
   </div>

   <div class="FormEditionProfile">
     <form method="POST" action="" enctype="multipart/form-data">
       <table>
          <tr>
             <td>
               <input type="password" name="newmdp1" placeholder=" Nouveau mot de passe"/><br /><br />
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
