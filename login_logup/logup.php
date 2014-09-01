<html>
<head>
<title>Registrazione</title>

</head>
<body>

<div><a href="index.php">Torna alla HomePage</a></div>
<br>
  <form action="check_logup.php" method="post" name="logup">
  <table border="0px" cellspacing="0" cellpadding="5px">
    <tr> 
      <td height="30px">e-mail:</td>
      <td><input name="email" type="text" size="24"></td>
    </tr>
    <tr> 
      <td width="90" height="30px">nome utente:</td>
      <td width="200px"><input name="nome" type="text" size="24" maxlength="24"></td>
    </tr>
    <tr> 
      <td height="30px">sesso:</td>
      <td><input name="sesso" type="radio"  value="M">
        M 
        <input name="sesso" type="radio"  value="F">
        F</td>
	</tr>
	<tr>
	      <td colspan="2"><div align="center"> 
          <input name="action" type="submit" class="selettore" value="SIGNUP">
        </div></td>
	</tr>
	</table>
  </form>

</body>
</html>
