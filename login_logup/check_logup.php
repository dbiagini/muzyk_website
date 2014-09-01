<?
include ("inc/parametri.php");
include ("inc/connessione.php");

$slash="/";

$nome=$_POST[nome];
$mail=$_POST[email];
$sesso=$_POST[sesso];

$controlloreg="OK";
$avvisoreg="Registrazione effettuata con successo";

if ($nome=="") {
               $controlloreg="NO";
               $avvisoreg="Per favore compila ogni campo della registrazione.";
			   }		   
			   
if ($mail=="") {
               $controlloreg="NO";
               $avvisoreg="Per favore compila ogni campo della registrazione.";
			   }
			   
if ($sesso=="") {
               $controlloreg="NO";
               $avvisoreg="Per favore compila ogni campo della registrazione.";
			   }

$nome=ucfirst($nome);

if ($controlloreg=="OK")
	{

	$sql="select * from user";
	$tutto=mysql_query($sql,$conn);
	while ($controllo=mysql_fetch_array($tutto))
		{
		if ($nome==$controllo[user])
			{
			$controlloreg="NO";
			$avvisoreg="Il nome e' gia' in uso. Per favore inserire un nome diverso.";
			}
		}
	}


include ("logup_1.php");

?>