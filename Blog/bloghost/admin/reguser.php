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
    $opencss=fopen("style.css","r"); //open style.css for reading
    $grabcss=fread($opencss,filesize("style.css"));
    fclose($opencss);
    $insertadmin="INSERT into bl_admin (username,password,status,validated,css) values ('$username','$password',3,1,'<style>$grabcss</style>')"; //registering admin in databae
    $insertadmin2=mysql_query($insertadmin) or die("Could not insert admin");
    $getuserid=mysql_query("select adminid from bl_admin where username='$username'") or die("Could not get user id");
    $getuserid2=mysql_fetch_array($getuserid);
    $createvars="INSERT INTO bl_vars (showprofile,showemail,showresume,showpic,useguestbook,showcalendar,title, useright,useleft,usephoto,idvars) VALUES (1, 1, 0, 1, 1, 1, '$username site', 1, 1, 1, '$getuserid2[adminid]')";
    mysql_query($createvars) or die("Could not create variables");
    print "Admin Successfully registered, you should delete register.php and reguser.php in the admin folder.";
  }
}
print "</td></tr></table>";
?>