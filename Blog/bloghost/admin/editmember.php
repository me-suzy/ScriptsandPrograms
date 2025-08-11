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
   if(isset($_POST['submit']))
   {
      $theid=$_POST['theid'];
      $thename=$_POST['thename'];
      $thepassword=$_POST['thepassword'];
      $status=$_POST['status'];
      if(strlen($thename)<4)
      {
         print "Usernames must be at least 4 letter/numbers in length.";
      }
      else if(strlen($thepassword)<5)
      {
         print "Passwords must be at least 5 letter/numbers inm length.";
      }
      else //all requirements met
      {
         $thepassword=md5($thepassword);
         $updateuser="Update bl_admin set username='$thename', password='$thepassword', status='$status' where adminid='$theid'";
         mysql_query($updateuser) or die("Could not update user");
         print "User updated.";
      }


   }
   else
   {   
      $ID=$_GET['ID'];
      $getmemberinfo="SELECT * from bl_admin where adminid='$ID'";
      $getmemberinfo2=mysql_query($getmemberinfo) or die("Could not get member info");
      $getmemberinfo3=mysql_fetch_array($getmemberinfo2);
      print "<form action='editmember.php' method='post'>";
      print "<input type='hidden' name='theid' value='$getmemberinfo3[adminid]'>";
      print "Name:<br>";
      print "<input type='text' name='thename' value='$getmemberinfo3[username]' size='20'><br>";
      print "<input type='password' name='thepassword' value='$getmemberinfo3[password]' size='20'><br>";
      print "Status:<br>";
      print "<select name='status'>";
      print "<option value='$getmemberinfo3[status]'>No change</option>";
      print "<option value='1'>Member</option>";
      print "<option value='2'>Moderator</option>";
      print "<option value='3'>Administrator</option>";
      print "</select><br>";
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