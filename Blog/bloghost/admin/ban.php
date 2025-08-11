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
      if(strlen($_POST['ip'])<1)
      {
         print "You did not enter an ip.";
      }
      else
      {
        $ip=$_POST['ip'];
        $insertip="INSERT into bl_banip (banip) values ('$ip')";
        mysql_query($insertip) or die("Could not insert ip");
        print "IP Banned.";
      }

   }
   else
   {  
      print "Banning an IP will ban the person from commenting and signing guestbook.<br>";
      print "<form action='ban.php' method='post'>";
      print "IP to ban:<br>";
      print "<input type='text' name='ip' size='40'><br>";
      print "<input type='submit' name='submit' value='ban'></form>";

   }
   print "</td></tr></table>";
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>