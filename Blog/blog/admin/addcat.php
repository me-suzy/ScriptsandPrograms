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
   print "<table class='maintable'><tr class='headline'><td><center>Add Category</center></td></tr>";
   print "<tr class='mainrow'><td>";
   if(isset($_POST['submit']))
   {
     if(strlen($_POST['thecat'])<1)
     {
       print "You did not enter a category name.";
     }
     else
     {
        $thecat=$_POST['thecat'];
        $thecat=addslashes($thecat);
        $newcat="INSERT into bl_cats(catname) values('$thecat')";
        mysql_query($newcat) or die("Could not create category");
        print "Category Added.";
     }

   }
   else
   {  
     print "<form action='addcat.php' method='post'>";
     print "Category name:<br>";
     print "<input type='text' name='thecat' size='20'><br>";
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