<html>
<head>
<title>DC-shout installer+Upgrader</title>
<link rel="stylesheet" type="text/css" href="http://codez.darkdevils.co.uk/css.css">
</head>
<body>
<?php
include "admin/config.php";
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//installer (C)Devil Coderz 2004-2005 v1.1
//Dc-shout 2.0 upgrader+installer
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

if ($action=="")
{
?>
<center><b>Dc-Shout</b></center>
<br>
<br>
<a href="install.php?action=new">New install</a><br>
<a href="install.php?action=upgrade">Upgrade</a>
<?
}

//New install

if ($action =="new")
{
print "<center><b>Installing</b></center>";
print"<br><br>";

mysql_query("CREATE TABLE `dc_admin` (
  `id` bigint(20) NOT NULL auto_increment,
  `user` varchar(130) NOT NULL default '',
  `password` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ") or die("error adding table");



mysql_query("INSERT INTO `dc_admin` VALUES (1, 'admin', '098f6bcd4621d373cade4e832627b4f6')");
print "Added table1<br>";

mysql_query("CREATE TABLE `dc_setings` (
  `id` int(11) NOT NULL auto_increment,
  `shout` varchar(10) default 'y',
  `bbcode` varchar(10) default 'y',
  `word` varchar(10) default 'y',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='Dc_sshout setings' AUTO_INCREMENT=2 ") or die("error adding table");

mysql_query("INSERT INTO `dc_setings` VALUES (1, 'y', 'y', 'y')");
print "Added table2<br>";

mysql_query("CREATE TABLE `dc_shoutbox` (
  `id` int(11) NOT NULL auto_increment,
  `name` longtext NOT NULL,
  `text` longtext NOT NULL,
  `ip` longtext NOT NULL,
  PRIMARY KEY  (`id`,`id`)
) TYPE=MyISAM COMMENT='Devil coderz shoutbox' ") or die ("error adding table");
print"Added table3<br>";

mysql_query("CREATE TABLE `dc_word` (
  `id` int(120) NOT NULL auto_increment,
  `word` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM") or die ("error adding table");
print "Added table 4<br><br>";

print "All database stuff added now delete this file";
}


//upgrade dc-shout to 2.0
if ($action == "upgrade")
{
print "<center><b>Upgrading</b></center>";
print"<br><br>";

mysql_query("DROP TABLE IF EXISTS `dc_admin`;
CREATE TABLE `dc_admin` (
  `id` bigint(20) NOT NULL auto_increment,
  `user` varchar(130) NOT NULL default '',
  `password` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2") ;

mysql_query("INSERT INTO `dc_admin` VALUES (1, 'admin', '098f6bcd4621d373cade4e832627b4f6')");
print "upgrade part1 done <br>";

mysql_query("DROP TABLE IF EXISTS `dc_setings`;
CREATE TABLE `dc_setings` (
  `id` int(11) NOT NULL auto_increment,
  `shout` varchar(10) default 'y',
  `bbcode` varchar(10) default 'y',
  `word` varchar(10) default 'y',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='Dc_sshout setings' AUTO_INCREMENT=2 ") ;

mysql_query("
INSERT INTO `dc_setings` VALUES (1, 'y', 'y', 'y')");
print "upgrade part2 done <br>";

mysql_query("DROP TABLE IF EXISTS `dc_word`;
CREATE TABLE `dc_word` (
  `id` int(120) NOT NULL auto_increment,
  `word` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM ") ;
print "upgrade part3 done <br><br>";
print "updating done:) now delete this file";
}
?>

</body>
</html>










