<?php
session_start();
include "../admin/connect.php";
$blogadmin=$_SESSION['blogadmin'];
$getadmin=mysql_query("SELECT * from bl_admin where username='$blogadmin'");
$getadmin2=mysql_fetch_array($getadmin);
$ID=$_GET['ID'];
$getentry="SELECT identifier from bl_gbook where ID='$ID'";
$getentry2=mysql_query($getentry) or die("Could not get entry");
$getentry3=mysql_fetch_array($getentry2);
$membername=$_GET['membername'];
$getvars2=mysql_query("SELECT * from bl_admin where username='$membername'");
$getvars3=mysql_fetch_array($getvars2);
print "$getvars3[css]";
if($getentry3[identifier]==$getadmin2[adminid])
{
  print "<center><table class='maintable'>";
  print "<tr class='headline'><td height='7'></td></tr>";
  print "<tr class='mainrow'><td>";
  if(isset($_POST['submit']))
  {
     $ID=$_POST['ID'];
     $delentry="DELETE from bl_gbook where ID='$ID'";
     mysql_query($delentry) or die("Could not delete entry");
     print "Entry Deleted.<META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php?membername=$membername'>";
  }
  else if(isset($_GET['ID']))
  {
     $ID=$_GET['ID'];
     print "Are you sure you want to delete this entry?<br>";
     print "<form action='delete.php?ID=$ID&membername=$membername' method='post'>";
     print "<input type='hidden' name='ID' value='$ID'>";
     print "<input type='submit' name='submit' value='submit'></form>";

  }
  print "</td></tr></table></center>";
}
else
{
  print "Not logged in";
}

?>