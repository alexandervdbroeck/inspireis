<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
// laden van mailfuncties
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2 ;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'alexander.vdbroeck@gmail.com';                     // SMTP username
        $mail->Password   = 'Ivhlvtds2010';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('alexander.vdbroeck@gmail.com', 'inspireis-login');
        $mail->addAddress('alexander.vdbroeck@gmail.com', 'user');     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
        //  $mail->addReplyTo('info@example.com', 'Information');
        //   $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'mail-verificatie';
        $mail->Body = '<a href="localhost/inspireis/mailactive.php?id='.$_SESSION["hash"].' " >volg de link</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        session_unset(['hash']);
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }



