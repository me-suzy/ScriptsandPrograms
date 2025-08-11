<?php
session_start();
include "connect.php";
print "<link rel='stylesheet' href='style.css' type='text/css'>";
if(isset($_SESSION['blogadmin']))
{
  $getadmin="SELECT * from bl_admin where username='$blogadmin'";
  $getadmin2=mysql_query($getadmin) or die("Cannot get admin");
  $getadmin3=mysql_fetch_array($getadmin2);
  print "<center><table class='maintable'>";
  print "<tr class='headline'><td><center>Prune Guestbook</center></td></tr>";
  print "<tr class='mainrow'><td>";
  if(isset($_POST['submit']))
  {
    if(!isset($_POST['numdays']))
    {
       print "You must enter a value for the number of days";
    }
    else
    {
      $numdays=$_POST['numdays'];
      $nowtime=date("U");
      $deltime=$nowtime-$numdays*24*3600;
      $delete="DELETE from bl_gbook where time<'$deltime' and identifier='$getadmin3[adminid]'";
      mysql_query($delete) or die("Could not delete entries");
      print "Entries pruned. Redirecting...<META HTTP-EQUIV = 'Refresh' Content = '2; URL =index.php'>";      
    }

  }
  else
  {
    print "Prune entries over how many days old?<br>";
    print "<form action='gbprune.php' method='post'>";
    print "<input type='text' name='numdays' size='5'><br>"; 
    print "<input type='submit' name='submit' value='submit'></form>";
   
  }
  print "</td></tr></table>";
 
}
else
{
  print "Not logged in";
}

?>