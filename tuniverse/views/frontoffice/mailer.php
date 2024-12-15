<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;


   // Serveur SMTP de Gmail
   $mail->SMTPDebug= 2;
   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = true;
   $mail->Username = 'clash.bouallegue@gmail.com';  // Adresse e-mail de l'expéditeur
   $mail->Password = 'raddntsmgquwiwew';  // Mot de passe spécifique à l'application Gmail
   $mail->SMTPSecure = 'tls';
   $mail->Port = 587;

   // Destinataire
   $mail->setFrom('clash.bouallegue@gmail.com', 'tuniverse');
   $mail->addAddress($email);  // L'adresse e-mail du destinataire
   $resetLink = "http://localhost/tun2/views/frontoffice/reset-password.php";

  


return $mail;

