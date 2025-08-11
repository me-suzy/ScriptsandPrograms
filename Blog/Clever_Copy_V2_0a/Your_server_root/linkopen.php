<?php
include "admin/connect.inc";
$ID =$_GET['ID'];
$getppc="SELECT * FROM CC_prefs";
$getppc2=mysql_query($getppc) or die($no_preferences_error);
$getppc3=mysql_fetch_array($getppc2);
$cpc=$getppc3[cpc_default_rate];
$query="UPDATE CC_ppc SET total_clickthrus = total_clickthrus + 1, clickthrus = clickthrus + 1, thisperiod_cost = thisperiod_cost +  $cpc, runningtotal = runningtotal + $cpc WHERE ID = '$ID'";
$res = @mysql_query($query);
$query="SELECT weblink FROM CC_ppc WHERE ID = '$ID'";
$res = @mysql_query($query);
$row = mysql_fetch_row($res);
header("Location: " . $row[0]);

?>