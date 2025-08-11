<?php
session_start();
?>
<link rel="stylesheet" href="style.css" type="text/css">

<?PHP
include "connect.php";
$blogadmin=$_SESSION['blogadmin'];
$getadmin="SELECT * from bl_admin where username='$blogadmin'";
$getadmin2=mysql_query($getadmin) or die("Cannot get admin");
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
 
   if(isset($_POST['submit']))
   {
      $ID=$_GET['ID'];
      $view=$_POST['view'];
      $reminders=$_POST['reminders'];
      $reminders=addslashes($reminders);
      $val=$_POST['val'];
      if($val==1)
      {
         $editcal="update bl_calender set datecotent='$reminders', viewable='$view' where dateclass='$ID'";
         mysql_query($editcal) or die("Could not edit calendar");
         print "Calendar updated";
      }
      else
      {
         $createevent="Insert into bl_calender (datecotent,viewable,dateclass) values ('$reminders','$view','$ID')";
         mysql_query($createevent) or die(mysql_error());
         print "Entry updated.";
      }
      

   }
   else
   {
      $ID=$_GET['ID']; 
      $getcontents="SELECT * from bl_calender where dateclass='$ID'";
      $getcontents2=   mysql_query($getcontents) or die("Could not get contents");
      $getcontents3=mysql_fetch_array($getcontents2);   
      if(strlen($getcontents3[dateclass])>0)
      {
         $value=1;
      }
      else
      {
         $value=0;
      }
      $getcontents3[datecotent]=stripslashes($getcontents3[datecotent]);
    
      print "<form action='editcalendar.php?ID=$ID' method='post'>";
      print "Type in reminders here:<br><br>";
      print "<textarea name='reminders' rows='10' cols='35'>$getcontents3[datecotent]</textarea><br><br>";
      print "Do you want this day's events to be publically viewable?<br>";
      print "<select name='view'>";
      print "<option value='1'>Yes</option>";
      print "<option value='2'>No</option>";
      print "</select><br><br>";
      print "<input type='hidden' name='val' value='$value'>";
      print "<input type='submit' name='submit' value='submit'></form>";


   }

}
else
{
  print "Not logged in.";

 

}
?>