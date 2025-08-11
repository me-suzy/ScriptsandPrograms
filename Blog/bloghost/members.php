<?php 
session_start();
?>
<head>

</head>
<?php
include "header.php";
include "admin/connect.php";
include "smiley.php";
$membername=$_GET['membername'];
$getvars2=mysql_query("SELECT * from bl_admin where username='$membername'");
$getvars3=mysql_fetch_array($getvars2);
$getvarz="SELECT * from bl_vars where idvars='$getvars3[adminid]'"; //get current variable values
$getvarz2=mysql_query($getvarz) or die(mysql_error());
$getvarz3=mysql_fetch_array($getvarz2);
print "$getvars3[css]";
print "<head><title>$getvarz3[title]</title></head>";
print "<table border='0' width=100%>";
print "<tr><td valign='top' width=22%>";
include "memberleft.php";
print "</td>";
print "<td valign='top' width=56%><center>"; 
include "center.php";
print "</center></td>";
print "<td valign='top' width=22%>";
include "memberight.php";
print "</td></tr></table><br><br>";
?>
<center><font size='2'>Powered by © <A href='http://www.chipmunk-scripts.com'>Chipmunk Blogger</a></font></center>