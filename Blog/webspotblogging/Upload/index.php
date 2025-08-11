<?
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
$page = "Latest Updates";
include("inc/mainheader.inc.php");
$query = $database->query("SELECT * FROM `blog` ORDER BY `date_time` DESC LIMIT ".$settings['display_posts']);
while ($post = $database->fetch_array($query)){
include("inc/posttemp.php");
}
include("inc/footer.inc.php");
?>