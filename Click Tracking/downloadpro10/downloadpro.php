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
	dbConnect();
	$sql = "select filename from dlcount";
	$result = mysql_query($sql);
	$rows = mysql_num_rows($result);
	
	$sql1 = "select filecode from dlcount";
	$result1 = mysql_query($sql1);
	
	$sql2 = "select totalhits from dlcount";
	$result2 = mysql_query($sql2);
	
	for ($x=0;$x<$rows;$x++) {
	$array[$x] = mysql_result($result,$x);
	$array1[$x] = mysql_result($result1,$x);
	$array2[$x] = mysql_result($result2,$x);
	}
	//array is filenames
	//array1 is fileids
	//array2 is totalhits

include("restrict.php");
echo('
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>DownloadPro Admin Area ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<img src="header.gif">
<table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
<tr bgcolor="#FFFFFF">
<td width="145"><B>Filename</B></td>
<td width="100"><B>File ID</B></td>
<td width="100"><B>Hits</B></td>
<td width="70"><B>Edit</B></td>
</tr>');
for ($x=0;$x<$rows;$x++) {
	echo('<tr bgcolor="#FFFFFF">
    	    <td width="145">'.$array[$x].'</td>
   	        <td width="100">'.$array1[$x].'</td>
			<td width="100">'.$array2[$x].'</td>
   	        <td width="70"><a href="modify.php?delete='.$array1[$x].'">Delete</A> <a href="modify.php?modify='.$array1[$x].'">Modify</A></td>			
 	      </tr>');
}
echo('</table><BR>
- <a href="modify.php?insert=1">Create New</A>
<BR>
- <a href="displaystat.php">Show Full Download Stats</A>
<BR><BR>
<a class="dlp" href="Http://www.explodingpanda.com" TARGET="_BLANK">DownloadPro 1.x</A>
</body>
</html>
');

?>