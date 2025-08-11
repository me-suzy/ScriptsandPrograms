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
     if(strlen($_POST['categoryname'])<1)
     {
       print "You did not enter a category.";
     }
     else
     {
        $ID=$_POST['thecat'];
        $categoryname=$_POST['categoryname'];
        $editcat="update bl_cats set catname='$categoryname' where catID='$ID'";
        mysql_query($editcat) or die("Could not edit category");
        print "Category edited.";
     }

   } 
   else
   {   
     $ID=$_GET['ID'];
     print "<form action='editthecat.php' method='post'>";
     print "<input type='hidden' name='thecat' value='$ID'>";
     print "Category name:<br>";
     $getcats="SELECT * from bl_cats where catID='$ID'";
     $getcats2=mysql_query($getcats) or die("COuld not get cats");
     $getcats3=mysql_fetch_array($getcats2);
     print "<input type='text' name='categoryname' size='20' value='$getcats3[catname]'><br>";
     print "<input type='submit' name='submit' value='submit'></form>";

   }
   print "</td></tr></table>";
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>