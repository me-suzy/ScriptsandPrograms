<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
if(isset($_REQUEST['uid'])){
$path = "../../";
$admincheck = 1;
$page = "Edit a User";
include("../../inc/adminheader.inc.php");
$query2 = $database->query("SELECT * FROM users WHERE uid = '".$_REQUEST['uid']."'");
$user2 = $database->fetch_array($query2);
?>
<form action="edit.php" method="post">
<table>
<tr><td>Username</td><td><input type="text" name="username" value="<? echo $user2['username']; ?>"></td></tr>
<tr><td>New Password</td><td><input type="text" name="newpass"></td></tr>
<tr>
<td>
Admin
</td>
<td>
<?
if($user2['admin'] == 1){
?>
<input type="checkbox" name="admin" value="1" checked>
<?
} else {
?>
<input type="checkbox" name="admin" value="1">
<?
}
?>
</td>
</tr>
<tr>
<td colspan="2">
<input type="hidden" name='id' value="<? echo $_REQUEST['uid']; ?>">
<input type="hidden" name='action' value="edit">
<input type="submit" value="Save!">
</td>
</tr>
</table>
</form>
<?
include("../../inc/footer.inc.php");
} elseif(isset($_POST['id']) && $_POST['action'] == "edit"){
$path = "../../";
$admincheck = 1;
include("../../inc/global.php");
include("../../inc/checks.php");
if($_POST['newpass'] == ""){
$sql = "UPDATE users SET username = '".$_POST['username']."', admin = '".$_POST['admin']."' WHERE uid = '".$_POST['id']."'";
} else {
$sql = "UPDATE users SET password = '".md5($_POST['newpass'])."', username = '".$_POST['username']."', admin = '".$_POST['admin']."' WHERE uid = '".$_POST['id']."'";
}
$database->query($sql);
header("Location: index.php");
}
?>