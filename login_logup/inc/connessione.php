<?

$conn = mysql_connect($_CONFIG['host'], $_CONFIG['user'], $_CONFIG['pass']);
if (!$conn)
{
	die('Could not connect: ' . mysql_error());
}

$db_selected=mysql_select_db($_CONFIG['dbname'], $conn);
if (!$db_selected)
{
	die ("Can\'t select Database : " . mysql_error());
	mysql_close($conn);
}

?>

