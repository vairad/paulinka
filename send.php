<?php
global $data;

$logger = Logger::getLogger("send");

foreach ($_POST as &$value){
    $value = strip_tags($value);
}

$logger->debug("Send script");

$logger->debug($_POST);

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isMail();

$mail->setFrom($_POST["mail"].'', 'Webový automat');
$mail->addAddress($_POST["mail"].'', $_POST["name"].'');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Paulina louka - Webový automat ';
$mail->Body    =  $_POST["msg"].'';
$mail->AltBody =  $_POST["msg"].'';

if(!$mail->send()) {
    $data["error"] = 'Zpráva nebyla odeslána';
    $logger->debug('Mailer Error: ' . $mail->ErrorInfo);
} else {
    $data["success"] = "Zpráva byla odeslána.";
    $logger->debug('Mailer Success!');
}

$logger->debug("END Send script");