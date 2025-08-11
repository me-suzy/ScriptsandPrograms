<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
if(isset($_REQUEST['gid'])){
$path = "../../";
$admincheck = 1;
$page = "Edit a Post Image";
include("../../inc/adminheader.inc.php");
$query2 = $database->query("SELECT * FROM images WHERE gid = '".$_REQUEST['gid']."'");
$user2 = $database->fetch_array($query2);
?>
<form action="edit.php" method="post">
<table>
<tr><td>Alt Text</td><td><input type="text" name="alt" value="<? echo $user2['alt']; ?>"></td></tr>
<tr><td>Filename</td><td><input type="text" name="filename" value="<? echo $user2['filename']; ?>"></td></tr>
<tr>
<td colspan="2">
<input type="hidden" name='id' value="<? echo $_REQUEST['gid']; ?>">
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
$sql = "UPDATE images SET alt = '".$_POST['alt']."', filename = '".$_POST['filename']."' WHERE gid = '".$_POST['id']."'";
$database->query($sql);
header("Location: index.php");
}
?>