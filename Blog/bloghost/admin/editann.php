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
     $title=$_POST['title'];
     $announcement=$_POST['announcement'];           
     if(strlen($title)<1)
     {
        print "You did not have a title.";
     }
     else if(strlen($announcement)<1)
     {
       print "You did not have an announcement.";
     }
     else //all required fields met
     {
         $insertannouncement="Update bl_accouncements set anntitle='$title', announcement='$announcement' where annid='$annid'";
         mysql_query($insertannouncement) or die(mysql_error());
         print "Announcement edited.";
     }

   }
   else //form for editing announcement
   {  
      $annid=$_GET['annid'];
      $getannouncement="Select * from bl_accouncements where annid='$annid'";
      $getannouncement2=mysql_query($getannouncement) or die("Could not get announcement");
      $getannouncement3=mysql_fetch_array($getannouncement2);
      print "<form action='editann.php' method='post'>";
      print "<input type='hidden' name='annid' value='$annid'>";
      print "Title:<br>";
      print "<input type='text' size='20' name='title' value='$getannouncement3[anntitle]'><br>";
      print "Announcement:<br>";
      print "<textarea name='announcement' rows='5' cols='40'>$getannouncement3[announcement]</textarea><br>";
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