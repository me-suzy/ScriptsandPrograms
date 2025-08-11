<?php
session_start();
include "../admin/connect.php";
print "<link rel='stylesheet' href='../admin/style.css' type='text/css'>";
if(isset($_SESSION['blogadmin']))
{
  print "<center><table class='maintable'>";
  print "<tr class='headline'><td height='7'></td></tr>";
  print "<tr class='mainrow'><td>";
  if(isset($_POST['submit']))
  {
     $ID=$_POST['ID'];
     $delentry="DELETE from bl_gbook where ID='$ID'";
     mysql_query($delentry) or die("Could not delete entry");
     print "Entry Deleted.<META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php'>";
  }
  else if(isset($_GET['ID']))
  {
     $ID=$_GET['ID'];
     print "Are you sure you want to delete this entry?<br>";
     print "<form action='delete.php' method='post'>";
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