<?php
session_start();

?>
<html>
<title>BloGenerator</title>
<body>
<form name="login" method="post"
action="admin.php">
<table width="290" border="0" align="center"
cellpadding="4" cellspacing="1">

	<tr>
		<td colspan="2"><div align="center">Please Log
in
<br>
Use your Blog Administratioin username and password
</div>
		</td>
	</tr>
	<tr>
		<td width="99" bgcolor="#3366ff"> <div
align="right">login</div></td>
		<td width="181" bgcolor="#3366ff"> <div
algin="left">
				<input name="username" type="text"
id="username"></input>
			</div></td>
	</tr>
	<tr>
		<td bgcolor="#0033ff"> <div
align="right">password</div></td>
		<td bgcolor="#0033ff"> <div align="left">
				<input name="password" type="password"
id="password"></input>
			</div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center">
				<input type="submit" name="Submit"
value="Submit"></input>
				&nbsp;
				<input name="reset" type="reset" id="reset" value="reset"></input>
			</div></td>
		</tr>

<tr>
<td colspan=2 align=center>
<?php echo $_SESSION["error"]; ?>
</td>
</tr>
</table>
</form>
</body>
</html>