<?php
require_once('phpmailer/class.phpmailer.php');
require_once('phpmailer/class.pop3.php'); // required for POP before SMTP

$pop = new POP3();
$pop->Authorise('pop3.gmail.com', 110, 30, 'muzyk.market', 'muzykmarketpolska', 1);

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPDebug = 2;
$mail->Host     = 'pop3.gmail.com';

$mail->SetFrom('muzyk.market@gmail.com', 'Muzyk Market');

$mail->AddReplyTo("muzyk.market@gmail.com","Muzyk Market");

$email->Subject  = "MusikMarket Registration";
$email->Body     = "Grazie per esserti iscritto a MusikMarket \n Questi i tuoi dati: \n Nome-> $nome \n Password-> $password";
$email->WordWrap = 50; 


$email->AddAddress($mail); 


if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>