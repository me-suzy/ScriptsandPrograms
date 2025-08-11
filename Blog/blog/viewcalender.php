<?php
include "admin/connect.php";
$ID=$_GET['ID'];
$getcontents="SELECT * from bl_calender where dateclass='$ID'";
$getcontents2=   mysql_query($getcontents) or die("Could not get contents");
$getcontents3=mysql_fetch_array($getcontents2);  
if(strlen($getcontents3[dateclass])<1)
{
  print "There are no reminders here today.";
}
else if($getcontents3[viewable]==2)
{
  print "Sorry, the Administrator has decided today's reminders are not viewable by public.";
}
else
{
  $getcontents3[datecotent]=stripslashes($getcontents3[datecotent]);
  $getcontents3[datecotent]=nl2br($getcontents3[datecotent]);
  print "$getcontents3[datecotent].";
}
?>