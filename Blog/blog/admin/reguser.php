<?php
include "connect.php";
print "<link rel='stylesheet' href='style.css' type='text/css'>";
print "<center><table class='maintable'><tr class='headline'><td><center>Registering Admin</center></td></tr>";
print "<tr class='mainrow'><td>";
if(isset($_POST['submit'])) //if submit was pressed
{
  if(strlen($_POST['username'])<1) //if there was no username
  {
     print "You did not enter a username.";
  }
  else if(strlen($_POST['password'])<1) //no password
  {
     print "You did not enter a password.";
  }
  else if($_POST['password']!=$_POST['pass2']) //password and confirmation did not match
  {
     print "Your passwords did not match, please try again.";
  }
  else //all fields met
  {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password=md5($password);
    $insertadmin="INSERT into bl_admin (username,password) values ('$username','$password')"; //registering admin in databae
    $insertadmin2=mysql_query($insertadmin) or die("Could not insert admin");
    print "Admin Successfully registered, you should delete register.php and reguser.php in the admin folder.";
  }
}
print "</td></tr></table>";
?>