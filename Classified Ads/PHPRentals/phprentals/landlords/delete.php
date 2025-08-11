<?php include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php");
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");

$rid = addslashes($_POST['rid']);

$sql = mysql_query("SELECT * FROM listings WHERE rid='$rid' ");
if ($row = mysql_fetch_array($sql)) {

$notfound = $row["rid"];
	
mysql_query("DELETE FROM listings WHERE rid = '$rid'");
echo "Listing Successfully Deleted <a href=\"index.php\">Landlord Index</a>";
	}
	if (!$notfound){
echo "<B>Listing not deleted.</B><P>The listing you submitted does not exist or there has been a database error.";
 } 
?>