<?php
    session_start();
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../lib/PHPMailer/trunk/src/Exception.php';
    require '../lib/PHPMailer/trunk/src/PHPMailer.php';
    require '../lib/PHPMailer/trunk/src/SMTP.php';

    require_once 'connect.php';
    require_once 'config.php';

    // Insription d'un nouvel utilisateur

    $nom = strip_tags($_POST['name']);
    $prenom = strip_tags($_POST['firstname']);
    $pseudo = strip_tags($_POST['pseudo']);
    $email = htmlspecialchars($_POST['mail']);
    $tel = strip_tags($_POST['phone']);
    $password = password_hash($_POST['password'],PASSWORD_ARGON2I);
    $token = rand(0,9999);

    $ri_utilisateur = $conn->prepare('INSERT INTO user 
        (`name`,`first_name`,`pseudo`,`mail`,`phone`,`password`,`token`) 
        VALUES 
        (:nom, :prenom, :pseudo, :mail, :tel, :pass, :token)');
    if($ri_utilisateur->execute([
        'nom'=>$nom,
        'prenom'=>$prenom,
        'pseudo'=>$pseudo,
        'mail'=>$email,
        'tel'=>$tel,
        'pass'=>$password,
        'token'=>$token
    ])){
        $mail = new PHPMailer(true);

        try {
            
            $mail->SMTPDebug = 1;                      
            $mail->isSMTP();                                            
            $mail->Host       = SMTP;                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = MAIL;                     
            $mail->Password   = PASS_MAIL;                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;
            $mail->CharSet = 'UTF-8';                                   

            
            $mail->setFrom(MAIL);
            $mail->addAddress($email);     

            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Création de compte réussi !';
            $mail->Body    = '<h1>Bienvenue'.$pseudo.'sur Outlet</h1><br>
                            <h2>Vous pouvez dès à présent commencer a rédiger des commentaires.</h2>
                            <p>connnectez-vous en saisissant le code :</p>';

            if($mail->send()){
                header('Location:../index.php');
                exit;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }