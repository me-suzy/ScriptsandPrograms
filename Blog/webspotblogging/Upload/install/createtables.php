<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://www.webspot.co.uk/scripts/blogging/
* Licence : http://www.webspot.co.uk/scripts/blogging/eula.php
*
**/
$path = "../";
session_start();

require $path."inc/config.inc.php";
require $path."inc/mysql.php";

$database = new database;

$database->connect($config['hostname'], $config['username'], $config['password']);
$database->select($config['database']);
include("../inc/installheader.inc.php");
?>
Now we'll need to make the tables.<BR><BR>
<?

$tableimagessql = "CREATE TABLE `images` (`gid` int(11) NOT NULL auto_increment,`filename` varchar(30) NOT NULL default '',`alt` varchar(30) NOT NULL default '',PRIMARY KEY  (`gid`)) TYPE=MyISAM PACK_KEYS=0 AUTO_INCREMENT=3 ;";
$sql3 = "INSERT INTO `images` VALUES (1, 'webspot.jpg', 'Webspot.co.uk');";
$sql4 = "INSERT INTO `images` VALUES (2, 'stickists.gif', 'Stickists.co.uk');";
$tableimagesquery = $database->query($tableimagessql);
echo "Creating table 'images'... ";
if (!$tableimagesquery){
echo "<b>Failed</b>";
} else{
echo "Done";
$database->query($sql3);
$database->query($sql4);
}
echo "<BR>";
$tableblogsql = "CREATE TABLE `blog` (`pid` tinyint(5) NOT NULL auto_increment,`uid` tinyint(3) NOT NULL default '0',`title` varchar(225) NOT NULL default '',`content` text NOT NULL,`image` int(11) NOT NULL default '0',`float` varchar(30) NOT NULL default '',`date_time` varchar(30) NOT NULL default '0000-00-00 00:00:00',`month_date` varchar(30) NOT NULL default '',`edit_uid` int(11) NOT NULL default '0',`edit_date` datetime NOT NULL default '0000-00-00 00:00:00',PRIMARY KEY  (`pid`)) TYPE=MyISAM;";
$tableblogquery = $database->query($tableblogsql);
echo "Creating table 'blog'... ";
if (!$tableblogquery){
echo "<b>Failed</b>";
} else{
echo "Done";
}
echo "<BR>";
$tablethemesql = "CREATE TABLE `theme` (`tid` int(11) NOT NULL auto_increment,`name` varchar(30) NOT NULL default '',`subhead_text-color` varchar(20) NOT NULL default '',`subhead_background-image` varchar(100) NOT NULL default '',`subhead_font-family` varchar(225) NOT NULL default '',`subhead_font-size` varchar(10) NOT NULL default '',`header_text-color` varchar(20) NOT NULL default '',`header_background-image` varchar(100) NOT NULL default '',`header_font-family` varchar(225) NOT NULL default '',`header_font-size` varchar(10) NOT NULL default '',`postcontent_text-color` varchar(20) NOT NULL default '',`postcontent_background-color` varchar(20) NOT NULL default '',`postcontent_font-family` varchar(225) NOT NULL default '',
  `postcontent_font-size` varchar(10) NOT NULL default '',`content_text-color` varchar(20) NOT NULL default '',`content_background-color` varchar(20) NOT NULL default '',`content_font-family` varchar(225) NOT NULL default '',`content_font-size` varchar(10) NOT NULL default '',`topbar_text-color` varchar(20) NOT NULL default '',`topbar_background-color` varchar(20) NOT NULL default '',`topbar_font-family` varchar(225) NOT NULL default '',`topbar_font-size` varchar(10) NOT NULL default '',`topbar_link-color` varchar(20) NOT NULL default '',`topbar_linkhover-color` varchar(20) NOT NULL default '',`body_background-color` varchar(20) NOT NULL default '',`logo` varchar(100) NOT NULL default '',`content_width` varchar(10) NOT NULL default '',`using_now` tinyint(1) NOT NULL default '0',PRIMARY KEY  (`tid`)) TYPE=MyISAM;";
$tablethemequery = $database->query($tablethemesql);
echo "Creating table 'theme'... ";
if (!$tablethemequery){
echo "<b>Failed</b>";
} else{
echo "Done";
}
echo "<BR>";
$tableuserssql = "CREATE TABLE `users` (`uid` tinyint(3) NOT NULL auto_increment,`username` varchar(30) NOT NULL default '',`password` varchar(255) NOT NULL default '',`admin` tinyint(1) NOT NULL default '0',`mod` tinyint(1) NOT NULL default '0',PRIMARY KEY  (`uid`)) TYPE=MyISAM;";
$tableusersquery = $database->query($tableuserssql);
echo "Creating table 'users'... ";
if (!$tableusersquery){
echo "<b>Failed</b>";
} else{
echo "Done";
}
echo "<BR>";
?>
<form action="inserttheme.php" method="link">
<input type="submit" value="Next Step" style="float:right;">
</form>
<?
include("../inc/footer.inc.php");
?>