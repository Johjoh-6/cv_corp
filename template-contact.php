<?php

/* Template Name: contact */
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
    $mail->addAddress('six.johann@gmail.com');               //Name is optional

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
};
get_header(); ?>


<section id="contact">
    <div class="wrap">
        <div class="titre-contact">
            <h2>Nous Contacter</h2>
            <div class="separator"></div>
        </div>
        
        <div class="info-contact">
            <div>
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto: cvcorp75@gmail.com">cvcorp75@gmail.com</a>
            </div>
            <div>
                <i class="fa-solid fa-phone"></i>
                <a href="tel: 0232559595">0232559595</a>
            </div>
            <div>
                <i class="fas fa-home"></i>
                <a href="https://www.google.com/maps/place/Need+for+School/@49.4304007,1.079024,17z/data=!3m1!4b1!4m5!3m4!1s0x47e0df1548cd768b:0x70b4b34959b1ec9f!8m2!3d49.4304007!4d1.0812127?hl=fr">31 PL henri benois 76100 Rouen</a>
            </div>
        </div>
    </div>
</section>





<?php get_footer();