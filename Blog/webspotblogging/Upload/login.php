<?
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
ob_start();
$page = "Login";
include("inc/mainheader.inc.php");
if(isset($_POST['username'])){
$query = $database->query("SELECT * FROM users WHERE username = '".$_POST['username']."' AND `password` = '".md5($_POST['password'])."' LIMIT 1");
$user_check = $database->num_rows($query);
if($user_check != 1){
echo "<b>Invalid Username Or Password:</b><BR><BR>
<div align=\"center\">
<form action=\"login.php\" method=\"POST\">
<table>
<tr><td>
<input type=\"text\" name=\"username\">
</td>
<td><input type=\"password\" name=\"password\"></td>
</tr>
<tr><td>Username</td><td>Password</td></tr>
</table>
<input type=\"submit\" value=\"Login\">
</form>
</div>";
include("inc/footer.inc.php");
ob_end_flush();
exit();
}
$user = mysql_fetch_array($query);
session_register('uid'); 
        $_SESSION['uid'] = $user['uid'];
session_register('username'); 
        $_SESSION['username'] = $user['username'];
session_register('admin'); 
        $_SESSION['admin'] = $user['admin'];
session_register('mod'); 
        $_SESSION['mod'] = $user['mod'];
		if($_POST['adminpanel'] == 1){
		header("Location: admin/index.php");
		} elseif($_POST['postpanel'] == 1){
		header("Location: posting/index.php");
		} else {
header("Location: index.php");
}
ob_end_flush();
include("inc/footer.inc.php");
exit();
}
?>
<div align="center">
<form action="login.php" method="post">
<table>
<tr>
<td>Username</td>
<td>Password</td>
</tr>
<tr>
<td>
<input type="text" name="username">
</td>
<td>
<input type="password" name="password">
</td>
</tr>
<tr>
<td colspan="2">
<div align="center">
<input type="submit" value="Login!">
</div>
</td>
</tr>
</table>
</form>
</div>
<?
include("inc/footer.inc.php");
ob_end_flush();
?>