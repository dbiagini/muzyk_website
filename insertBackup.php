<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php 
session_start();
include("./login_logup/inc/parametri.php");
include ("./login_logup/inc/connessione.php");

$controllogin1 = "NO";
$nome= "";

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {

	$cookie_usrname=$_COOKIE['username'];
	
	$cookie_password=$_COOKIE['password'];
	
    //Try to log in automatically
	$sqlcl1="select * from user WHERE user = '$cookie_usrname'";
	$tuttocl1=mysql_query($sqlcl1);
	
	if($tuttocl1){
		while($vcl1=mysql_fetch_array($tuttocl1))	
		{
		  if ($vcl1['user'] == $cookie_usrname)
		  {
			if (md5($vcl1['password']) == $cookie_password) //the password is encrypted
			 {
			  $controllogin1 = "OK";	
			  $nome= $cookie_usrname;			  
			 }	
		   }

		}
	}
    
} else
{ 
	$controllogin1 = "NO";
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Insert Form</title>

<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body bgcolor="white" text="blue">

<div id="background">

	<div id="logo">

<img src="phase_logo.gif" width=200px height=200px> 

	</div>

	<div id="bar">

<img src="TopBarTemp.jpg" width=600px height=100px> 

	</div>

<div id="textadd">

<div id="centeradd">

<br>
<?php
if ($controllogin1 == "OK") {
?>
<form action="insert_ad.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="Value1" value= <?php echo($nome)?> > UserId: <?php echo($nome)?> <br>
<textarea name="Value2" cols="20" rows="10"></textarea> Content <br>
<input type="file" name="UploadedFile"> Picture<br>
<input type="Submit">
</form>

<center>
<br>
<a href="index.php"> Go back --></a>
<br>
</center>
<?php 
} else
{ ?>
<center>
<br>
<a > You need to be logged in to post on this website </a>
<br>
<a href="./login_logup/index.php"> Go to login --> </a>
<br>
<a href="index.php"> Go back --> </a>
<br>
</center>
<?php 
} 
?>
</div>

</div>

</div>

</div>

</body>

</html>