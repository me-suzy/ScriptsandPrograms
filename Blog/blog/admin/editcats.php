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
   print "<table class='maintable'><tr class='headline'><td><center>Edit/Delete Category</center></td></tr>";
   print "<tr class='mainrow'><td>";
   $getallcats="SELECT * from bl_cats order by catname ASC";
   $getallcats2=mysql_query($getallcats) or die("Could not get cats");
   print "<center><table class='maintable'><tr class='headline'><td>Category name</td><td>Edit</td><td>Delete</td></tr>";
   while($getallcats3=mysql_fetch_array($getallcats2))
   {
      print "<tr class='mainrow'><td>$getallcats3[catname]</td><td><A href='editthecat.php?ID=$getallcats3[catID]'>Edit</a></td><td><A href='deletecat.php?ID=$getallcats3[catID]'>Delete</a></td></tr>";
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