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
if(isset($_REQUEST['tid'])){
$path = "../../";
$admincheck = 1;
$page = "Themes";
include("../../inc/adminheader.inc.php");
$query = $database->query("SELECT * FROM theme");
?>
Are you sure you wish to delete this theme???<BR><BR>
<?
if($database->num_rows($query) < 2){
echo "<b><font color=\"red\">You are trying to delete the final theme on your blog. This is not recommended as your blog will not look right unless you install another theme. If you have lost your default theme and wish to get it back please visit <a href=\"http://blogging.webspot.co.uk/themes/default/\" target=\"_blank\">http://blogging.webspot.co.uk/themes/default/</a></font></b><BR><BR>";
}
?>
After you delete the theme your blog may not appear correctly. To avoid this, after you delete the theme please use the radio boxes to select the theme you want to use.<BR><BR>
<a href="delete.php?action=delete&id=<? echo $_REQUEST['tid']; ?>"><b>Yes</b></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="index.php">No</a>
<?
include("../../inc/footer.inc.php");
ob_end_flush();
} elseif(isset($_REQUEST['id']) && $_REQUEST['action'] == "delete"){
$path = "../../";
$admincheck = 1;
include("../../inc/global.php");
include("../../inc/checks.php");
$database->query("DELETE FROM theme WHERE tid = '".$_REQUEST['id']."'");
header("Location: index.php");
ob_end_flush();
}
?>