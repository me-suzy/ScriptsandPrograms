<?php
session_start();
include "connect.php";
print "<link rel='stylesheet' href='style.css' type='text/css'>";
if(isset($_SESSION['blogadmin']))
{
  print "<center><table class='maintable'>";
  print "<tr class='headline'><td><center>Prune blog</center></td></tr>";
  print "<tr class='mainrow'><td>";
  if(isset($_POST['submit']))
  {
     $month=$_POST['month'];
     $year=$_POST['year'];
     $getentries="SELECT * from bl_blog where month<'$month' and year<='$year'";
     $getentries2=mysql_query($getentries) or die(mysql_error()); 
     while($getentries3=mysql_fetch_array($getentries2))
     {
       $delcomments="DELETE from bl_comments where eparent='$getentries3[entryid]'";
       mysql_query($delcomments) or die("Could not delete comments");
     }
     $getentriez="SELECT * from bl_blog where year<'$year'";
     $getentriez2=mysql_query($getentriez) or die(mysql_error()); 
     while($getentriez3=mysql_fetch_array($getentriez2))
     {
       $delcomments="DELETE from bl_comments where eparent='$getentriez3[entryid]'";
       mysql_query($delcomments) or die("Could not delete comments");
     }
     $deletecomment="DELETE from bl_blog where month<'$month'and year='$year'";
     mysql_query($deletecomment) or die(mysql_error());
     $deletecommentz="DELETE from bl_blog where year<'$year'";
     mysql_query($deletecommentz) or die(mysql_error());
     print "Entries Deleted.";

  }
  else
  {
     print "<form action='pruneentries.php' method='post'>";
     print "Prune all entries before which month:<br>";
     print "<select name='month'>";
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
     print "<option value='12'>December</option></select><br><br>";
     print "Of which year(Use 4 digits please):<br>";
     print "<input type='text' name='year' size='10'><br>";
     print "<input type='submit' name='submit' value='submit'></form>";
   
  }
  print "</td></tr></table>";
 
}
else
{
  print "Not logged in";
}

?>