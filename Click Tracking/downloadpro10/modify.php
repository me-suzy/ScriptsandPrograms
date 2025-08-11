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

	if (isset($insert)){
	
		if (!isset($Submit)){
		
			dbConnect();
		
//			$sql = "select * from dlcountTEST";
//			$result = mysql_query($sql);
//			$rows = mysql_num_rows($result);
			
			$sqla = "select FileCode from dlcount";
			$resulta = mysql_query($sqla);
			
			$rows = mysql_num_rows($resulta);
				
			for ($x=0;$x<$rows;$x++) {
			$codesarray[$x] = mysql_result($resulta,$x);
			}

//this block allocates the lowest available id, after all filecodes
//are entered into the array above, it searches until an unset code
//is found, ends the while loop, and assigns $newcode the discovered value. 
			if($rows > 0){
				$x = 0;
				while ( ( in_array($x, $codesarray) ) !== FALSE )
				{
				$x++;
				}
				$newcode = $x;
			}
			else { $newcode = 0; }
// end allocation
include("restrict.php");			
			echo('
			<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
			"http://www.w3.org/TR/html4/loose.dtd">
			<html>
			<head>
			<title>DownloadPro - Create New File ::</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">	
			<link href="style.css" rel="stylesheet" type="text/css">
			</head>
			<body>
			
			<form name="form1" method="post" action="modify.php">
			Address Filename: <input name="address" type="text" id="address"><BR>
			Total Hits(0): <input name="inithits" type="text" value="0" id="inithits"><BR>
			Resource ID: <input name="id" type="text" disabled value="'.$newcode.'" id="id"><BR>
			<input name="insert" type="hidden" value="1">
			<input name="rows" type="hidden" value="'.$newcode.'">
			<input type="Submit" name="Submit" value="Submit" id="Submit">
			</form>
			<a href="downloadpro.php">Back</A>
			</body>
			</html>
			');
	
		}
		
		if (isset($Submit)){
		
			dbConnect();
			$sql = "INSERT INTO dlcount SET              
			FileName = '$HTTP_POST_VARS[address]',              
			FileCode = '$HTTP_POST_VARS[rows]',              
			totalhits = '$HTTP_POST_VARS[inithits]'";
			$result = mysql_query($sql);
			if(!$result){ echo('MySQL INSERT Error'); break;}
			header("Location: downloadpro.php"); 
		}
	}

if (isset($delete)){
	dbConnect();
	$sql = "DELETE FROM `dlcount` WHERE FileCode = $delete";
	$result = mysql_query($sql);
	if(!$result){ echo ("Error on dele string"); break; };
	header("Location: downloadpro.php"); 
}

if (isset($modify)){

	if (!isset($Submit)){
	
	dbConnect();
	$sql = "SELECT FileName from dlcount WHERE FileCode = '$modify'";
	$result = mysql_query($sql);
	if(!$result){echo('ID Not Found'); break;}
	$filename = mysql_result($result,0);
	$sql = "SELECT totalhits from dlcount WHERE FileCode = '$modify'";
	$result = mysql_query($sql);
	$totalhits = mysql_result($result,0);
include("restrict.php");			
		echo('
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<title>DownloadPro - Modify a File ::</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="style.css" rel="stylesheet" type="text/css">	
		</head>
		<body>
		
		<form name="form1" method="post" action="modify.php">
		Filename: <input name="filename1" type="text" value="'.$filename.'" id="filename"><BR>
		Total Hits: <input name="totalhits1" type="text" value="'.$totalhits.'" id="hits"><BR>
		<input name="modify" type="hidden" value="'.$modify.'">
		<input type="Submit" name="Submit" value="Submit" id="Submit">
		</form>
		<a href="downloadpro.php">Back</A>
		</body>
		</html>
		');
	}
	
	if (isset($Submit)){
	dbConnect();
	$sql = "UPDATE dlcount SET filename = '$HTTP_POST_VARS[filename1]' WHERE filecode = '$modify'";
	$sql2 = "UPDATE dlcount SET totalhits = '$HTTP_POST_VARS[totalhits1]' WHERE filecode = '$modify'";
	$result = mysql_query($sql);
	$result2 = mysql_query($sql2);
	if(!$result){ echo('MySQL UPDATE Error'); break;}
	header("Location: downloadpro.php"); 
	}
}
	
?>