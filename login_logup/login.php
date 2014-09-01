<?
session_start();
include ("inc/parametri.php");
include ("inc/connessione.php");

$nome=$_POST['nome'];
$password=$_POST['password'];
$rememberme=$_POST['rememberme'];

$controllogin1 = "NO";

// PRIMO CONTROLLO: NOME E PASSWORD CORRETTI
$sqlcl1="select * from user WHERE user = '$nome'";
$tuttocl1=mysql_query($sqlcl1);
//$vcl1=mysql_fetch_array($tuttocl1);
//echo "Username". $vcl1['user'];
if($tuttocl1){
	while($vcl1=mysql_fetch_array($tuttocl1))	
	{
	 //echo "Username".$vcl1['user'];
	  if ($vcl1['user'] == $nome)
	  {
	    if ($vcl1['password'] == $password) 
		 {
		  $controllogin1 = "OK";		   
		 }
	   }

	}
}

if ($rememberme) {
            /* Set cookie to last 1 year */
            setcookie('username', $nome, time()+60*60*24*365, '/', 'musicmarket.xtreemhost.com');
            setcookie('password', md5($password), time()+60*60*24*365, '/', 'musicmarket.xtreemhost.com');
        
        } else {
            /* Cookie expires when browser closes */
            setcookie('username', $nome, false, '/', 'musicmarket.xtreemhost.com');
            setcookie('password', md5($password), false, '/', 'musicmarket.xtreemhost.com');
        }

// SECONDO CONTROLLO: UTENTE NON GIA' ON LINE

//include ("controllogin.php");



// TERZO CONTROLLO: UTENTE ESILIATO

//include ("controlloesilio.php");     ///there is not exile yet

?>

<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/nero.css" rel="stylesheet" type="text/css">
</head>
<body>


<?
if ($controllogin1 == "NO") {

    ?><font color="#000000"><?
	echo "I dati inseriti non risultano registrati. Rieffettua il login e accertati di inserire i dati corretti.";
	?></font><?
	?><p align="center"><font color="#000000" size="+6"><a href="../index.php">Homepage</a></font></p><?


}
else
{  
   ?><font color="#000000"><?
	echo "Identification Succeeded Welcome $nome \n";
	?></font><? 
	header('Location: ../index.php');
}
/*if ($login!="NO")
{
  include ("benvenuto.php");
 }*/
/*if ($controllogin1 == "NO")
{
	?><font color="#000000"><?
	echo "I dati inseriti non risultano registrati. Rieffettua il login e accertati di inserire i dati corretti.";
	?></font><?
	?><p align="center"><font color="#000000" size="+6"><a href="../index.php">Homepage</a></font></p><?
}*/
/*else
{
	if ($avvlog == "NO")
  {
			?><font color="#000000"><?
			echo "Il personaggio risulta online. E' probabile che abbia abbandonato il gioco senza effettuare il logout. Attendi qualche secondo e ritenta.";
			?></font><?
			?><p align="center"><font color="#000000" size="+6"><a href="../index.php">Homepage</a></font></p><?	
  }
}
if ($esilioOK == "NO")
	{
    ?><font color="#000000"><?
    echo "Il personaggio è in esilio fino al $datafineesilio e non potrà rientrare prima di tale data.";
    ?></font><?
    ?><p align="center"><font color="#000000" size="+6"><a href="../index.php">Homepage</a></font></p><?
  }
  */

?>
</body>
</html>