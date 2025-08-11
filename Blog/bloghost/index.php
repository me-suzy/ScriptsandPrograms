<?php
session_start();
include "admin/connect.php";
$blogadmin=$_SESSION['blogadmin'];
$getadmin="SELECT * from bl_admin where username='$blogadmin'";
$getadmin2=mysql_query($getadmin) or die("Cannot get admin");
$getadmin3=mysql_fetch_array($getadmin2);
$title="Ferret Fusion Blog Hosting";
include "smiley.php";
include "admin/connect.php";
print "<link rel='stylesheet' href='style.css' type='text/css'>";
print "<title>$title</title>";
print "<table>";
print "<tr><td valign='top' width=20%>";
print "<center><table class='maintable'><tr class='headline'><td><center>Login</center></td></tr>";
print "<tr class='mainrow'><td>";
print "<form action='admin/authenticate.php' method='post'>";
print "Username:<br>";
print "<input type='text' name='username' size='20'><br>";
print "Password:<br>";
print "<input type='password' name='password' size='20'><br>";
print "<input type='submit' name='submit' value='submit'>";
print "</form><br>";
print "<A href='signup.php'><b>Sign Up</b></a>";
print "</td></tr></table><br><br>";
print "<table class='maintable'><tr class='headline'><td><center>Latest 10 Updated Blogs</center></td></tr>";
//now grab the latest updated blogs
$getblogs="SELECT username from bl_blog b, bl_admin a where a.adminid=b.author order by b.realtime desc limit 10";
$getblogs2=mysql_query($getblogs) or die("Could not get blogs");
while($getblogs3=mysql_fetch_array($getblogs2))
{
  print "<tr class='mainrow'><td><A href='members.php?membername=$getblogs3[username]'>$getblogs3[username]</a></td></tr>";
}
print "</table>";
print "</td>";
print "<td valign='top' width=60%><center>";
$getannouncements="SELECT * from bl_accouncements order by thetime desc limit 10"; //selects last ten announcements
$getannouncements2=mysql_query($getannouncements) or die(mysql_error());
while($getannouncements3=mysql_fetch_array($getannouncements2))
{ 
   print "<table class='maintable'><tr class='headline'><td><center>$getannouncements3[anntitle] post at $getannouncements3[thedate]</center></td></tr>";
   print "<tr class='mainrow'><td><p>$getannouncements3[announcement]";
   if($getadmin3[status]==3)
   {
      print "<br><br><A href='admin/editann.php?annid=$getannouncements3[annid]'>Edit Announcement</a>-<A href='admin/deleteann.php?annid=$getannouncements3[annid]'>Delete Announcement</a>";
   }
   print "</td></tr></table><br>";
}

print "</td>";
print "<td valign='top' width=20%>";
include "poll.php";
print "</td></tr></table><br><br>";
print "<center><font size='2'>Powered by © <A href='http://www.chipmunk-scripts.com'>Chipmunk Blogger</a></center>";
?>
