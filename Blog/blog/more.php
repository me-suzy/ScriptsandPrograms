<?php
session_start();
include "smiley.php";
include "admin/connect.php";
print "<link rel='stylesheet' href='admin/style.css' type='text/css'>";
include "header.php";
//SELECT ALL VARIABLES
$getvars="SELECT * from bl_vars"; //get current variable values
$getvars2=mysql_query($getvars) or die("Could not get variables");
$getvars3=mysql_fetch_array($getvars2);
print "<head><title>$getvars3[title]</title></head>";
print "<table border='0' width=100%>";
print "<tr><td valign='top' width=22%>";
//grab profile
if($getvars3[showprofile]==1||$getvars3[showpic]==1||$getvars3[showemail]==1)
{
  $getprofile="SELECT * from bl_profile"; //get old picture
  $getprofile2=mysql_query($getprofile) or die("Could not get old picture");
  $getprofile3=mysql_fetch_array($getprofile2);
}
if($getvars3[showpic]==1)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center>Picture</center></td></tr>";
  print "<tr class='mainrow'><td><center>";
  print "<img src='$getprofile3[picture]' border='0' width='150' height='150'>";
  print "</td></tr></table><br><br>";
}
if($getvars3[showprofile]==1)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center>Profile</center></td></tr>";
  print "<tr class='mainrow'><td>";
  $quote=nl2br($getprofile3[quote]);
  if(strlen($getprofile3[name])>1)
  {
    print "Name: $getprofile3[name]<br>";
  }
  if(strlen($getprofile3[birthday])>1)
  {
    print "Birthday: $getprofile3[birthday]<br>";
  }
  if(strlen($getprofile3[sex])>1)
  {
    print "Gender: $getprofile3[sex]<br>";
  }
  if(strlen($getprofile3[state])>1)
  {
    print "State/Province: $getprofile3[state]<br>";
  }
  if(strlen($getprofile3[country])>1) 
  {
    print "Country: $getprofile3[country]<br>";
  }
  if(strlen($getprofile3[Interests])>1)
  {
    print "Interests: $getprofile3[Interests]<br>";
  }
  if(strlen($getprofile3[occupation])>1)
  {
    print "Occupation: $getprofile3[occupation]<br>";
  }
  if($getvars3[showemail]==1)
  {
    if(strlen($getprofile3[email])>1)
    {
      print "E-mail: $getprofile3[email]<br>";
    }
  }
  if(strlen($getprofile3[quote])>1)
  {
    print "Quote:<br>$getprofile3[quote]<br>";
  }
  print "</td></tr></table><br><br>";
}
if($getvars3[profile]==0&&$getvars3[email]==1)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center>Email</center></td></tr>";
  print "<tr class='mainrow'><td>";
  print "E-mail: $getprofile3[email]";
  print "</td></tr></table><br><br>";
}
if($getvars3[usephoto]==1)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center>Photo Gallery</center></td></tr>";
  print "<tr class='mainrow'><td><center>";
  print "<A href='photos.php'><b>View Photo Gallery</b></a>";
  print "</td></tr></table><br><br>";
}
if($getvars3[useguestbook]==1)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center>Guestbook</center></td></tr>";
  print "<tr class='mainrow'><td>";
  print "<A href='guestbook/index.php'>View Guestbook</a><br>";
  print "<A href='guestbook/addentry.php'>Sign Guestbook</a><br>";
  print "</td></tr></table>";
}
if($getvars3[useright]==1)
{
   $queryright="SELECT * from bl_right";
   $queryright2=mysql_query($queryright) or die("Could not query right");
   $queryright3=mysql_fetch_array($queryright2);
   print "$queryright3[right]";
}  
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
    print "<br><A href='comments.php?ID=$getblog3[entryid]'>$getblog3[numcomments] comments</a>--<A href='postcomment.php?ID=$getblog3[entryid]'>Add comment</a>";
  }
  if(isset($_SESSION['blogadmin']))
  {
     print "<br><br><A href='../admin/editblog.php?ID=$getblog3[entryid]'>Edit entry</a>--<A href='../admin/deleteentry.php?ID=$getblog3[entryid]'>Delete Entry</a>";
  }
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
