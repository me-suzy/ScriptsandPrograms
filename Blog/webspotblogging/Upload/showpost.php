<?
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
$page = "Showing Individual Post";
include("inc/mainheader.inc.php");
$sql = "SELECT * FROM blog WHERE pid = '".$_REQUEST['id']."';";
$query = mysql_query($sql);

while ($post = mysql_fetch_array($query)){
include("inc/posttemp.php");
}
?>
<?
include("inc/footer.inc.php");
?>