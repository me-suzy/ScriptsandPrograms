<?php  
include ("../db.php");

switch (@$_GET['do'])
{
	case 'mysqltables':
	mysqltables();
	break;
	
	case 'mysqlinserts':
	mysqlinserts();
	break;
	
	default:
	home();
	break;
}

function mysqltables()
{
	
	$tbl[] = "DROP TABLE IF EXISTS `articles`";
		
	
$tbl[] = "CREATE TABLE `articles` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `article` text NOT NULL,
  `views` int(5) NOT NULL default '0',
  `catid` int(5) NOT NULL default '0',
  `author` varchar(50) NOT NULL default '',
  `numcomments` int(5) NOT NULL default '0',
  `rating` varchar(50) NOT NULL default '',
  `numvotes` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$tbl[] = "DROP TABLE IF EXISTS `cats`";

$tbl[] = "
CREATE TABLE `cats` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `numarticles` int(5) NOT NULL default '0',
  `description` varchar(200) NOT NULL default '',
  `numcomments` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$tbl[] = "DROP TABLE IF EXISTS `comments`";

$tbl[] = "CREATE TABLE `comments` (
  `id` int(5) NOT NULL auto_increment,
  `author` varchar(50) NOT NULL default '',
  `comment` text NOT NULL,
  `dateposted` varchar(50) NOT NULL default '',
  `articleid` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$tbl[] = "DROP TABLE IF EXISTS `glossary`";

$tbl[] = "CREATE TABLE `glossary` (
  `id` int(5) NOT NULL auto_increment,
  `word` varchar(100) NOT NULL default '',
  `definition` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$tbl[] = "DROP TABLE IF EXISTS `links`";

$tbl[] = "CREATE TABLE `links` (
  `id` int(5) NOT NULL auto_increment,
  `url` varchar(100) NOT NULL default '',
  `name` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$tbl[] = "DROP TABLE IF EXISTS `settings`";

$tbl[] = "CREATE TABLE `settings` (
  `id` int(5) NOT NULL auto_increment,
  `realname` varchar(50) NOT NULL default '',
  `displayname` varchar(50) NOT NULL default '',
  `value` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$tbl[] = "DROP TABLE IF EXISTS `templates`";

$tbl[] = "
CREATE TABLE `templates` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `value` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";


$i = "0";
foreach ($tbl as $key => $val) 
{
	
	if (@mysql_query($val))
	{
		echo "Success! Query Run! <img src='images/ok.gif' alt='Done' /><br />";
		
	}
	else 
	{
		$i++;
		echo "<strong>Error:</strong>&nbsp;".mysql_error()." <img src='images/cancel.gif' alt='Error' /><br />";
		
	}
	
}
if ($i == "0")
{
	echo '<p>All queries run successfully, moving to next step...</p><meta http-equiv="Refresh" content="3;url=index.php?do=mysqlinserts">';
}
}

function mysqlinserts()
{
	
	$insert[] = "INSERT INTO `settings`
	values (1,'sysname','Title','Article System Title'),
	(2,'sysdesc','Description','Article System Description'),
	(3,'syskeywords','Keywords','keyword1,keyword2'),
	(4,'owneremail','Your Email','you@yourmail.com');";
	
	$insert[] = "INSERT INTO `templates` 
	values (1,'intro_text','<p>Some default intro text...</p>'),
	(2,'comment_rules','<p>Lots and lots of rules about commenting</p>'),
	(3,'usage_rules','<p>Yet more wonderful rules!</p>');";


	$i = "0";
	foreach ($insert as $key => $val) 
{
	
	if (@mysql_query($val))
	{
		echo "Success! Insert Query Run! <img src='images/ok.gif' alt='Done' /><br />";
		
	}
	else 
	{
		$i++;
		echo "<strong>Error:</strong>&nbsp;".mysql_error()." <img src='images/cancel.gif' alt='Error' /><br />";
		
	}
	
}
if ($i == "0")
{
	echo '<p>Success! The system has been installed (<a href="../">visit</a>). Please delete the install folder</p>';
}
	
	
}

function home()
{
echo <<<home
<div style="margin: 20px auto 20px auto;padding: 5px;font-family:verdana;font-size:13px;border: 2px dotted #9ACD32">
<div style="text-align:center;font-weight: bold">Article System Installer</div>
<br />
<a href='index.php?do=mysqltables'><b>Step 1: Install MySQL Tables</b></a>
</div>
home;
}