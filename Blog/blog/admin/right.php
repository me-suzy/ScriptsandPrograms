<?php
session_start();
?>
<link rel="stylesheet" href="style.css" type="text/css">
<center><table border='0' width=100%><tr><td valign='top' width=30%>
<?PHP
include "connect.php";
$blogadmin=$_SESSION['blogadmin'];
$getadmin="SELECT * from bl_admin where username='$blogadmin'";
$getadmin2=mysql_query($getadmin) or die("Cannot get admin");
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "left.php";
   print "</td>";
   print "<td valign='top' width=70%>";
   print "<table class='maintable'><tr class='headline'><td><center>Main Admin</center></td></tr>";
   print "<tr class='mainrow'><td>";
   if(isset($_POST['submit']))
   {
    
      $rightblock=$_POST['rightblock'];
      $rblock="UPDATE `bl_right` SET `right` = '$rightblock' ";
      mysql_query($rblock) or die("Could not get right block");
      print "Right block edited.";

   }
   else
   {  
      $getrightblock="SELECT * from bl_right";
      $getrightblock2=mysql_query($getrightblock) or die("Could not get right block");
      $getrightblock3=mysql_fetch_array($getrightblock2);
      print "<form action='right.php' method='post'>";
      print "Put custom right block here(HTML allowed):<br>";
      print "<textarea name='rightblock' rows='5' cols='40'>$getrightblock3[right]</textarea><br>";
      print "<input type='submit' name='submit' value='submit'></form>";


   }
   print "</td></tr></table>";
}
else
{
  print "Not logged in.";
  print "</td></tr></table>";
 

}
?>