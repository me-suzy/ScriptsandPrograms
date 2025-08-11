<?php
session_start();
?>
<link rel="stylesheet" href="style.css" type="text/css">
<center><table border='0' width=100%><tr><td valign='top' width=30%>
<?PHP
include "connect.php";
$blogadmin=$_SESSION['blogadmin'];
$getadmin="SELECT * from bl_admin where username='$blogadmin'";
$getadmin2=mysql_query($getadmin) or die("Cannot get admin");
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "left.php";
   print "</td>";
   print "<td valign='top' width=70%>";
   print "<table class='maintable'><tr class='headline'><td><center>Add Photo</center></td></tr>";
   print "<tr class='mainrow'><td>";  
   print "<form name='form1' method='post' action='../photos/upload.php' enctype='multipart/form-data'>";
   print "Select File:";
   print "<input type='file' name='thefile'>";
   print "<input type='submit' name='submit' value='upload'>";
   print "</form>";
   print "</td></tr></table>";
 
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>