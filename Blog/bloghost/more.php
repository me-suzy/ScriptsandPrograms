<?php
session_start();
include "smiley.php";
include "admin/connect.php";
include "header.php";
//SELECT ALL VARIABLES
$membername=$_GET['membername'];
$getvars2=mysql_query("SELECT * from bl_admin where username='$membername'");
$getvars3=mysql_fetch_array($getvars2);
$getvarz="SELECT * from bl_vars where idvars='$getvars3[adminid]'"; //get current variable values
$getvarz2=mysql_query($getvarz) or die("Could not get variables");
$getvarz3=mysql_fetch_array($getvarz2);
print "$getvars3[css]";
//grab profile
print "<table border='0' width=100%>";
print "<tr><td valign='top' width=22%>";
print "<table border='0' width=100%>";
print "<tr><td valign='top' width=22%>";
include "memberleft.php"; 
print "</td>";
print "<td valign='top' width=56%><center>"; 
$ID=$_GET['ID'];
//get LAST 15 main blog entries
$getblog="SELECT * from bl_blog where entryid='$ID'";
$getblog2=mysql_query($getblog) or die("Could not get blog");
while($getblog3=mysql_fetch_array($getblog2))
{
  $getblog3[maincontent]=smile($getblog3[maincontent]);
  print "<table class='maintable'><tr class='headline'><td><b>$getblog3[blogtitle]</b> posted by $getblog3[author]<br>";
  print "Posted on $getblog3[thetime]</td></tr>";
  print "<tr class='mainrow'><td>";
  $getblog3[maincontent]=stripslashes($getblog3[maincontent]);
  $getblog3[maincontent]=nl2br($getblog3[maincontent]);
  print "$getblog3[maincontent]<br>";
  if($getblog3[allowcomments]==1)
  {
    print "<br><A href='comments.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>$getblog3[numcomments] comments</a>--<A href='postcomment.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>Add comment</a>";
  }
  /*
  if(isset($_SESSION['blogadmin']))
  {
     print "<br><br><A href='../admin/editblog.php?ID=$getblog3[entryid]'>Edit entry</a>--<A href='../admin/deleteentry.php?ID=$getblog3[entryid]'>Delete Entry</a>";
  }
  */
  print "</td></tr></table>";
}

print "</center></td>";
print "<td valign='top' width=22%>";
if($getvars3[showresume]==1)
{
   print "<table class='maintable'><tr class='headline'><td><center>Resume</center></td></tr>";
   print "<tr class='mainrow'><td>";
   print "<A href='resume.php'>View Resume</a>";
   print "</td></tr></table><br><br>";
}
print "<table class='maintable'><tr class='headline'><td><center>Categories</center></td></tr>";
print "<tr class='mainrow'><td>";
print "<li><A href='index.php'>Main</a><br>";
print "<li><A href='cat.php?catid=0'>General</a><br>"; //put a general category
$getcats="SELECT * from bl_cats order by catname ASC"; //select all cats in ABC order
$getcats2=mysql_query($getcats) or die("COuld not get cats");
while($getcats3=mysql_fetch_array($getcats2))
{
  $getcats3[catname]=stripslashes($getcats3[catname]);
  print "<li><A href='cat.php?catid=$getcats3[catID]'>$getcats3[catname]</a><br>";
}
print "</td></tr></table><br><br>";
print "<table class='maintable'><tr class='headline'><td><center>Search Archives</center></td></tr>";
print "<tr class='mainrow'><td>";
print "<form action='archive.php' method='post'>";
print "Month/Year:<br><select name='month'>";
print "<option value='1'>January</option>";
print "<option value='2'>February</option>";
print "<option value='3'>March</option>";
print "<Option value='4'>April</option>";
print "<option value='5'>May</option>";
print "<option value='6'>June</option>";
print "<option value='7'>July</option>";
print "<option value='8'>August</option>";
print "<option value='9'>September</option>";
print "<option value='10'>October</option>";
print "<Option value='11'>November</option>";
print "<option value='12'>December</option></select>";
print "<br>";
print "<input type='text' name='year' lenth='10'><br>";
print "<input type='submit' name='submit' value='submit'></form>";
print "</td></tr></table><br><br>";
if($getvars3[usepoll]==1)
{
   include "poll.php";
}
print "<br><br>";
if($getvars3[showcalendar]==1)
{
  include "calendar.php";
}
print "<br><br>";
if($getvars3[useleft]==1)
{
   $queryleft="SELECT * from bl_left";
   $queryleft2=mysql_query($queryleft) or die("Could not query right");
   $queryleft3=mysql_fetch_array($queryleft2);
   print "$queryleft3[left]";
} 
print "</td></tr></table>";
include "footer.php";
print "<br><br>";
print "<font size='1'><center>Powered by © <A href='http://www.chipmunk-scripts.com'>Chipmunk Blogger</a></center></font>";
?>
