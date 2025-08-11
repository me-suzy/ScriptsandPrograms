<?php //parse and display stats
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

//if the php is called without parameters on the url, assign
//the variables default starting values.
if(!isset($start)){
	$start = "0";
}
$finish = $start + $increment;

//take all stat data from the db.

dbConnect();
	$sql = "select FileCode from dlstats";
	$result = mysql_query($sql);
	$rows = mysql_num_rows($result);
	
	$sql1 = "select IP from dlstats";
	$result1 = mysql_query($sql1);
	
	$sql2 = "select DateTime from dlstats";
	$result2 = mysql_query($sql2);
	
	$sql3 = "select StatNo from dlstats";
	$result3 = mysql_query($sql3);
	
//assign to array cells.	

	for ($x=0;$x<$rows;$x++) {
		$array[$x] = mysql_result($result,$x);
		$array1[$x] = mysql_result($result1,$x);
		$array2[$x] = mysql_result($result2,$x);
		$array3[$x] = mysql_result($result3,$x);
	}
	
//echo table headings
include("restrict.php");	
	echo('
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>DownloadPro - Stat Displayer ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
<tr bgcolor="#FFFFFF">
<td width="145"><B>File Code</B></td>
<td width="100"><B>Visitor IP</B></td>
<td width="100"><B>Date / Time</B></td>
<td width="70"><B>Stat Number</B></td>
</tr>');

//echo the data up to the finish / increment limit.

for ($x=$start;$x<$finish && $x<$rows;$x++) {
	echo('<tr bgcolor="#FFFFFF">
    	    <td width="145">'.$array[$x].'</td>
   	        <td width="100">'.$array1[$x].'</td>
			<td width="100">'.$array2[$x].'</td>
   	        <td width="70">'.$array3[$x].'</td>			
 	      </tr>'
		  );

}

echo('</table><BR>');

//evaluate the new values for pages in next / previous linkings.

$fstart = $start + $increment;
$ffinish = $finish + $increment;
$bstart = $start - $increment;
$bfinish = $finish - $increment;

//this part decides whether a next x link is relevant (obviously not if you are at the end of the data), and whether a
//previous x link is required (obviously not if you are at the beginning of the record).

if($finish < $rows){ echo('<a href="displaystat.php?start='.$fstart.'">Show next '.$increment.'</A><BR>
');}

if($start > 0) {echo('<a href="displaystat.php?start='.$bstart.'">Show previous '.$increment.'</A><BR>
');}

//this section divides the number of rows, ie stat records, by the increment amount, thus discovering how many pages
//this data will take up in the current format. It then prints the correct link with parameters to make the script show
//these records.

echo('<table border="0" width="450" cellpadding="2" cellspacing="0" bgcolor="#ffffff">
<tr bgcolor="#FFFFFF">
Page: ');
$pages = $rows / $increment;
for ($x=0;$x<=$pages;$x++) {
$v1 = $increment * $x;
$v2 = $v1 + $increment;
echo('<a href="displaystat.php?start='.$v1.'">'.$x.'</A> | ');
}
echo('<BR><BR><a href="downloadpro.php">Back</A><BR><BR><a class="dlp" href="Http://www.explodingpanda.com" TARGET="_BLANK">DownloadPro 1.x</A>
</tr></table></body></html>');
?>