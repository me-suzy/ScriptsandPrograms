<?
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
$page = "Archives of ".$_REQUEST['monthdate'];
include("inc/mainheader.inc.php");
$monthdate = $_REQUEST['monthdate'];
$sql = "SELECT * FROM blog WHERE month_date = '".$_REQUEST['monthdate']."';";
$query = mysql_query($sql);

while ($post = mysql_fetch_array($query)){
include("inc/posttemp.php");
}
?>
<?
include("inc/footer.inc.php");
?>