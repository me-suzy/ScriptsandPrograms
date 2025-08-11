<?php
session_start();
?>
<link rel="stylesheet" href="style.css" type="text/css">
<center><table border='0' width=100%><tr><td valign='top' width=30%>
<?PHP
//delete a poll choice
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
     $answerid=$_GET['ID'];
     $delpollchoice="DELETE from bl_pollchoices where choiceid='$answerid'";
     mysql_query($delpollchoice) or die("Could not delete choice");
     print "Poll Choice Deleted.";

   }
   else
   {
     $answerid=$_GET['ID'];
     print "Are you sure you want to delete this poll choice?<br>";
     print "<form action='delpollchoice.php?ID=$answerid' method='post'>";
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