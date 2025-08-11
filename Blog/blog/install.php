<?php //install file
include "admin/connect.php";
$createadmintable="CREATE TABLE `bl_admin` (
  `username` varchar(255) NOT NULL default '',
  `password` varchar(255) NOT NULL default '',
  `status` int(11) NOT NULL default '3'
)";
mysql_query($createadmintable) or die(mysql_error());
$createipbans="
CREATE TABLE `bl_banip` (
  `banipid` bigint(20) NOT NULL auto_increment,
  `banip` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`banipid`)
)";
mysql_query($createipbans) or die("Could not create ip bans");
$createblog="CREATE TABLE `bl_blog` (
  `entryid` bigint(20) NOT NULL auto_increment,
  `author` varchar(255) NOT NULL default '',
  `thetime` varchar(255) NOT NULL default '',
  `realtime` bigint(20) NOT NULL default '0',
  `shortblurb` mediumtext NOT NULL,
  `maincontent` mediumtext NOT NULL,
  `numcomments` bigint(20) NOT NULL default '0',
  `month` int(11) NOT NULL default '0',
  `year` bigint(20) NOT NULL default '0',
  `allowcomments` int(11) NOT NULL default '1',
  `blogtitle` varchar(255) NOT NULL default '',
  `catparent` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`entryid`)
)";
mysql_query($createblog) or die("Could not create main blog table");
$createcalendar="CREATE TABLE `bl_calender` (
  `calid` bigint(20) NOT NULL auto_increment,
  `dateclass` bigint(6) NOT NULL default '0',
  `datecotent` mediumtext NOT NULL,
  `viewable` int(11) NOT NULL default '0',
  PRIMARY KEY  (`calid`)
)";
mysql_query($createcalendar) or die("Could not create Calendar");
$createcomments="CREATE TABLE `bl_comments` (
  `commentid` bigint(20) NOT NULL auto_increment,
  `comment` mediumtext NOT NULL,
  `IP` varchar(255) NOT NULL default '',
  `eparent` bigint(20) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`commentid`)
)";

mysql_query($createcomments) or die("Could not create comment table");
$createguestbook="CREATE TABLE `bl_gbook` (
  `ID` bigint(20) NOT NULL auto_increment,
  `name` varchar(35) NOT NULL default '',
  `homepage` varchar(45) NOT NULL default '',
  `mail` varchar(35) NOT NULL default '',
  `country` varchar(30) NOT NULL default '',
  `comment` longtext NOT NULL,
  `realtime` varchar(40) NOT NULL default '',
  `aim` varchar(20) NOT NULL default '',
  `icq` varchar(20) NOT NULL default '',
  `yim` varchar(20) NOT NULL default '',
  `msn` varchar(20) NOT NULL default '',
  `time` bigint(60) NOT NULL default '0',
  `IP` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ID`)
)";
mysql_query($createguestbook) or die("Could not create Guestbook");
$createleftblock="CREATE TABLE `bl_left` (
  `leftid` bigint(20) NOT NULL auto_increment,
  `left` longtext NOT NULL,
  PRIMARY KEY  (`leftid`)
)";
mysql_query($createleftblock) or die("Could not create left block");
$createpoll="CREATE TABLE `bl_pollchoices` (
  `choiceid` bigint(20) NOT NULL auto_increment,
  `answer` varchar(255) NOT NULL default '',
  `votes` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`choiceid`)
)";
mysql_query($createpoll) or die("Could not create poll");
$createpollips="CREATE TABLE `bl_pollip` (
  `ipid` bigint(20) NOT NULL auto_increment,
  `pollip` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ipid`)
)";
mysql_query($createpollips) or die("Could not create Poll IPS");
$createpollquestion="
CREATE TABLE `bl_pollquestion` (
  `pollid` int(11) NOT NULL auto_increment,
  `question` tinytext NOT NULL,
  PRIMARY KEY  (`pollid`)
)";
mysql_query($createpollquestion) or die("Could not create poll questions");
$createprofile="CREATE TABLE `bl_profile` (
  `profileid` bigint(20) NOT NULL auto_increment,
  `birthday` varchar(255) NOT NULL default '',
  `sex` varchar(255) NOT NULL default '',
  `picture` varchar(255) NOT NULL default '',
  `state` varchar(255) NOT NULL default '',
  `country` varchar(255) NOT NULL default '',
  `Interests` mediumtext NOT NULL,
  `occupation` varchar(255) NOT NULL default '',
  `quote` mediumtext NOT NULL,
  `email` varchar(255) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`profileid`)
)";
mysql_query($createprofile) or die("Could not create Profile");
$insertblank="INSERT INTO `bl_profile` VALUES (1, '', '', '', '', '', '', '', '', '', '')";
mysql_query($insertblank) or die("Could not insert blank profile");
$createresume="CREATE TABLE `bl_resume` (
  `resumeid` int(11) NOT NULL auto_increment,
  `yourname` varchar(255) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `phone` varchar(255) NOT NULL default '',
  `zip` varchar(255) NOT NULL default '',
  `mission` tinytext NOT NULL,
  `body` mediumtext NOT NULL,
  PRIMARY KEY  (`resumeid`)
)";
mysql_query($createresume) or die("Could not create resume");
$blankresume="INSERT INTO `bl_resume` VALUES (1, '', '', '', '', '', '', '')";
mysql_query($blankresume) or die("no blank resume");
$rightblock="CREATE TABLE `bl_right` (
  `rightid` bigint(20) NOT NULL auto_increment,
  `right` longtext NOT NULL,
  PRIMARY KEY  (`rightid`)
)";
mysql_query($rightblock) or die("Could not create right block");
$createvars="CREATE TABLE `bl_vars` (
  `varid` bigint(20) NOT NULL auto_increment,
  `showprofile` int(11) NOT NULL default '1',
  `showemail` int(11) NOT NULL default '0',
  `showresume` int(11) NOT NULL default '1',
  `showpic` int(11) NOT NULL default '1',
  `useguestbook` int(11) NOT NULL default '1',
  `showcalendar` int(11) NOT NULL default '1',
  `usepoll` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `useright` int(11) NOT NULL default '0',
  `useleft` int(11) NOT NULL default '0',
  `usephoto` int(11) NOT NULL default '1',
  PRIMARY KEY  (`varid`)
)";
mysql_query($createvars) or die("Could not create variables");
$createphotos="CREATE TABLE `bl_photos` (
  `photoid` bigint(20) NOT NULL auto_increment,
  `mainpath` varchar(255) NOT NULL default '',
  `thumbpath` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`photoid`)
)";
mysql_query($createphotos) or die("Could not get photos");
$createcats="CREATE TABLE bl_cats (
  catID bigint(20) NOT NULL auto_increment,
  catname varchar(255) NOT NULL default '',
  PRIMARY KEY  (catID)
)";
mysql_query($createcats) or die("COuld not isntall cats");

$insertvars="INSERT INTO `bl_vars` VALUES (1, 1, 0, 1, 1, 1, 1, 0, '', 0, 0,1)";
mysql_query($insertvars) or die("Could not insert Variables");
$installrightdata="INSERT INTO `bl_right` VALUES (1, '')";
mysql_query($installrightdata) or die("Could not install right data");
$leftdata="INSERT INTO `bl_left` VALUES (1, '')";
mysql_query($leftdata) or die("No left data");
print "Tables installed, please delete install.php now.";
?>
