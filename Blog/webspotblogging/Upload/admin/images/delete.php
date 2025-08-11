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
if(isset($_REQUEST['gid'])){
$path = "../../";
$admincheck = 1;
$page = "Delete a Post Image";
include("../../inc/adminheader.inc.php");
?>
Are you sure you wish to delete this Post Image???<BR><BR>
<a href="delete.php?action=delete&id=<? echo $_REQUEST['gid']; ?>"><b>Yes</b></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="index.php">No</a>
<?
include("../../inc/footer.inc.php");
} elseif(isset($_REQUEST['id']) && $_REQUEST['action'] == "delete"){
$path = "../../";
$admincheck = 1;
include("../../inc/global.php");
include("../../inc/checks.php");
$database->query("DELETE FROM images WHERE gid = '".$_REQUEST['id']."'");
header("Location: index.php");
}
ob_end_flush();
?>