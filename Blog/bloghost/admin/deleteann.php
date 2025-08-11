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
   print "<table class='maintable'><tr class='headline'><td><center>Edit Announcement</center></td></tr>";
   print "<tr class='mainrow'><td>";
   if(isset($_POST['submit']))
   {
     $annid=$_POST['annid'];
     $deleteann="DELETE from bl_accouncements where annid='$annid'";
     mysql_query($deleteann) or die(mysql_error());
     print "Announcement deleted.";

   }
   else //form for editing announcement
   {  
      $annid=$_GET['annid'];
      print "Are you sure you want to delete this announcement?<br>";
      print "<form action='deleteann.php' method='post'>";
      print "<input type='hidden' name='annid' value='$annid'>";
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