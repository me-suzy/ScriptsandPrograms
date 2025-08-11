<?php include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php");

$rid = $_POST['rid'];
echo "Are you sure you want to delete this listing?";
echo "<form action=\"delete.php\" method=POST><input type=hidden name=rid value=\"$rid\"><input type=submit value=Delete></form>";
 
?>