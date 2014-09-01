<?php  

//require_once("phpmailer/class.phpmailer.php");
require("phpmailer/class.phpmailer.php"); // path to the PHPMailer class
 
error_reporting(E_ALL);

$email = new PHPMailer();  

$email->IsSMTP();  // telling the class to use SMTP
$email->Mailer = "smtp";
$email->SMTPDebug  = 1;
$email->Host = "smtp.gmail.com";
$email->Port = 25;
$email->SMTPAuth = true; // turn on SMTP authentication
$email->SMTPSecure = "ssl"; // sets the prefix to the servier
$email->Username = "muzyk.market"; // SMTP username
$email->Password = "muzykmarketpolska"; // SMTP password 

$email->AddReplyTo("muzyk.market@gmail.com","Webmaster");
 

//$email->IsSendmail(); // telling the class to use SendMail transport

$email->SetFrom("muzyk.market@gmail.com", "Muzyk Market");

$email->AddAddress($mail); 

$email->IsHTML(true);  
 
$email->Subject  = "MusikMarket Registration";
$email->Body     = "Grazie per esserti iscritto a MusikMarket \n Questi i tuoi dati: \n Nome-> $nome \n Password-> $password";
$email->WordWrap = 50;  
 
if(!$email->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $email->ErrorInfo;
} else {
echo 'Message has been sent.';
}
?>