<?php

    require_once 'inc/header.php';
    require_once 'config/config.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'lib/PHPMailer/trunk/src/Exception.php';
    require 'lib/PHPMailer/trunk/src/PHPMailer.php';
    require 'lib/PHPMailer/trunk/src/SMTP.php';

    
    $pseudo = true; // affiche le pseudo  a renseigner
    $token = false; // affiche pour la saisie du token et du mot de passe
    $token_nok = false; // retourne alert non ok
    $token_ok = false; // retourne alert ok
    $pseudo_nok = false; // le pseudo est inconnu

    if(isset($_POST['pseudo-val'])){

        $spseudo = strip_tags($_POST['pseudo']);

        $rs_pseudo_exist = $conn->prepare('SELECT COUNT(*)  FROM `user` WHERE `pseudo` = ?');
        $rs_pseudo_exist->execute([$spseudo]);
        $pseudo_exist = $rs_pseudo_exist->fetch();
        
        if($pseudo_exist[0] == 1){
            $rs_pseudo = $conn->prepare('SELECT `id_user`,`mail` FROM `user` WHERE `pseudo` = ?');
            $rs_pseudo->execute([$spseudo]);
            $ps = $rs_pseudo->fetch();

            $code_token = rand(0,9999);

            //On rentre le code et la date et heure (now) en base de donnée
            $ri_token = $conn->prepare('UPDATE `user` SET
                    token = :code_token,
                    time_token = CURRENT_TIMESTAMP()
                where id_user = :id_user');
            if($ri_token->execute([
                ':code_token' => $code_token,
                ':id_user' => $ps[0]
            ])){
                $token = true;
                $pseudo = false;

                $mail = new PHPMailer(true);

                try {
                    
                    $mail->SMTPDebug = 0;                      
                    $mail->isSMTP();                                            
                    $mail->Host       = SMTP;                     
                    $mail->SMTPAuth   = true;                                   
                    $mail->Username   = MAIL;                     
                    $mail->Password   = PASS_MAIL;                               
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                    $mail->Port       = 465; 
                    $mail->CharSet = 'UTF-8';                                    

                    
                    $mail->setFrom(MAIL);
                    $mail->addAddress($ps[1]);     

                    
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Outlet - Réinitialisation de mot de passe';
                    $mail->Body    = 'Veuillez saisir ce code depuis votre page de réinitialisation de mot de passe. <br> <strong>'.$code_token.'</strong>';

                    $mail->send();
                        
                } catch (Exception $e) {
                    echo $e;
                }
            }

        } else {
            $pseudo_nok = true;
        }
    };

    if(isset($_POST['token-val'])){

        $retour_token = intval($_POST['retour_token']);
        $pass = password_hash($_POST['pass'],PASSWORD_ARGON2I);

        $token = false;
        $pseudo = false;

        // On recherche si le token est valide
        $rs_token_valide = $conn->prepare('SELECT COUNT(*),`id_user`  FROM `user` WHERE  `token` = ? AND `time_token`+ INTERVAL 5 MINUTE > NOW() GROUP BY `id_user`');
        $rs_token_valide->execute([$retour_token]);
        $token_valide = $rs_token_valide->fetch();

        // On recherche si il y a bien un enregistrement valide
        if($token_valide[0] == 1){
            $up_pass = $conn->prepare('UPDATE `user` SET
                    `password` = ?
                WHERE `id_user` = ?');
            if($up_pass->execute([$pass,$token_valide[1]])){
                $token_ok = true; // si le token est valide
            }else{
                $token_nok = true;
            }
        }else {
            $token_nok = true; 
        }

    }

    require_once 'inc/header-html.php';
?>
<main>
    <div class="container text-center my-5">
        <?php if($pseudo):?>
            <div class="row"><!-- Demande de pseudo -->
                <div class="col"></div>
                <div class="col">
                    <h3>Nouveau mot de passe</h3>
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                class="form-control" name="pseudo" placeholder="">
                            <label for="pseudo">Votre pseudo</label>
                        </div>
                        <button class="btn btn-success" name="pseudo-val">Valider</button>
                    </form>
                    <?php if($pseudo_nok): ?>
                        <div class="alert alert-danger mt-2" role="alert">
                            <strong>Pseudo inconnu dans la base de données</strong>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col"></div>
            </div>
        <?php endif ?><!-- Fin de demande de pseudo -->
        <?php if($token) :?>
            <form method="post" class="row"><!-- Renseignement du token -->
                <div class="col"></div>
                <div class="col">
                    <div class="form-floating mb-3">
                      <input
                        type="text"
                        class="form-control" name="retour_token" id="formId1" placeholder="">
                      <label for="retour_token">Votre code recu par mail</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input
                        type="password"
                        class="form-control" name="pass" id="formId1" placeholder="">
                      <label for="pass">Nouveau mot de passe</label>
                    </div>
                    <button class="btn btn-success" name="token-val">Valider</button>
                </div>
                <div class="col"></div>
            </form><!-- Fin renseignement du token -->
        <?php endif ?>
        <?php if($token_ok):?>
            <div class="alert alert-success" role="alert">
                <strong>Votre mot de passe a été mis à jour</strong>
            </div>
        <?php endif ?>
        <?php if($token_nok):?>
            <div class="alert alert-danger" role="alert">
                <strong>Erreur lors de la mise à jour de votre mot de passe.</strong>
                <p>Merci de renouveler l'opération</p>
            </div>
        <?php endif ?>
    </div>
</main>

<?php
    include_once 'inc/footer.php';
?>