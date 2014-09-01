<?

include_once("inc/parametri.php");

$conn = mysql_connect($_CONFIG['host'], $_CONFIG['user'], $_CONFIG['pass']);
@mysql_select_db($_CONFIG['dbname']) or die( "Unable to select database");

?>

