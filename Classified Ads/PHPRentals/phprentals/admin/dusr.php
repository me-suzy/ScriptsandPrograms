<?php
include("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php");
include("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");

$llid = addslashes($_POST['llid']);

$sql = mysql_query("SELECT * FROM users WHERE llid='$llid' ");
if ($row = mysql_fetch_array($sql)) {

$notfound = $row["email"];
	
mysql_query("DELETE FROM users WHERE llid = '$llid'");
mysql_query("DELETE FROM landlords WHERE lid = '$llid'");
echo "User Successfully Deleted";
	}
	if (!$notfound){
echo "<B>Landlord not deleted.</B><P>The Landlord you submitted does not match anything in the database.";
 } 
?>