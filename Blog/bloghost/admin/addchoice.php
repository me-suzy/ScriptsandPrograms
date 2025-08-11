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
      if(strlen($checkpoll3[question])<1)
      {
         print "There is no poll, please create a poll before you create choices.";
      }
      else //create poll choice
      {
         if(strlen($_POST['pollchoice'])<1)
         {
           print "You did not enter a choice.";
         }
         else
         {
           $pollchoice=$_POST['pollchoice'];
           $makeanswer="INSERT into bl_pollchoices (answer) values('$pollchoice')";
           mysql_query($makeanswer) or die(mysql_error());
           print "Poll Choice Created.";
         }
       }


   }
   else
   {
      print "<form action='addchoice.php' method='post'>";
      print "Poll Choice<br>";
      print "<input type='text' name='pollchoice' size='40'><br>";
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