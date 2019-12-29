<?php
if ($_SESSION['admin'] == "1" or $_SESSION['moderator'] == "1") {
?>

    <section class="TopTitle">
        <h2>Managez vos publications :</h2>
    </section>

    <section id="Publications">

        <?php
        while ($data = $datas["comments"]->fetch()) {
            foreach ($datas["flags"] as $flag) {
                if ($data['id'] == $flag['id_comments']) {
                    $dislikes++;
                }
            }
        ?>
            <div class="Articles">
                <h3><?= htmlspecialchars($data["title"]) ?></h3>
                <!-- <div class="circle-admin"><i class="fas fa-exclamation-circle"></i> <?= $data['flag_comment'] ?></div> -->
                <p class="ArticleText"><?= nl2br(strip_tags($data['comment'])) ?></p>
                <div class="AccessButtonsUsersAdmin">
                    <a class="btn btn-warning" href="index.php?action=moderate&amp;id=<?= $data['com_id'] ?>" role="button">Modérer</a>
                    <a class="btn btn-danger" href="index.php?action=deleteComment&amp;id=<?= $data['com_id'] ?>" role="button">Supprimer définitivement</a>
                </div>
                <div class="ArticleDateAdmin">
                    <p>Publié le <?= $data['comment_date'] ?> par <strong><?= htmlspecialchars($data['author']) ?></strong></p>
                </div>
            </div>
            </div>
            <hr>
            </hr>
        <?php
        }
        $datas["comments"]->closeCursor();
        ?>
    </section>

    
    
<?php
} else {
    header("location: index.php?action=error");
}
?>