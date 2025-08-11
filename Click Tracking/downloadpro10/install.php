<?php //install.php
/***************************************************************************
 *                                DownloadPro 1.x
 *                            -------------------
 *   created:                : Monday, 16th Feb 2004
 *   copyright               : (C) 2004 Blue-Networks / Exploding Panda
 *   email                   : neil@explodingpanda.com
 *   web                     : http://www.explodingpanda.com/
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
 
include('db.php');

if (!isset($Install)){

	echo('
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
	<title>Installation ::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	
	<body>
	<div align="center">
	  <p>DownloadPro Installation</p>
	  <p align="left">Please ensure you have edited db.php in the correct places, and entered your db username, db password, and database name. If you want a different amount than 50 rows per stats page display, please also edit the $increment setting.</p>
	
	  <form name="form1" method="post" action="install.php">
	    <div align="center"><span>Ready?<br> 
	      </span>        <input type="submit" name="Install" value="Install" id="Install">
	    </div>
	  </form>
	  <p align="left">&nbsp; </p>
	</div>
	</body>
	</html>
	');
	
}

if (isset($Install)){
	echo('Connecting to database and preloading SQL<BR>');

	dbConnect();
	$sql1 = "CREATE TABLE `dlcount` (
  `FileName` varchar(100) NOT NULL default '',
  `FileCode` int(6) NOT NULL default '0',
  `totalhits` int(6) NOT NULL default '0'
) TYPE=MyISAM COMMENT='Total Download Hits';";

	$sql2 = "CREATE TABLE `dlstats` (
  `FileCode` int(6) NOT NULL default '0',
  `IP` varchar(20) NOT NULL default '0.0.0.0',
  `DateTime` varchar(50) NOT NULL default '0',
  `StatNo` int(6) NOT NULL auto_increment,
  UNIQUE KEY `Stat No` (`StatNo`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;";

echo('Creating and Filling table - dlcount: ');
$result1 = mysql_query($sql1);
if(!isset($result1)){echo('Failed<BR><BR>');}
if(isset($result1)){echo('Success<BR><BR>');}

echo('Creating and Filling table - dlstats: ');
$result2 = mysql_query($sql2);
if(!isset($result2)){echo('Failed<BR><BR>');}
if(isset($result2)){echo('Success<BR><BR>');}

echo('Execution of installation script complete. If installation was successful, it is vital that you now delete install.php!');
}
?>