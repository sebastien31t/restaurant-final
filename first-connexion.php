<?php
    require_once 'inc/header-html.php';

    $maj_ok = false;

    if(isset($_POST['valider'])){

        $pseudo = strip_tags($_POST['pseudo']);
        $tokent = intval($_POST['token']);

        $rs_token = $conn->prepare('SELECT count(*) 
            FROM `user` 
            WHERE 
                `pseudo` = :pseudo AND 
                `token` = :token AND 
                NOW() < DATE_ADD(time_token,  INTERVAL 10 MINUTE)');
        $rs_token->execute([
            'pseudo'=>$pseudo,
            'token'=>$token
        ]);
        $token = $rs_token->fetch();

        // on teste si le time est inferrieur à 
        if($token[0] == 1){
            $up_actif = $conn->prepare('UPDATE `user` SET
                    `actif` = 1
                WHERE pseudo = ?');
            $up_actif->execute([$pseudo]);
            $maj_ok = true;
        }

    }

?>
<main>
    <section class="container margin-top">
        <form class="row" action="#" method="POST">
            <div class="col-md-4"></div>
            <div class="col-md-4 col-12">
                <?php if($maj_ok): ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Compte activé</strong> 
                        <hr>
                        <p>Votre compte est bien active !</p>
                    </div>
                <?php endif ?>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control" name="pseudo" id="" placeholder="">
                    <label for="pseudo">Pseudo</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control" name="token" id="" placeholder="">
                    <label for="token">Code</label>
                </div>
                <button type="submit" name="valider" class="btn btn-success btn-max">Valider</button>
            </div>
            <div class="col-md-4"></div>
        </form>
    </section>
</main>
<?php
    include_once 'inc/footer.php';
?>