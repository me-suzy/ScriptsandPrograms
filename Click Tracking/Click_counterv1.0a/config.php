<?php
// *************************************************************************************************
// Title: 			PHP AGTC-Click Counter v1.0a
// Developed by: 	Andy Greenhalgh
// Email:			andy@agtc.co.uk
// Website:			agtc.co.uk
// Copyright:		2005(C)Andy Greenhalgh - (AGTC)
// Licence:			GPL, You may distribute this software under the terms of this General Public License
// *************************************************************************************************
// 
// PLEASE AMEND THE CODE BELOW WITH YOUR DETAILS FOR YOUR SERVERS DATABASE
$localhost = "localhost"; // YOUR LOCAL HOST, USUALLY localhost
$dbuser = "yourdbname"; // YOUR DATABASE USERNAME
$dbpass = "yourdbpass"; // YOUR DATABASE PASSWORD
$dbtable = "clickcounterDB";// THE NAME OF YOUR DATABASE , THIS SHOULD HAVE BEEN SET WHEN YOU INSTALLED click_db.sql, SO YOU CAN LEAVE THIS

// PLEASE AMEND THE CODE BELOW WITH YOUR URL & FOLDER DETAILS
$site_url = "http://www.agtc.co.uk"; // CHANGE THIS TO YOUR OWN WEBSITE URL Ie.(http://www.mysite.com)
$site_folder = "/work/clickcounter/"; // WHERE YOUR AGTC CLICK COUNTER FOLDER IS (/myfolder/clickcounter/)

// YOU DO NOT NEED TO EDIT BELOW THIS LINE
$con = mysql_connect("$localhost","$dbuser","$dbpass")

        or die("Error Could not connect");

$db = mysql_select_db("$dbtable", $con)
		or die("Error Could not select database");
?>