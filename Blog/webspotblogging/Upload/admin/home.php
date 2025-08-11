<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
$path = "../";
$admincheck = 1;
$page = "Admin CP Home";
include("../inc/adminheader.inc.php");
?>
<b>Stats</b><BR>
<table width="90%" class="tblborder" align="center">
<?
//Start info table
$phpversion = phpversion();
$dbversion = mysql_get_server_info();
$blogversion = $settings['version'];
$query = $database->query("SELECT * FROM blog");
$postcount = $database->num_rows($query);
$query = $database->query("SELECT * FROM theme");
$themecount = $database->num_rows($query);
$query = $database->query("SELECT * FROM users");
$usercount = $database->num_rows($query);
$query = $database->query("SELECT * FROM users WHERE admin = '1'");
$adminusercount = $database->num_rows($query);
$normalusercount = $usercount - $adminusercount;
	echo "<tr align=\"right\" width=\"100%\">\n";
	echo "<td valign=\"top\" class=\"dark\"><b>PHP Version</b></td><td valign=\"top\" class=\"light\">".$phpversion."</td>\n";
	echo "<td valign=\"top\" class=\"dark\"><b>MySQL Version</b></td><td valign=\"top\" class=\"light\">".$dbversion."</td>\n";
	echo "</tr>\n";
	echo "<tr align=\"right\" width=\"100%\">\n";
	echo "<td valign=\"top\" class=\"dark\"><b>WebspotBlogging Version</b></td><td valign=\"top\" class=\"light\">".$blogversion."</td>\n";
	echo "<td valign=\"top\" class=\"dark\"><b>Number of Posts</b></td><td valign=\"top\" class=\"light\">".$postcount."</td>\n";
	echo "</tr>\n";
	echo "<tr align=\"right\" width=\"100%\">\n";
	echo "<td valign=\"top\" class=\"dark\"><b>Number of Themes</b></td><td valign=\"top\" class=\"light\">".$themecount."</td>\n";
	echo "<td valign=\"top\" class=\"dark\"><b>Number of Users</b></td><td valign=\"top\" class=\"light\">".$usercount."</td>\n";
	echo "</tr>\n";
	echo "<tr align=\"right\" width=\"100%\">\n";
	echo "<td valign=\"top\" class=\"dark\"><b>Number of Admins</b></td><td valign=\"top\" class=\"light\">".$adminusercount."</td>\n";
	echo "<td valign=\"top\" class=\"dark\"><b>Number of Normal Users</b></td><td valign=\"top\" class=\"light\">".$normalusercount."</td>\n";
	echo "</tr>\n";
//Finish info table
?>
</table>
<BR>
<?
include("../inc/footer.inc.php");
?>