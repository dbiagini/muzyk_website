<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<link rel="stylesheet" type="text/css" href="styles.css" />



<title>Insert New Advert</title>



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







<?php


$usrid=$_POST['Value1'];

$text=$_POST['Value2'];

$city=$_POST['Value3'];

$category=$_POST['dff_mernum'];

$region=$_POST['dff_Selregion'];



$err_cond=0;



if(empty($usrid))   //usrIdError

{

	$err_cond=1;	

	}

if((!$err_cond)&&empty($text))   //ContentError //if $err_cond is zero there is already and error

{

	$err_cond=2;	

	}

if((!$err_cond)&&empty($_FILES['UploadedFile']['name']))   //PictureError

{

	$err_cond=3;	

	}

	

if(!$err_cond)

{



session_start();



include("./login_logup/inc/parametri.php");



include ("./login_logup/inc/connessione.php");
include ("./UploadFile.php");



$target_path = "uploads/";
$target_string="UploadedFile";
//$target_path = $target_path . basename( $_FILES['UploadedFile']['name']); 

if($memor=_StoreFile($target_path,$target_string)) {
	
	
	$query = "INSERT INTO ads(usrid,text,picture,category,region,city) VALUES('$usrid','$text','$memor','$category','$region','$city')";
	mysql_query($query);

    echo "The file ".  basename( $_FILES['UploadedFile']['name']). 

    " has been uploaded";
	
	 echo "into: " . $memor . "<br />";

} else{

    echo "There was an error uploading the file, please try again!";

}

?>



<div id="centeradd">



<br> 

<center>

<p>Your Advert was successfully posted to our Database</p>

<br>

<a href="insert.php"> Go back --></a>

<br>

</center>

</div>





<?php



}else

{

	

		if($err_cond==1)

		{

			?>

			<div id="centeradd">

	

			<br> 

			<center>

			<p>ERROR: User Id not Recognized</p>

            <br>

            <p>Please press the BACK button in your browser and try again or the link below</p>

			<br>

			<a href="insert.php"> Go back --></a>

			<br>

			</center>

			</div>

			<?php

        }elseif($err_cond==2)

		{

		?>

			<div id="centeradd">

	

			<br> 

			<center>

			<p>ERROR: The Field Content of your Advert is Empty</p>

            <br>

            <p>Please press the BACK button in your browser and try again or the link below</p>

			<br>

			<a href="insert.php"> Go back --></a>

			<br>

			</center>

			</div>

			<?php

		

		}elseif($err_cond==3)

		{

			?>

			<div id="centeradd">

	

			<br> 

			<center>

			<p>ERROR: The Field Picture of your Advert is Empty</p>

            <br>

            <p>Please press the BACK button in your browser and try again or the link below</p>

			<br>

			<a href="insert.php"> Go back --></a>

			<br>

			</center>

			</div>

			<?php

		}

		

	

	

	}



?>





</div>



</div>



</div>

</body>

</html>