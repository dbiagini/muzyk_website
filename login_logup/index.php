<?php
/* session_destroy(); */

/* session_start(); */

/* echo "<link rel=\"shortcut icon\" href=\"disegnini/favicon.ico\" type=\"image/x-icon\">"; */


?>

<html>
<head>
<title>login logup</title>

</head>

<body>
<!--
<TABLE width="600" height="169" align="center">
  <form action="login.php" method="post">
<TR>
      <TD height="23"></TD>
<TD>Inserisci i dati.</TD></TR>

<TR>
	<TD width="33%" height="26">User:</font> 
		<input name="nome" type="text" size="12" maxlength="12">
	</TD>
	<TD width="34%"> <font size="-1">Password:</font> 
		<input name="password" type="password" size="12" maxlength="12">
	</TD>
	<TD width="33%"> 
		<center>
		<input type="submit" name="action" value="LogIN!"></center>
	</TD>
	<TD width="33%"> 
		Remember Me: <input type="checkbox" name="rememberme" value="1">
	</TD>
</TR>
</form>
<TR>
    <TD height="42"></TD>
</TR>
    <TD height="25"> 
      <div align="center"></div></TD>
    <TD>Oppure <a href="logup.php">registrati</a>.</TR>
<tr></tr>

</TABLE>
-->
<TABLE width="600" height="169" align="center">
<h2>User Login </h2>
  <form name="login" method="post" action="login.php">
   Username: <input type="text" name="nome" size="20" maxlength="20"><br>
   Password: <input type="password" name="password" size="20" maxlength="20"><br>
   Remember Me: <input type="checkbox" name="rememberme" value="1"><br>
   <input type="submit" name="submit" value="Login!">
  </form>
  </TR>
    <TD height="25"> 
      <div align="center"></div></TD>
    <TD> Or <a href="logup.php">Sign up</a>.</TD>
	</TR>
</TABLE>
</body>
</html>
