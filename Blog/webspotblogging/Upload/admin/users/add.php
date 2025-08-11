<?php
ob_start();
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
if($_POST['action'] == "add"){
$path = "../../";
$admincheck = 1;
include("../../inc/global.php");
include("../../inc/checks.php");
if($_POST['password'] != $_POST['confpassword']){
echo "<b>The passwords you entered on the last page do not match.</b>";
exit();
}
$sql = "SELECT * FROM users WHERE username = '".$_POST['username']."'";
$query = $database->query($sql);
if($database->num_rows($query) > 0){
echo "<b>A user already exsists with this username</b>";
exit();
}
$sql = "INSERT INTO users (`uid`,`username`,`password`,`admin`,`mod`) VALUES ('','".$_POST['username']."','".md5($_POST['password'])."','".$_POST['admin']."','1')";
$database->query($sql);
header("Location: index.php");
ob_end_flush();
exit();
}
$path = "../../";
$admincheck = 1;
$page = "Add a User";
include("../../inc/adminheader.inc.php");
?>
<form action="add.php" method="post">
<table>
<tr><td>Username</td><td><input type="text" name="username"></td></tr>
<tr><td>Password</td><td><input type="password" name="password"></td></tr>
<tr><td>Confirm Password</td><td><input type="password" name="confpassword"></td></tr>
<tr>
<td>
Admin
</td>
<td>
<input type="checkbox" name="admin" value="1">
</td>
</tr>
<tr>
<td colspan="2">
<input type="hidden" name='action' value="add">
<input type="submit" value="Save!">
</td>
</tr>
</table>
</form>
<?
include("../../inc/footer.inc.php");
ob_end_flush();
?>