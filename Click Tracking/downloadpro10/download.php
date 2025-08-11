<?php
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

if (isset($file)){

	dbConnect();
	$sql = "select filename from dlcount";
	$result = mysql_query($sql);
	$rows = mysql_num_rows($result);
	
	for ($x=0;$x<$rows;$x++) {
	$urlarray[$x] = mysql_result($result,$x);
	}
	
	$request = $urlarray[$file];
	
	if (!$request) {
		echo ("Error on url string");
	}
	else {
		header("Location: $request"); 
	}
	
	$query = "UPDATE dlcount SET totalhits=totalhits+1 WHERE FileCode = $file";
	$result = mysql_query($query);
	if (!$result){ 
		echo("Database Error");
	}
	$datetime = date('d M Y h:i:s a');
	$querystat = "INSERT INTO dlstats SET FileCode='$file', IP='$REMOTE_ADDR', DateTime='$datetime'";
	$resultstat = mysql_query($querystat);
	if (!$result){ 
		echo("Database Error");	
	}
	
}

if (isset($showme)){
	dbConnect();
	$query = "SELECT totalhits FROM dlcount WHERE FileCode = $showme";
	$result = mysql_query($query);
	$hitcount = mysql_result($result,0);
	echo($hitcount);
}
?>