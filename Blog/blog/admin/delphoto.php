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
   print "<table class='maintable'><tr class='headline'><td><center>Delete Photo</center></td></tr>";
   print "<tr class='mainrow'><td>";
   $ID=$_GET['ID'];
   if(isset($_POST['submit']))
   {
     $getphoto="SELECT * from bl_photos where photoid='$ID'";
     $getphoto2=mysql_query($getphoto) or die("Could not get photo");
     $getphoto3=mysql_fetch_array($getphoto2);
     //delete photos
     unlink("../photos/$getphoto3[mainpath]");
     unlink("../photos/thumbs/$getphoto3[thumbpath]");
     $delrecord="Delete from bl_photos where photoid='$ID'";
     mysql_query($delrecord) or die("Could not delete photo");
     print "Photo deleted.";

   }
   else
   {
      print "Are you sure you want to delete this Photo?";
      print "<form action='delphoto.php?ID=$ID' method='post'>";
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