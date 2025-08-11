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
include "config.php";
if ($clickid) { 
$result = mysql_query("Select * from ClickTable where click_id='$clickid'",$con);
$n = 0;
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
$n++;
if ($clickid == $row['click_id']) { 
$count = $row['click_count'] + 1;
mysql_query("UPDATE ClickTable set click_count='$count' WHERE click_id=" . $row['click_id'] ."");
header ("Location:". $row['click_url']."");

}
 }} 

?>


