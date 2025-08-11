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
   print "<table class='maintable'><tr class='headline'><td><center>Edit Category</center></td></tr>";
   print "<tr class='mainrow'><td>";
   if(isset($_POST['submit']))
   {
     $ID=$_POST['thecat'];
     $delblogs="DELETE from bl_blog where catparent='$ID'";
     mysql_query($delblogs) or die(mysql_error());
     $delcat="DELETE from bl_cats where catID='$ID'";
     mysql_query($delcat) or die("Could not delete category");
     print "Category Deleted.";     
   } 
   else
   {   
     $ID=$_GET['ID'];
     print "<form action='deletecat.php' method='post'>";
     print "<input type='hidden' name='thecat' value='$ID'>";
     print "Are you sure you want to delete this category(deleting category will delete all posts under category).<br>";
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