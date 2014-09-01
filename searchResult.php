<?php 
session_start();
include("./login_logup/inc/parametri.php");
include ("./login_logup/inc/connessione.php");

$controllogin1 = "NO";
$nome= "";
$KeyWord=$_GET["dff_keyword"];
$Category=$_GET["dff_mernum"];

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
<?php
if ($controllogin1 == "OK") {
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
} else
{ ?>
<div id="VerySmallTabBorder">
<div id="VerySmallTab" style="background-color: rgb(0, 229, 238);">
<p align="center"> <a style="font-family: arial; font-size: x-large; color: white; position: relative; margin-left: auto; margin-right: auto;" href="./login_logup/index.php">Login Logup</a> </p>
</div>
</div>
<?php 
} 
?>

<br>

<!---stuff hehe -->
<?php 

if($KeyWord!="")
{
	/*if(isset($Category))
	{
		$query  = "SELECT usrid,text,datetime,picture,id FROM ads WHERE category LIKE '%{$Category}%' and text LIKE '%{$KeyWord}%' ORDER BY datetime DESC";
	}else
	{*/
		$query  = "SELECT usrid,text,datetime,picture,id FROM ads WHERE text LIKE '%{$KeyWord}%' ORDER BY datetime DESC";	
	//}

	$result = mysql_query($query);

	if($result)
	{
		while($row=mysql_fetch_array($result))	
		{

			?>
		<div id="admain" onclick="location.href='ShowAd.php?AdId=<?php echo $row['id']?>'">
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

		<?php 

			

		}
	}else
	{
	  
	  echo "Uppps We don't have any result for you!! try different parameters.";
	  ?> <p align="center"><font color="#000000" size="2"><a href="index.php">Go Back to the Homepage</a></font></p>
	  <?php

	}
}else
{
  
  echo "empty Keyword, you need to insert something to search for";
  ?> <p align="center"><font color="#000000" size="2"><a href="index.php">Go Back to the Homepage</a></font></p>
  <?php

}
?>



</div>

</div>

</body>

</html>