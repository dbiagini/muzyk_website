<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php 
session_start();
include("./login_logup/inc/parametri.php");
include ("./login_logup/inc/connessione.php");
include ("./UploadFile.php");

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
///form self post///

global $formError,$Value2,$Value3,$dff_mernum,$dff_Selregion,$fileMemor;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['Value2'])) {
       $formError = 1;
    }
    else {
        $Value2 = $_POST['Value2'];
    }

    if (empty($_POST['Value3'])) {
         $formError = 1;
    }
    else {
        $Value3 = $_POST['Value3'];
    }

    if ($_POST['dff_mernum']== -1 )  {
         $formError = 1;
    }
    else {
        $dff_mernum = $_POST['dff_mernum'];
    }
	
	if ($_POST['dff_Selregion'] == -1)  {
         $formError = 1;
    }
    else {
        $dff_Selregion = $_POST['dff_Selregion'];
    }
	if(!empty($_FILES['UploadedFile']['name'])){
	
		$target_path = "uploads/";
		$target_string="UploadedFile";
		
		$fileMemor=_StoreFile($target_path,$target_string);
		if($fileMemor==false){
			$formError=1;
			$fileMemor="FAIL";
		}
	
	}else if (!empty($_POST['UploadDone']))  {
         $fileMemor=$_POST['UploadDone'];
		 ///here the $fileMemor was already set we cannot select anymore///
    }
	
	if($formError != 1)
	{ 
		$query = "INSERT INTO ads(usrid,text,picture,category,region,city) VALUES('$nome','$Value2','$fileMemor','$dff_mernum','$dff_Selregion','$Value3')";
		mysql_query($query);
		$formError = 2;
	}
}else{
	$formError = 0;
	$Value2 = $Value3 = "";
	$dff_mernum = $dff_Selregion = -1;
	$fileMemor="";

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
<?php
if ($controllogin1 == "OK") {
	if($formError != 2){  //not finished adding things to the form
		include('SearchCategories.php');
		include('listRegions.php');
		?>
		<form method="post" action= "insert.php" enctype="multipart/form-data">
		<input type="hidden" name="Value1" value= <?php echo($nome)?> > UserId: <?php echo($nome)?> <br>
		<textarea name="Value2" cols="20" rows="10" ><?php echo($Value2);?></textarea> Content <br>
		<select name="dff_mernum" size="1">
		<option value="-1">All Categories
		<?php
		  foreach($dff_merarr as $ma){
			if($ma[0]==$dff_mernum)
			{
				echo '<option value="'.$ma[0].'" selected="selected">'.$ma[1];
			}else echo '<option value="'.$ma[0].'">'.$ma[1];
		  }
		?>
		</select> Category <br>
		<select name="dff_Selregion" size="1" >
		<option value="-1">Select Region
		<?php
		  foreach($dff_regions as $ra){
			if($ra[0]==$dff_Selregion)
			{
				echo '<option value="'.$ra[0].'" selected="selected">'.$ra[1];
			}else echo '<option value="'.$ra[0].'">'.$ra[1];
		  }
		?>
		 </select> Region <br>
		<input type="text" name="Value3" <?php echo "value= '$Value3'";?> > City <br>
		<?php if($fileMemor==""){ ?>
		<input type="file" name="UploadedFile"> Picture<br>
		<?php }else if($fileMemor=="FAIL"){ ?>
		<input type="file" name="UploadedFile" style="background-color: rgb(255, 0, 0);"> Retry <br>
		<?php }else{ ?>
		<input type="file" name="UploadedFile" disabled="disabled" style="background-color: rgb(50, 205, 50);"> Uploaded! <br>
		<input type="hidden" name="UploadDone" value= <?php echo($fileMemor)?>> <br>
		<?php
		} ?>
		<input type="Submit">
		<?php
		if($formError == 1){
		?>
		<a>  Something is missing, Please complete the form  </a>
		<?php
		} else if($formError == 2)
		{
		?>
		<a>  Form Completed!  </a>
		<?php
		}
		?>
		</form>

		<a>  Value of the variables <?php echo " text:$Value2, City:$Value3, Category: $dff_mernum, Reg:$dff_Selregion, File: $UploadedFile "; ?>  </a>

		<center>
		<br>
		<a href="index.php"> Go back --></a>
		<br>
		</center>
		<?php 
	}else
	{
		?>
		<br> 

		<center>

		<p>Your Advert was successfully posted to our Database</p>

		<br>

		<a href="insert.php"> Go back --></a>

		<br>

		</center>
	
		<?php
	}
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