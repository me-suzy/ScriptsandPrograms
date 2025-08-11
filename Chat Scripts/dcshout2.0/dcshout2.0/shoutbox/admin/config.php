<?php
//Dc-shout2.0 (c)devilcoderz 2004
//data base settings
$dbuser = "here" ; //your data base username
$dbpass = "here";//your data base password
$dbname = "here"; //data base name
$host = "localhost" ; //your host name 
$theme = "basic";//Your shout box theme
//dont edit below this line

// lets start off with the concation
mysql_connect($host, $dbuser, $dbpass) or die ("did not connect to db") ;
mysql_select_db($dbname) ;
//That was the easy part
?>

