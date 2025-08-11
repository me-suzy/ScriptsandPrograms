<?php
session_start();
?>
<link rel="stylesheet" href="style.css" type="text/css">
<center><table border='0' width=100%><tr><td valign='top' width=30%>
<?PHP
//delete a poll choice
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
   $getchoices="SELECT * from bl_pollchoices";
   $getchoices2=mysql_query($getchoices) or die("Could not get choices");
   print "<table class='maintable'><tr class='headline'><td colspan='2'>Delete Poll Choice</td></tr>";
   while($getchoices3=mysql_fetch_array($getchoices2))
   {
      print "<tr class='mainrow'><td>$getchoices3[answer]</td><td><A href='delpollchoice.php?ID=$getchoices3[choiceid]'>Delete</a></td></tr>";
   }
   print "</table>";  


   print "</td></tr></table>";
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>