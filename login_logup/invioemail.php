<?php
$to      = "davidbiagini.pro@gmail.com";
$subject = "MusikMarket Registration";
$message = "Grazie per esserti iscritto a MusikMarket". "\r\n" ."Questi i tuoi dati:". "\r\n" ."Nome-> $nome". "\r\n" .'Password-> $password';
//$headers = "From: webmaster@musicmarket.cz.cc" . "\r\n" .
   // 'No-Reply' . "\r\n" .
  //   Return-Path:<name@domain.com>\r\n
 //   'X-Mailer: PHP/' . phpversion();

$headers ="From: MuzykMarket <Muzyk.Market@gmail.com>\r\n";
$headers .="MIME-Version: 1.0\r\n";
$headers .="Content-type: text/plain; charset=utf-8\r\n";
$headers .="Content-Transfer-Encoding: 8bit";
$headers .="Return-Path:<Muzyk.Market@gmail.com>\r\n";
//$headers .="Return-Path: detect-bounce@example.com\r\n";
$headers .="Return-Receipt-To: Muzyk.Market@gmail.com\r\n"; 

$message = wordwrap($message, 70);


error_reporting(E_ALL|E_STRICT);
ini_set('sendmail_from',"no-reply@mydomain.net");

ini_set('display_errors', 1);
echo 'I am : ' . `Dav`;
$result = mail('davidbiagini.pro@gmail.com','Testing 1 2 3','This is a test.');
echo '<hr>Result was: ' . ( $result === FALSE ? 'FALSE' : 'TRUE') . $result;
echo '<hr>';



mail('davidbiagini.pro@gmail.com', 'the subject', 'the message', null,'-fMuzyk.Market@gmail.com');

if(!mail($to, $subject, $message, $headers)) {
echo 'Message was not sent.';
} else {
echo 'Message has been sent to your mail.';
}
?>
