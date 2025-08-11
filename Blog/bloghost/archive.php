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
print "<head><title>$getvarz3[title]</title></head>";
print "<table border='0' width=100%>";
print "<tr><td valign='top' width=22%>";
print "<table border='0' width=100%>";
print "<tr><td valign='top' width=22%>";
include "memberleft.php";
print "</td>";
print "<td valign='top' width=56%><center>"; 
//get LAST 15 main blog entries
$month=$_POST['month'];
$year=$_POST['year'];
$getblog="SELECT * from bl_blog a, bl_admin b where b.adminid=a.author and b.adminid='$getvars3[adminid]' and a.month='$month' order by realtime DESC";
$getblog2=mysql_query($getblog) or die("Could not get blog");
while($getblog3=mysql_fetch_array($getblog2))
{
  $getblog3[shortblurb]=smile($getblog3[shortblurb]);
  print "<table class='maintable'><tr class='headline'><td><b>$getblog3[blogtitle]</b> posted by $getblog3[username]<br>";
  print "Posted on $getblog3[thetime]</td></tr>";
  print "<tr class='mainrow'><td>";
  print "$getblog3[shortblurb]<br>";
  if(strlen($getblog3[maincontent])>1) //if there is a long text
  {
    print "<A href='more.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>More ...</a><br>";
  }
  if($getblog3[allowcomments]==1)
  {
    print "<br><A href='comments.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>$getblog3[numcomments] comments</a>--<A href='postcomment.php?membername=$getvars3[username]&ID=$getblog3[entryid]'>Add comment</a>";
  }
  print "</td></tr></table><br>";
}

print "</center></td>";
print "<td valign='top' width=22%>";
include "memberight.php";
print "</td></tr></table>";
include "footer.php";
print "<br><br>";

?>
