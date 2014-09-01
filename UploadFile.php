<?php
 function _StoreFile($target_path, $entry)
{
	
	 //echo "Entered function ".$_FILES[$entry]["name"]."<br />";
	
if ((($_FILES[$entry]["type"] == "image/gif")

|| ($_FILES[$entry]["type"] == "image/jpeg")

|| ($_FILES[$entry]["type"] == "image/png")

|| ($_FILES[$entry]["type"] == "image/pjpeg"))

&& ($_FILES[$entry]["size"] < 2000000))

  {

  if ($_FILES[$entry]["error"] > 0)
    {

       return false;

    } else
    {

		echo "Upload: " . $_FILES[$entry]["name"] . "<br />";

		echo "Type: " . $_FILES[$entry]["type"] . "<br />";

		echo "Size: " . ($_FILES[$entry]["size"] / 1024) . " Kb<br />";

		echo "Temp file: " . $_FILES[$entry]["tmp_name"] . "<br />";
		
		
	 
		$ext = findexts ($_FILES[$entry]['name']);
		$rename= str_makerand(12, 12, false, false, true);
		
		
	   $target_path = $target_path . $rename .".". $ext; 


		if (file_exists($target_path))
		{
		   return false;
		}
		else
		{
			move_uploaded_file($_FILES[$entry]['tmp_name'], $target_path);
			return $target_path;

		}

	}
  }else
  {
	return false;
  }
}

 function findexts ($filename) 
 {
	  $filename = strtolower($filename) ; 
	  $exts = split("[/\\.]", $filename) ; 
	  $n = count($exts)-1; 
	  $exts = $exts[$n]; 
	  return $exts; 
}
  //This applies the function to our file  $ext = findexts ($_FILES['uploaded']['name']) ;
  
function str_makerand ($minlength, $maxlength, $useupper, $usespecial, $usenumbers)
{
/* 
Author: Peter Mugane Kionga-Kamau
http://www.pmkmedia.com

Description: string str_makerand(int $minlength, int $maxlength, bool $useupper, bool $usespecial, bool $usenumbers) 
returns a randomly generated string of length between $minlength and $maxlength inclusively.

Notes: 
- If $useupper is true uppercase characters will be used; if false they will be excluded.
- If $usespecial is true special characters will be used; if false they will be excluded.
- If $usenumbers is true numerical characters will be used; if false they will be excluded.
- If $minlength is equal to $maxlength a string of length $maxlength will be returned.
- Not all special characters are included since they could cause parse errors with queries. 

Modify at will.
*/
$charset = "abcdefghijklmnopqrstuvwxyz";
if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
if ($usenumbers) $charset .= "0123456789";
if ($usespecial) $charset .= "~@#$%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
else $length = mt_rand ($minlength, $maxlength);
for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
return $key;
}
 
 
?>