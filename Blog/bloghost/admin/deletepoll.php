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
      $delpoll="TRUNCATE bl_pollquestion";
      mysql_query($delpoll) or die(mysql_error());
      $delchoices="TRUNCATE bl_pollchoices";
      mysql_query($delchoices) or die(mysql_error());
      $delips="TRUNCATE bl_pollip";
      mysql_query($delips) or die("Cannot delete pollips");
      print "Poll Deleted.";

   }
   else
   {
      print "Are you sure you want to delete all poll and data?<br>";
      print "<form action='deletepoll.php' method='post'>";
      print "<input type='submit' name='submit' value='delete'></form>";  

   }  
   print "</td></tr></table>";
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>