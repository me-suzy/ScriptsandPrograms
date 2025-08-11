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
   print "<table class='maintable'><tr class='headline'><td><center>Main Admin</center></td></tr>";
   print "<tr class='mainrow'><td>";
   $ID=$_GET['ID'];
   if(isset($_POST['submit']))
   {
      $delcomments="DELETE from bl_comments where eparent='$ID'";
      mysql_query($delcomments) or die("Could not delete comments");
      $delentry="DELETE from bl_blog where entryid='$ID'";
      mysql_query($delentry) or die("Could not delete entry");
      print "Entry Deleted.";

   }
   else
   {
      print "Are you sure you want to delete this entry?";
      print "<form action='deleteentry.php?ID=$ID' method='post'>";
      print "<input type='submit' name='submit' value='Delete'></form>";

   }
   print "</td></tr></table>";
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>