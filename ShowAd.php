<?php 
session_start();
include("./login_logup/inc/parametri.php");
include ("./login_logup/inc/connessione.php");

$controllogin1 = "NO";
$nome= "";
$AdId=$_GET["AdId"];

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

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyDwrbAM2sUUmzSGT7AhFk4YxoPuQW_WDmU"
      type="text/javascript"></script>
    <script type="text/javascript">

    var map = null;
    var geocoder = null;
	var marker = null;
	var point= null;

    function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map_canvas"));
        //map.setCenter(new GLatLng(52.348763, 19.464111), 1);
        map.setUIToDefault();
		if(point==null){
			map.setCenter(new GLatLng(52.348763, 19.464111), 1);
			//map.openInfoWindow(map.getCenter(),document.createTextNode("Unknown Address"));
		}else{
			map.setCenter(point, 15);
			map.addOverlay(marker);
		}
	  }
	  
    }


    function showAddress(address) {
	geocoder = new GClientGeocoder();
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(pointL) {
            if (pointL == null) {
              //alert(address + " not found");
			  point= null; //GLatLng(52.348763, 19.464111);  ///poland default
			  //marker = new GMarker(point, {draggable: false, title: 'Unknown Address'});
            } else {
			   marker = new GMarker(pointL, {draggable: false, title: address });  //save marker
			   point=pointL; //save center of the map
			   //marker.openInfoWindow(document.createTextNode(address));
            }
          }
        );
      }
    }
    </script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Insert Form</title>

<link rel="stylesheet" type="text/css" href="styles.css" />
 

</head>

<body bgcolor="white" text="blue" onload="initialize()" onunload="GUnload() ">

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

<!---stuff hehe -->
<?php 

if(isset($AdId))
{

$query  = "SELECT usrid,text,datetime,picture,id, region, city FROM ads WHERE id = $AdId";

$result = mysql_query($query);

  while($row=mysql_fetch_array($result))	
	{


	if($row['id'] = $AdId)
	{

	?>
	<div id="textadd">
	<div id="ad_wrapper">
	<div id="centeradd" style=" width:300px; height: 500px">

	<div id="admain_text" style=" width:300px;" >
	<?php 
	
	if($row['picture']) $urlim="./".$row['picture'];
	else $urlim=false;
	
	//$urlim="./".$row['picture'];

	  echo "User ID:{$row['usrid']} <br>". 

	  	   "{$row['text']}<br>".

		   "Date:{$row['datetime']}<br>". 
		   
		   "Region:{$row['region']}<br>". 
		   
		   "City:{$row['city']}<br>"; 

		  // "image:{$urlim}<br>";

		   ?> 
		   </div>
			<div id="admain_image"><?php
			if(file_exists($urlim))
		   {

		    ?> <img src=<?php echo $urlim?> align="right" height="100" width="100"> <?php 
			}
           else
		   {

		   ?> <img src="./noimage.png" align="right" height="100" width="100"><?php

		   }

		   ?> 
			</div>
			
			
			
			<?php
			if(isset($row['region'])||isset($row['city']))
			{
				include('listRegions.php');
				$region="";
				foreach($dff_regions as $ra){
					if($ra[0]==$row['region'])
					{
						$region=$ra[1];						
					   
					}
				}
				echo '<script type="text/javascript"> showAddress("'.$region.','.$row['city'].'"); </script>'; 
				?>
				<br>
				<div id="admain_map">
				<div id="map_canvas" style="width: 200px; height: 200px; position: relative;  left: 50px; " ></div>
				<?php// echo "Region=$region  City= ".$row['city']; ?>
				<?php 
				
			} 
			?>
			
			</div> 
			
			</div>
			<div id="admain_adbar">
			<?php
			if($row['usrid']==$nome)
			{
				?>				
				<form method="post" action="edit.php" >
				  <input type="hidden" name="AdId" value= <?php echo($row['id'])?>> <br>
				  <input type="submit" value="Edit">
				</form> 
				<?php
			}
			?>
			
			</div>
			
			<div id="admain_facebook">
			 <div id="fb-root"></div>
			  <script>
				// Load the SDK Asynchronously
				(function(d){
				   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
				   if (d.getElementById(id)) {return;}
				   js = d.createElement('script'); js.id = id; js.async = true;
				   js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
				   ref.parentNode.insertBefore(js, ref);
				 }(document));
			  </script>

		  <div class="fb-like"></div>
		  </div>

<?php 
	} 

}
}
else
{
?>
<div >
<?php
echo "Id Not Found";
?>
</div>
<?php
}
?>

</div>
</div>

</body>

</html>