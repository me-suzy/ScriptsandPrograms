<?php
print "<table class='maintable'>";
print "<tr class='headline'><td><center>$getvarz3[title]</center></td></tr>";
print "<tr class='mainrow'><td><center>";
print "<A href='member.php?membername=$getvars3[username]'>Home</a>";
print "</td></tr></table><br><br>";
if($getvarz3[showprofile]==1||$getvarz3[showpic]==1||$getvarz3[showemail]==1)
{
  $getprofile="SELECT * from bl_profile where belongid='$getvars3[adminid]'"; //get old picture
  $getprofile2=mysql_query($getprofile) or die("Could not get old picture");
  $getprofile3=mysql_fetch_array($getprofile2);
}
if($getvarz3[showpic]==1)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center>Picture</center></td></tr>";
  print "<tr class='mainrow'><td><center>";
  print "<img src='$getprofile3[picture]' border='0' width='150' height='150'>";
  print "</td></tr></table><br><br>";
}
if($getvarz3[showprofile]==1)
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
if($getvarz3[profile]==0&&$getvarz3[email]==1)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center>Email</center></td></tr>";
  print "<tr class='mainrow'><td>";
  print "E-mail: $getprofile3[email]";
  print "</td></tr></table><br><br>";
}
if($getvarz3[usephoto]==1)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center>Photo Gallery</center></td></tr>";
  print "<tr class='mainrow'><td><center>";
  print "<A href='photos.php?membername=$membername'><b>View Photo Gallery</b></a>";
  print "</td></tr></table><br><br>";
}
if($getvarz3[useguestbook]==1)
{
  print "<table class='maintable'>";
  print "<tr class='headline'><td><center>Guestbook</center></td></tr>";
  print "<tr class='mainrow'><td>";
  print "<A href='guestbook/index.php?membername=$membername'>View Guestbook</a><br>";
  print "<A href='guestbook/addentry.php?membername=$membername'>Sign Guestbook</a><br>";
  print "</td></tr></table>";
}
if($getvarz3[useright]==1)
{
   $queryright="SELECT * from bl_right where idf='$getvars3[adminid]'";
   $queryright2=mysql_query($queryright) or die("Could not query left");
   $queryright3=mysql_fetch_array($queryright2);
   print "$queryright3[rights]";
} 
?>