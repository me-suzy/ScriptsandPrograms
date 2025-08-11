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
   if(isset($_POST['submit'])) //submit button has been pushed
   {
      $name=$_POST['name'];
      print "<table class='maintable'><tr class='headline'><td>name</td><td>Edit</td><td>Delete</td></tr>";
      $getusers="SELECT adminid,username from bl_admin where username like '%$name%'";
      $getusers2=mysql_query($getusers) or die("Could not get users");
      while($getusers3=mysql_fetch_array($getusers2))
      {
         print "<tr class='mainrow'><td><A href='../members.php?ID=$getusers3[username]'>$getusers3[username]</a></td><td><A href='editmember.php?ID=$getusers3[adminid]'>Edit</a></td><td><A href='deletemember.php?ID=$getusers3[adminid]'>Delete</a></td></tr>";
      }
      print "</table><br><br>";
         
   
   }
   else //form to search for user
   {
      print "<form action='edituser.php' method='post'>";
      print "Search for name of user:<br>";
      print "<input type='text' name='name' size='20'><br>";
      print "<input type='submit' name='submit' value='submit'>";
      print "</form>";
 
   }
   print "</td></tr></table>";
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>