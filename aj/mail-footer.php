<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../lib/PHPMailer/trunk/src/Exception.php';
    require '../lib/PHPMailer/trunk/src/PHPMailer.php';
    require '../lib/PHPMailer/trunk/src/SMTP.php';
    require '../config/config.php';

    $nom = strip_tags($_POST['nom']);
    $objet = strip_tags($_POST['objet']);
    $message = htmlspecialchars($_POST['message']);

    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = SMTP;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = MAIL;                     //SMTP username
    $mail->Password   = PASS_MAIL;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom(MAIL, 'Outlet');
    $mail->addAddress(MAIL, $nom);     //Add a recipient
    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Contact depuis le formulaire de pied de page';
    $mail->Body    = 'Message de '.$nom.'<br>'.$message;

    $mail->send();
    echo true;
} catch (Exception $e) {
    // echo $e;
    echo false;
}