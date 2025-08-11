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
      $checkpoll="SELECT * from bl_pollquestion limit 1";
      $checkpoll2=mysql_query($checkpoll) or die("Could not check poll");
      $checkpoll3=mysql_fetch_array($checkpoll2);
      if(strlen($checkpoll3[question])>1)
      {
         print "There is already a poll. Please delete it before creating a new poll.";
      }
      else //create poll
      {
         if(strlen($_POST['question'])<1)
         {
           print "You did not enter a question.";
         }
         else
         {
           $question=$_POST['question'];
           $makequestion="INSERT into bl_pollquestion (question) values('$question')";
           mysql_query($makequestion) or die(mysql_error());
           print "Poll Made.";
         }
       }


   }
   else
   {
      print "<form action='addpoll.php' method='post'>";
      print "Poll Question:<br>";
      print "<input type='text' name='question' size='40'><br>";
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