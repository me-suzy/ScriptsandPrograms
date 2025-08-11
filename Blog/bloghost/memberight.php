<?php
if($getvarz3[showresume]==1)
{
   print "<table class='maintable'><tr class='headline'><td><center>Resume</center></td></tr>";
   print "<tr class='mainrow'><td>";
   print "<A href='resume.php?resumeid=$getvars3[adminid]'>View Resume</a>";
   print "</td></tr></table><br><br>";
}
print "<table class='maintable'><tr class='headline'><td><center>Search Archives</center></td></tr>";
print "<tr class='mainrow'><td>";
print "<form action='archive.php?membername=$membername' method='post'>";
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

include "calendar.php";

if($getvarz3[useleft]==1)
{
   $queryleft="SELECT * from bl_left where idf='$getvars3[adminid]'";
   $queryleft2=mysql_query($queryleft) or die("Could not query right");
   $queryleft3=mysql_fetch_array($queryleft2);
   print "$queryleft3[lefts]";
} 


?>