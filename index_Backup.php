<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
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
  <title>Music market home</title>

  
  
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">

  
  <link rel="stylesheet" type="text/css" href="styles.css">

</head><body style="color: blue; background-color: white; background-image: url(BackgroundBig.jpg); background-repeat: repeat-x;">
<div id="background">
<div id="smallTabBorder">
<div id="smallTab"><img src="phase_logo.gif" height="180" width="180"> </div>
</div>
<?php
if ($controllogin1 != "OK") {
?>
<div id="VerySmallTabBorder">
<div id="VerySmallTab" style="background-color: rgb(0, 229, 238);">
<p align="center"> <a style="font-family: arial; font-size: x-large; color: white; position: relative; margin-left: auto; margin-right: auto;" href="./login_logup/index.php">Login Logup</a> </p>
</div>
</div>
<?php
}else
{
?>
<div id="VerySmallTabBorder">
<div id="VerySmallTab" style="background-color: rgb(0, 229, 238);">
<p align="center"> <a style="font-family: arial; font-size: x-large; color: white; position: relative; margin-left: auto; margin-right: auto;">Welcome <?php echo($nome)?> Bro!</a> </p>
</div>
</div>
<div id="VerySmallTabBorder">
<div id="VerySmallTab" style="background-color: rgb(0, 0, 0);">
<p align="center"> <a style="font-family: arial; font-size: x-large; color: white; position: relative; margin-left: auto; margin-right: auto;" href="./login_logup/logout.php">Logout</a> </p>
</div>
</div>
<?php
}
?>
<div id="VerySmallTabBorder">
<div id="VerySmallTab" style="background-color: rgb(50, 205, 50);">
<p align="center"> <a style="font-family: arial; font-size: x-large; color: white; position: relative; margin-left: auto; margin-right: auto;" href="insert.php">Insert Ad</a> </p>
</div>
</div>


<?php 


$query  = "SELECT usrid,text,datetime,picture FROM ads ORDER BY datetime DESC";

$result = mysql_query($query);


for ($i = 1; $i <= 4; $i++) {

	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	if($row)

	{

	?>
<div id="admain">
<div id="admain_text">
<?php 
	$urlim="./".$row['picture'];

	  echo "User ID:{$row['usrid']} <br>". 

	  	   "{$row['text']}<br>".

		   "Date:{$row['datetime']}<br>". 

		   "image:{$urlim}<br>";

		   ?> 
		   </div>
<div id="admain_image"><?php
			if(is_readable($urlim))
		   {

		    ?> <img src=<?php echo $urlim?> align="right" height="100" width="100"> <?php 
			}

           else
		   {

		   ?> <img src="./noimage.png" align="right" height="100" width="100"><?php

		   }

		   ?> </div>
</div>

<?php }

    

}

?>
</div>
</body></html>