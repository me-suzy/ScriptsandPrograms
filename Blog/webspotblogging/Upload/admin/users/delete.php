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
if(isset($_REQUEST['uid'])){
$path = "../../";
$admincheck = 1;
$page = "Delete a User";
include("../../inc/adminheader.inc.php");
if($_REQUEST['uid'] == $_SESSION['uid']){
echo "<b><font color=\"red\">You cannot delete your own user account. To delete this user account you must log in with another admin account.</font></b>";
} else {
?>
Are you sure you wish to delete this user???<BR><BR>
When you delete the use you are also deleting all the posts made in the blog by them
<a href="delete.php?action=delete&id=<? echo $_REQUEST['uid']; ?>"><b>Yes</b></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="index.php">No</a>
<?
}
include("../../inc/footer.inc.php");
} elseif(isset($_REQUEST['id']) && $_REQUEST['action'] == "delete"){
$path = "../../";
$admincheck = 1;
include("../../inc/global.php");
include("../../inc/checks.php");
$database->query("DELETE FROM users WHERE uid = '".$_REQUEST['id']."'");
$database->query("DELETE FROM blog WHERE uid = '".$_REQUEST['id']."'");
header("Location: index.php");
}
ob_end_flush();
?>