<?php

/* Template Name: mailsend */
get_header();

global $wpdb;
$id_user = get_current_user_id();
$userEmail = $wpdb->get_col("SELECT user_email FROM cv_users WHERE ID= $id_user");
$userEmail = $userEmail[0];

//$userEmail = $meta_user[''];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$mail = new PHPMailer(true);


try {
    //Server settings
//    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = "smtp.mail.com";                             //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'CVCorp@mail.com';                     //SMTP username
    $mail->Password   = 'loulou76raisin';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('CVCorp@mail.com', 'CVCorp');
    $mail->addAddress($userEmail);               //Name is optional

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'CV bien modifié!';
    $mail->Body    = 'Votre CV a bien ete modifie! <br>Merci, <b>L\'equipe CVCorp.</b>';
    $mail->AltBody = 'Votre CV a bien ete modifie! Merci, L\'equipe CVCorp.';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
};

get_footer();