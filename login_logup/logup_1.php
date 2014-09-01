<?
include ("inc/connessione.php");
include_once("szGenPass.inc.php");
$password = szGenPass::generatePassword();

/*javascript:document.forms['EditForm'].state.value='browse';document.forms['EditForm'].state2.value='main';document.forms['EditForm'].submit();*/

if ($avvisoreg=="") { $avvisoreg="Iscrizione effettuata con successo. I dati necessari al login sono stati inviati alla casella di posta indicata durante la registrazione.";  }

if ($controlloreg=="OK")
	{
	$ip = getenv("REMOTE_ADDR");
	$dataiscrizione = date ("d-m-Y H:i:s");
	$timeiscrizione = time();

	$nome=htmlspecialchars($nome);
	$password=htmlspecialchars($password);


	mysql_query("INSERT INTO user (user, password, sesso, email, dataiscrizione, timeiscrizione, ip) VALUES ('$nome', '$password', '$sesso', '$mail', '$dataiscrizione', '$timeiscrizione', '$ip')");
	
	include ("smtpmailer.php");
	
	}
	
?>
<html>
<head>

</head>
<body>
<TABLE width="500" height="200" align="center">
<TR>
    <TD> <div align="center"><? echo $avvisoreg; ?><br />nome: <? echo $nome; ?><br />email: <? echo $mail; ?><br />sesso: <? echo $sesso; ?><br />because our host temporarily sucks we give you the password: <? echo $password; ?>
      </div></TD>
<TR>
    <TD> <div align="center"><a href="index.php">Torna alla HomePage</a></div></TD></TR>
	<? if ($controlloreg!="OK") { ?><TR><TD> <div align="center"><a href="logup.php">Torna indietro</a></div></TD></TR><? } ?>

    

</TABLE>
</body>
</html>