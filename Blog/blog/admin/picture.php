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
   if(isset($_POST['submit'])) //update to new picture
   {
      $picurl=$_POST['picurl'];
      $insertpic="UPDATE bl_profile set picture='$picurl'";
      mysql_query($insertpic) or die(mysql_error());
      print "Picture edited.";

   }
   else
   { 
      $geturlpic="SELECT * from bl_profile"; //get old picture
      $geturlpic2=mysql_query($geturlpic) or die("Could not get old picture");
      $geturlpic3=mysql_fetch_array($geturlpic2);
      print "<form action='picture.php' method='post'>";
      print "URL of picture, will be resized to 150*150(include http://)<br>";
      print "<input type='text' name='picurl' size='20' value='$geturlpic3[picture]'><br>";
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