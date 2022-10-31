<?php
    require_once 'inc/header-html.php';
?>
<div class="container margin-top">
    <div class="row">
    <main class="col-md-9">
    <?php
        //Affichage les 30 derniers articles
        $rs_articles = $conn->prepare('SELECT `id_post`,`idx_category`,`title_post` `titre`,`content_post` `content`,`post_image` `image`,`alt_image` `alt`  FROM `post`ORDER BY `id_post` DESC LIMIT 30 ');
        $rs_articles->execute();
        foreach($rs_articles as $article):
    ?>
    <article class="mb-3">
        <h3><?=$article['titre']?></h3>
        <h4>
            <?php
                // recherche de la cathégorie
                $rs_cat = $conn->prepare('SELECT `id_category`,`designation` FROM `category` WHERE `id_category` LIKE ?');
                $rs_cat->execute([$article[1]]);
                $cat = $rs_cat->fetch();
                echo $cat[1]
            ?>
        </h4>
        <p>
            <img src="<?php echo 'upload/'.$article['image']?>" alt="<?=$article['alt']?>" width="300">
            <?php 
                echo html_entity_decode($article['content']);
            ?> 
        </p>
        <?php
            // On ajoute les commentaires pour chaques articles
            $rs_commentaire = $conn->prepare('SELECT `idx_user`,`title_comment`,`content_comment` FROM `comment`where `idx_post` = ?');
            $rs_commentaire->execute([$article['id_post']]);
            foreach($rs_commentaire as $commentaire):
        ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"><?=$commentaire['title_comment']?></h4>
                <p>
                    <?php echo html_entity_decode($commentaire['content_comment']) ?>
                </p>
                <small>
                    <?php 
                        $rs_user = $conn->prepare('SELECT `pseudo` FROM `user` WHERE `id_user` = ?');
                        $rs_user->execute([$commentaire['idx_user']]);
                        $user_comm = $rs_user->fetch();
                        echo "Rédigé par : $user_comm[0]";
                    ?>
                </small>
            </div>
        <?php endforeach ?>
    </article>
    <?php endforeach ?>
    </main>
    <?php
    // Affichage des articles

    ?>
    <aside class="col-md-3 text-align-center mb-3">
        <?php if(!isset($_SESSION['nom'])): ?>
            <h2>login</h2>
            <form action="config/connexion.php" method="post">
                <input type="text" class="form-control mb-2" name="pseudo" maxlength="30" placeholder="Pseudo">
                <input type="password" class="form-control mb-2" name="pass" maxlength="255" placeholder="Mot de passe">
                <button type="submit" class="btn btn-success btn-max mb-3">Valider</button>
            </form>
            <a href="new-mdp.php"><small>Mot de passe oublié</small></a>
            <hr>
            <a href="inscription.php"><button class="btn btn-success btn-max my-3">Inscription</button></a>
            <?php else : ?>
                <h3 class="mt-3">Bonjour <?=$_SESSION['pseudo']?></h3>
                <a href="config/deconnect.php"><button class="btn btn-danger btn-max my-3">Déconnexion</button></a>
                <hr>
                <?php if($_SESSION['admin']) : ?>
                    <a href="ajouter-post.php"><button class="btn btn-success btn-max mb-3">Créer un article</button></a>
                <?php endif ?>
                <a href="add-comment.php"><button class="btn btn-success btn-max mb-3">Creer un commentaire</button></a>
            <?php endif ?>
    </aside>
    </div>
</div>
<?php
    include_once 'inc/footer.php';
?>