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
$numentries=21;
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
//get photos
$count=0;
if(!isset($_GET['start']))
   {
      $start=0;
   }
   else
   {
      $start=$_GET['start'];
   }
   $getmaincats="SELECT * from bl_photos order by mainpath ASC limit $start,21";
   $getmaincats2=mysql_query($getmaincats) or die("Could not get root categories"); 
   print "<table border=0>";
   while($getmaincats3=mysql_fetch_array($getmaincats2))
   {
     if($count%3==0)
     {
       print "<tr><td><A href=\"javascript:popWin('viewphotos.php?ID=$getmaincats3[photoid]',600, 600)\"><img src='photos/thumbs/$getmaincats3[thumbpath]' border='0'></a></td>";
     }
     else if($count%3==1)
     {
       print "<td><A href=\"javascript:popWin('viewphotos.php?ID=$getmaincats3[photoid]',600, 600)\"><img src='photos/thumbs/$getmaincats3[thumbpath]' border='0'></a></td>";
     }
     else
     {
       print "<td><A href=\"javascript:popWin('viewphotos.php?ID=$getmaincats3[photoid]',600, 600)\"><img src='photos/thumbs/$getmaincats3[thumbpath]' border='0'></a></td></tr>";
     }
     $count++;
   }
   print "</table>";
   

print "</center><br><br>";
$order="SELECT * from bl_photos order by mainpath ASC";
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
    print "<A href='photos.php?start=$prev'><<</a>&nbsp;";
  }
  while($order3=mysql_fetch_array($order2))
  {
     if($f>=$start-3*$numentries&&$f<=$start+7*$numentries)
     {
        if($f%$numentries==0)
        {
           print "<A href='photos.php?start=$d'>$g</a> ";
        }
     }
     $d=$d+1;
     $g=1+$d/$numentries;
     $f++;
  }
  if($start<=$num-$numentries)
  {
    print "<A href='photos.php?start=$next'>>></a>&nbsp;";
  }
print "</td>";
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
<center><font size='2'>Powered by © <A href='http://www.chipmunk-scripts.com'>Chipmunk Blogger</a></font></center>