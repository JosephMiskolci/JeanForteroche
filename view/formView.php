<section id="TopPicture">
    <figure class="HeroPicture">
        <ul>
            <li class="enabled"><img src="public/images/img/HeroPicture.jpg" alt="">
        </ul>
    </figure>
</section>

<section id="FormTitle">
    <div class="BiographyTitle">
        <h1>
            Formulaire de contact :
        </h1>
    </div>
</section>

<section class="contactForm">

    <div class="ProfileCommentaries">
        <h5>Attention, ce formulaire n'est à utiliser qu'en cas d'erreurs ou de bugs sur le site. Pour contacter directement Jean Forteroche, vous pouvez utiliser les réseaux sociaux !</h5>
    </div>
    <?php
if ($datas['envoi'] === true) {
    echo "Mail envoyé !";
} elseif ($datas['envoi'] === false) {
    echo "Le Mail n'a pas été envoyé. Veuillez réessayer !";
}?>

    <div class="FormInfos">
        <form method="POST" action="index.php?action=sendcontact">
            <p><input type="text" name="nom" placeholder=" Nom" required /></p>
            <p><input type="email" name="mail" placeholder=" E-mail" required /></p>
            <p><input type="text" name="objet" placeholder=" Objet" /></p>
    </div>
    <div class="formMessage">
        <p><textarea name="message" placeholder=" Message" required></textarea></p>
        <input type="submit" value="Envoyer" />
        </form>
</section>