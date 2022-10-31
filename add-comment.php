<?php
    require_once 'inc/header-html.php';
    $ok = false;
    if(isset($_POST['envoyer'])){

        $article = intval($_POST['article']);
        $titre = strip_tags($_POST['titre-comm']);
        $commentaire = htmlspecialchars($_POST['contenu']);

        $ri_commentaire = $conn->prepare('INSERT INTO `comment`
                (`idx_user`,`idx_post`,`title_comment`,`content_comment`)
            VALUES
                (:user, :post, :titre, :commentaire)
        ');
        if($ri_commentaire->execute([
            ':user' => $_SESSION['id'],
            ':post' => $article,
            ':titre' => $titre,
            ':commentaire' => $commentaire 
        ])){
            $ok = true;
        }
    }
?>
<main>
<div class="container">
    <div class="row mb-5">
        <div class="col">
            <h3 class="text-center">Rédigez un commentaire</h3>
            <?php if($ok): ?>
                <div class="alert alert-success" id="valide" role="alert">
                    <p>Commentaire réalisé avec succès !</p>
                </div>
            <?php endif ?>
            <form method="post">
                <div class="row mb-2"><!-- Choix de l'article à commenter -->
                    <div class="form-floating mb-3">
                        <select class="form-select" name="article" required>
                            <option value=""></option>
                            <?php
                                $rs_articles = $conn->prepare('SELECT `id_post` `id`,`title_post` `post` FROM `post`ORDER BY `id_post` DESC LIMIT 30 ');
                                $rs_articles->execute();
                                foreach($rs_articles as $article) :
                            ?>
                                <option value="<?=$article[0]?>"><?=$article[1]?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="article">Sélectionnez un article à commenter</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                          <input
                            type="text"
                            class="form-control" name="titre-comm" id="titre-comm" placeholder="" required>
                          <label for="titre-comm">Titre commentaire</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <textarea id="trumbowyg" name="contenu" required></textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <button class="btn btn-success" name="envoyer">Envoyer le commentaire</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
<?php
    include_once 'inc/footer.php';
?>