<?php
session_start();
include "header.php";
include "smiley.php";
include "admin/connect.php";
$numentries=15;
print "<link rel='stylesheet' href='admin/style.css' type='text/css'>";
//SELECT ALL VARIABLES
$getvars="SELECT * from bl_vars"; //get current variable values
$getvars2=mysql_query($getvars) or die("Could not get variables");
$getvars3=mysql_fetch_array($getvars2);
print "<head><title>$getvars3[title]</title></head>";
print "<table border='0' width=100%>";
print "<tr><td valign='top' width=22%>";
print "<table class='maintable'>";
print "<tr class='headline'><td><center>Main</center></td></tr>";
print "<tr class='mainrow'><td><A href='index.php'>Back to Main</a></td></tr></table><br><br>";
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
  $getblog3[maincontent]=nl2br($getblog3[maincontent]);
  print "<table class='maintable'><tr class='headline'><td><b>$getblog3[blogtitle]</b> posted by $getblog3[author]<br>";
  print "Posted on $getblog3[thetime]</td></tr>";
  print "<tr class='mainrow'><td>";
  print "$getblog3[maincontent]<br>";
  if($getblog3[allowcomments]==1)
  {
    print "<br><A href='comments.php?ID=$getblog3[entryid]'>$getblog3[numcomments] comments</a>--<A href='postcomment.php?ID=$getblog3[entryid]'>Add comment</a>";
  }
  if(isset($_SESSION['blogadmin']))
  {
     print "<br><br><A href='../admin/editblog.php?ID=$getblog3[entryid]'>Edit entry</a>--<A href='../admin/deleteentry.php?ID=$getblog3[entryid]'>Delete Entry</a>";
  }
  print "</td></tr></table><br>";
  if(!isset($_GET['start']))
  {
    $start=0;
  }
  else
  {
    $start=$_GET['start'];
  }
  $getcomments="SELECT * from bl_comments where eparent='$ID' order by commentid DESC limit $start, $numentries";
  $getcomments2=mysql_query($getcomments) or die("Could not get comments");
  while($getcomments3=mysql_fetch_array($getcomments2))
  {
    $getcomments3[comment]=strip_tags($getcomments3[comment]);
    $getcomments3[comment]=htmlspecialchars($getcomments3[comment]);
    $getcomments3[comment]=smile($getcomments3[comment]);
    $getcomments3[comment]=stripslashes($getcomments3[comment]);
    $getcomments3[name]=strip_tags($getcomments3[name]);
    $getcomments3[name]=htmlspecialchars($getcomments3[name]);
    $getcomments3[name]=wordwrap($getcomments3[name], 30, "\n", 1);
    $getcomments3[comment]=wordwrap($getcomments3[comment], 30, "\n", 1);
    print "<table class='maintable'><tr class='headline'><td>Name</td><td>Comment</td></tr>";
    print "<tr class='mainrow'><td valign='top' width=25%>$getcomments3[name]";
    if(isset($_SESSION['blogadmin']))
    {
       print "<br>IP: $getcomments3[IP]";
    }
    print "</td><td width=80% valign='top'>$getcomments3[comment]";
    if(isset($_SESSION['blogadmin']))
    {
      print "<br><br><A href='admin/deletecomment.php?ID=$getcomments3[commentid]'>Delete Comment</a>";
    }
    print "</td></tr></table><br>";
  }
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center><b>Comments navigation</b></center></td></tr>";
  print "<tr class='mainrow'><td valign='top'>";
 
  $order="SELECT * from bl_comments where eparent='$ID'";
  $order2=mysql_query($order) or die(mysql_error());
  $d=0;
  $f=0;
  $g=1+$d/$numentries;
  $num=mysql_num_rows($order2);
  print "Page:</font> ";
  $prev=$start-$numentries;
  $next=$start+$numentries;
  if($start>=$numentries)
  {
    print "<A href='comments.php?start=$prev&ID=$ID'><<</a>&nbsp;";
  }
  while($order3=mysql_fetch_array($order2))
  {
     if($f>=$start-3*$numentries&&$f<=$start+7*$numentries)
     {
        if($f%$numentries==0)
        {
           print "<A href='comments.php?start=$d&ID=$ID'>$g</a> ";
        }
     }
     $d=$d+1;
     $g=1+$d/$numentries;
     $f++;
  }
  if($start<=$num-$numentries)
  {
    print "<A href='comments.php?start=$next&ID=$ID'>>></a>&nbsp;";
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

?>
