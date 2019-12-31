<?php
if ($_SESSION['admin'] == "1" or $_SESSION['moderator'] == "1") {
    ?>

    <section class="TopTitle">
        <h2>Managez vos publications :</h2>
    </section>


    <section id="Comments">
        <div class="CommentsName">
            <h2>Commentaires</h2>
        </div>
        <?php
while ($comment = $datas["comments"]->fetch()) {
        ?>

            <?php if ($_SESSION['id']) {
            $dislikes = 0;
            foreach ($datas["flags"] as $flag) {
            }

            if ($comment['com_id'] == $flag['id_comments']) {?>
                    <div class="Comment">
                        <div class="CommentariesRed">
                            <h3><?=htmlspecialchars($comment["title"])?></h3>
                            <p class="CommentaryText">
                                <?=nl2br(strip_tags($comment['comment']))?>
                            </p>
                            <div class="AccessButtonsUsersAdmin">
                                <a class="btn btn-info" href="index.php?action=unflagComment&amp;id=<?=$comment['com_id']?>" role="button">Supprimer le signalement</a>
                                <a class="btn btn-warning" href="index.php?action=moderate&amp;id=<?=$comment['com_id']?>" role="button">Modérer</a>
                                <a class="btn btn-danger" href="index.php?action=deleteComment&amp;id=<?=$comment['com_id']?>" role="button">Supprimer définitivement</a>
                            </div>
                            <p class="ArticleDate">Publié le <?=$comment['comment_date']?> par <strong><?=htmlspecialchars($comment['author'])?></strong></p>
                        </div>
                        <hr>
                        </hr>
                    </div>
    </section>
<?php
} else {?>
    <div class="Comment">
        <div class="Commentaries">
            <h3><?=htmlspecialchars($comment["title"])?></h3>
            <p class="CommentaryText">
                <?=nl2br(strip_tags($comment['comment']))?>
            </p>
            <div class="AccessButtonsUsersAdmin">
                <a class="btn btn-warning" href="index.php?action=moderate&amp;id=<?=$comment['com_id']?>" role="button">Modérer</a>
                <a class="btn btn-danger" href="index.php?action=deleteComment&amp;id=<?=$comment['com_id']?>" role="button">Supprimer définitivement</a>
            </div>
            <p class="ArticleDate">Publié le <?=$comment['comment_date']?> par <strong><?=htmlspecialchars($comment['author'])?></strong></p>
        </div>
        <hr>
        </hr>
    </div>
    </section>
<?php
}
        }?>

<?php
}
    $datas["comments"]->closeCursor();
} else {?>
header("location: index.php?action=error");
<?php
}
?>