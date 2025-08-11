<?php // db.php
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
 
//start edits here

$dbhost = "localhost"; //db host, usually just localhost
$dbuser = "dbuser"; //db username
$dbpass = "dbpass"; //db password
$increment = "50"; //the amount of data rows shown on each stats page
$scriptuser = "admin"; // the admin login allowed to access the control panel.
$scriptpass = "pass"; // the admin password allowed to access the control panel.

function dbConnect(
$db="explodingpanda_com_-_downloadpro"//your database name goes here
) { 

//end edits, do not edit below this line
    global $dbhost, $dbuser, $dbpass;
	
	$dbcnx = @mysql_connect($dbhost, $dbuser, $dbpass)
		or die("The site database appears to be down.");
    
	if ($db!="" and !@mysql_select_db($db))        
		die("The site database is unavailable.");
		
	return $dbcnx;
}
?>