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
   
   if(isset($_POST['submit'])) //case for editing vars
   {
      if(strlen($_POST['title'])<1) //if title is less than 1 letter
      {
         print "You did not have a title.";
      }
      else
      {
          $title=$_POST['title'];
          $profile=$_POST['profile'];
          $email=$_POST['email'];
          $resume=$_POST['resume'];
          $pic=$_POST['pic'];
          $guestbook=$_POST['guestbook'];
          $calendar=$_POST['calendar'];
          $poll=$_POST['poll'];
          $useleft=$_POST['useleft'];
          $useright=$_POST['useright'];
          $usephoto=$_POST['photo'];
          //below is the query for updating the variables
          $editvars="update bl_vars set title='$title',showprofile='$profile',showemail='$email',showresume='$resume',showpic='$pic',useguestbook='$guestbook',showcalendar='$calendar',usepoll='$poll',useleft='$useleft',useright='$useright',usephoto='$usephoto'";
          mysql_query($editvars) or die(mysql_error());
          print "Main Variables Edited";
      }


   }
   else
   {
      $getvars="SELECT * from bl_vars"; //get current variable values
      $getvars2=mysql_query($getvars) or die("Could not get variables");
      $getvars3=mysql_fetch_array($getvars2);
      print "<form action='editvars.php' method='post'>";
      print "Site title:<br>";
      print "<input type='text' name='title' size='30' value='$getvars3[title]'><br>";
      print "Show Profile?<br>";
      print "<select name='profile'>"; //option to show profile or not
      if($getvars3[showprofile]==1)
      {
          print "<option value='1'>Yes</option>";
          print "<option value='0'>No</option>";
      }
      else
      {
          print "<option value='0'>No</option>";
          print "<option value='1'>Yes</option>";
      }
      print "</select><br>";
      print "Show Email?<br>"; //option to show email or not
      print "<select name='email'>";
      if($getvars3[showemail]==1)
      {
          print "<option value='1'>Yes</option>";
          print "<option value='0'>No</option>";
      }
      else
      {
          print "<option value='0'>No</option>";
          print "<option value='1'>Yes</option>";
      }
      print "</select><br>";
      print "Show Resume?<br>";
      print "<select name='resume'>";
      if($getvars3[showresume]==1)
      {
         print "<option value='1'>Yes</option>";
         print "<option value='0'>No</option>";
      }
      else
      {
         print "<option value='0'>No</option>";
         print "<option value='1'>Yes</option>";
      }
      print "</select><br>";
      print "Show Picture?<br>";
      print "<select name='pic'>";
      if($getvars3[showpic]==1)
      {
         print "<option value='1'>Yes</option>";
         print "<option value='0'>No</option>";
      }
      else
      {
         print "<option value='0'>No</option>";
         print "<option value='1'>Yes</option>";
      }
      print "</select><br>";
      print "Use Guestbook?<br>";
      print "<select name='guestbook'>";
      if($getvars3[useguestbook]==1)
      {
         print "<option value='1'>Yes</option>";
         print "<option value='0'>No</option>";
      }
      else
      {
         print "<option value='0'>No</option>";
         print "<option value='1'>Yes</option>";
      }
      print "</select><br>";
      print "Show Calendar?<br>";
      print "<select name='calendar'>";
      if($getvars3[showcalendar]==1)
      {
         print "<option value='1'>Yes</option>";
         print "<option value='0'>No</option>";
      }
      else
      {
         print "<option value='0'>No</option>";
         print "<option value='1'>Yes</option>";
      }
      print "</select><br>";
      print "Use Poll?<br>";
      print "<select name='poll'>";
      if($getvars3[usepoll]==1)
      {
         print "<option value='1'>Yes</option>";
         print "<option value='0'>No</option>";
      }
      else
      {
         print "<option value='0'>No</option>";
         print "<option value='1'>Yes</option>";
      }
      print "</select><br>";
      print "Use Photo Gallery?<br>";
      print "<select name='photo'>";
      if($getvars3[usephoto]==1)
      {
         print "<option value='1'>Yes</option>";
         print "<option value='0'>No</option>";
      }
      else
      {
         print "<option value='0'>No</option>";
         print "<option value='1'>Yes</option>";
      }
      print "</select><br>";
      print "Use Right Custom Module?<br>";
      print "<select name='useright'>";
      if($getvars3[useright]==1)
      {
         print "<option value='1'>Yes</option>";
         print "<option value='0'>No</option>";
      }
      else
      {
         print "<option value='0'>No</option>";
         print "<option value='1'>Yes</option>";
      }
      print "</select><br>";
      print "Use left Custom Module?<br>";
      print "<select name='useleft'>";
      if($getvars3[useleft]==1)
      {
         print "<option value='1'>Yes</option>";
         print "<option value='0'>No</option>";
      }
      else
      {
         print "<option value='0'>No</option>";
         print "<option value='1'>Yes</option>";
      }
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