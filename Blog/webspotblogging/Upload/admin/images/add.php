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
$sql = "SELECT * FROM images WHERE filename = '".$_POST['filename']."'";
$query = $database->query($sql);
if($database->num_rows($query) > 0){
echo "<b>A Post Image already exsists with this filename</b>";
exit();
}
$sql = "INSERT INTO images (`gid`,`alt`,`filename`) VALUES ('','".$_POST['alt']."','".$_POST['filename']."')";
$database->query($sql);
header("Location: index.php");
ob_end_flush();
exit();
}
$path = "../../";
$admincheck = 1;
$page = "Add a Post Image";
include("../../inc/adminheader.inc.php");
?>
<form action="add.php" method="post">
<table>
<tr><td>Alt Text</td><td><input type="text" name="alt"></td></tr>
<tr><td>Filename</td><td><input type="text" name="filename"></td></tr>
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