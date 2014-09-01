<?php  
$to = "vitoculcasi@gmail.com"; 
$Subject = "yourubjectl"; 
$message = "NAME"; 
mail($to,$Subject,$message); 
if(mail){ 
echo "<BR />Thanks, message sent"; 
} 
else{ 
echo "<BR /> An Error occured"; 
}  
?>