<?php
session_start();
include "connect.php";
print "<link rel='stylesheet' href='../admin/style.css' type='text/css'>";
if(isset($_SESSION['blogadmin']))
{
  print "<center><table class='maintable'><tr class='headline'><td><b>Search</b></td></tr>";
  print "<tr class='maintable'><td>";
  if(isset($_POST['submit'])||isset($_POST['searchterm']))
  {
     print "<center>";
     print "<table class='maintable'><tr class='headline'><td colspan='2'><center>Search Guestbook</center></td></tr>";
     $searchterm=$_POST['searchterm'];
     $getentries="SELECT * from bl_gbook where name like '%$searchterm%' or comment like '%$searchterm%'";
     $getentries2=mysql_query($getentries) or die("Could not get entries");
     while($getentries3=mysql_fetch_array($getentries2))
     {
       $getentries3[name]=htmlspecialchars($getentries3[name]);
       $getentries3[comment]=htmlspecialchars($getentries3[comment]);
       $getentries3[comment]= wordwrap( $getentries3[comment], 19, "\n", 1); 
       print "<tr class='mainrow'><td width=20%>";
       print "Name: $getentries3[name]<br>";
       print "</td><td width=80%>";
       print "Comment: $getentries3[comment]<br>";
       print "<A href='edit.php?ID=$getentries3[ID]'>Edit</a>&nbsp;&nbsp;<A href='../guestbook/delete.php?ID=$getentries3[ID]'>Delete</a><br><br>";
       print "</td></tr>";
     }
     print "</table>";
  }
  else 
  {
     print "<form action='searchgb.php' method='POST'>";
     print "Search:&nbsp;<input type='text' name='searchterm' size='20'><br>";
     print "<input type='submit' name='submit' value='submit'></form>";
  }
  print "</td></tr></table>";

}
else
{
  print "Not logged in";
}

?>