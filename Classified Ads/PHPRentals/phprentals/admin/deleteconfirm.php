<?php
include("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php"); 
include("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");

$llid = addslashes($_POST['llid']);

$sql = mysql_query("SELECT * FROM users WHERE llid='$llid' ");
if ($row = mysql_fetch_array($sql)) {

$notfound = $row["email"];

echo "Below is the Landlord that you are about to delete. Be sure this is what you want to do.<BR>";
echo "Username:";
echo $row["email"];
echo "<BR>";
echo "<form action=\"dusr.php\" method=\"POST\"><input type=\"hidden\" name=\"llid\" value=\"".$row["llid"]."\">";
echo "<input type=\"submit\" value=\"Delete\"></form>";
	}
	if (!$notfound){
echo "<B>User not found.</B><P>The Landlord you submitted does not match anything in the database.";
 } 

?>