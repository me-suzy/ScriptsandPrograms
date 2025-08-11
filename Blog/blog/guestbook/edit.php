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
     $entry=$_POST['entry'];
     $updatentry="Update bl_gbook set comment='$entry' where ID='$ID'";
     mysql_query($updatentry) or die("Could not update entry");
     print "Entry edited. You will now be redirected <META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php'>";   

  }
  else if(isset($_GET['ID']))
  {
     $ID=$_GET['ID'];
     $getentry="SELECT * from bl_gbook where ID='$ID'";
     $getentry2=mysql_query($getentry) or die("Could not get entry");
     $getentry3=mysql_fetch_array($getentry2);
     print "<form action='edit.php' method='post'>";
     print "<input type='hidden' name='ID' value='$getentry3[ID]'>";
     print "<textarea name='entry' rows='6' cols='40'>$getentry3[comment]</textarea><br>";
     print "<input type='submit' name='submit' value='submit'></form>";

  }

  print "</td></tr></table></center>";
}
else
{
  print "Not logged in";
}

?>