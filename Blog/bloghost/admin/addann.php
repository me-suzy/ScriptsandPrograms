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
   print "<table class='maintable'><tr class='headline'><td><center>Add announcement</center></td></tr>";
   print "<tr class='mainrow'><td>";
   if(isset($_POST['submit']))
   {
     $ann=$_POST['ann'];
     $announce=$_POST['announce'];
     if(strlen($ann)<1)
     {
        print "There is no announcement title.";
     }
     else if(strlen($announce)<1)
     {
        print "There is no announcement.";
     }
     else
     {
        $thetime=date("U");
        $thedate=date("D M d, Y H:i:s");
        //post commment
        $postann="INSERT into bl_accouncements (anntitle,announcement,thedate,thetime) values('$ann','$announce','$thedate','$thetime')";
        mysql_query($postann) or die(mysql_error());
        print "Comment posted.";
      }  

   }
   else
   {  
      //form for posting announcement
      print "<form action='addann.php' method='post'>";
      print "Accouncement title:<br>";
      print "<input type='text' name='ann' size='20'><br>";
      print "Announcement:<br>";
      print "<textarea name='announce' rows='5' cols='40'></textarea><br>";
      print "<input type='submit' name='submit' value='submit'></form><br>";
   }
   print "</td></tr></table>";
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>