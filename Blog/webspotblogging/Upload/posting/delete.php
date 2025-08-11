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
if(isset($_REQUEST['id'])){
$path = "../";
$modcheck = 1;
$page = "Delete a post";
include("../inc/adminheader.inc.php");
$query = $database->query("SELECT * FROM blog WHERE pid = '".$_REQUEST['id']."'");
$post = $database->fetch_array($query);
if($_SESSION['admin'] != 1){
if($post['uid'] != $_SESSION['uid']){
echo "You cannot delete this post because it wasn't written by you";
ob_end_flush();
exit();
}
}
?>
Are you sure you wish to delete this post???<BR><BR>
<a href="delete.php?action=delete&pid=<? echo $_REQUEST['id']; ?>"><b>Yes</b></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="home.php">No</a>
<?
include("../inc/footer.inc.php");
ob_end_flush();
} elseif(isset($_REQUEST['pid']) && $_REQUEST['action'] == "delete"){
$path = "../";
$modcheck = 1;
include("../inc/global.php");
include("../inc/checks.php");
$database->query("DELETE FROM blog WHERE pid = '".$_REQUEST['pid']."'");
header("Location: home.php");
ob_end_flush();
}
?>