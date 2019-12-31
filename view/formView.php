<section id="slideshow-home">
    <span id="slideshow-link"></span>
    <div class="carousel-container">
        <figure class="carousel-slides">
            <div class="enabled">
                <img src="public/images/img/HeroPicture.jpg" alt="">
            </div>
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
    if ($datas['envoi'] === TRUE) {
        echo "Mail envoyé !";
    } elseif ($datas['envoi'] === FALSE)  {
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