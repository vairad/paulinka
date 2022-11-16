<?php
global $data;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

$logger = Logger::getLogger("send");

foreach ($_POST as &$value){
    $value = strip_tags($value);
}

$logger->debug("Send script");

$logger->debug($_POST);

$mail = new PHPMailer();
$logger->debug("mail instance created");

try {
  //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                               // Enable verbose debug output

    $mail->isMail();
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($_POST["mail"].'', $_POST["name"].'');
    $mail->addAddress("paulina.louka@skaut.cz", 'Webový automat' );
    $mail->addAddress($_POST["mail"].'', $_POST["name"].'');     // Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Paulina louka - Webový automat ';
    $mail->Body    =  $_POST["msg"].'';
    $mail->AltBody =  $_POST["msg"].'';

 //   if(!$mail->send()) {
//        $data["error"] = 'Zpráva nebyla odeslána';
//        $logger->error('Mailer Error: ' . $mail->ErrorInfo);
//    } else {
//        $data["success"] = "Zpráva byla odeslána.";
//        $logger->debug('Mailer Success!');
//    }

} catch (Exception $e) {
    $data["error"] = 'Zpráva nebyla odeslána';
    $logger->error("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}

$logger->debug("END Send script");

