<?
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
$page = "Archives";
include("inc/mainheader.inc.php");


$sql = "SELECT * FROM blog GROUP BY month_date ORDER BY date_time DESC;";
$query = $database->query($sql);
while ($archive = $database->fetch_array($query)){
echo "<a href=\"showarchive.php?monthdate=".$archive[month_date]."\">Month of ".$archive[month_date]."</a><BR>";
}
?>
<BR>
<?
include("inc/footer.inc.php");
?>