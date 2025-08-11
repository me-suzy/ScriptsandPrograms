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
if($getadmin3['status']>=1)
{
   include "left.php";
   print "</td>";
   print "<td valign='top' width=70%>";
   print "<table class='maintable'><tr class='headline'><td><center>Add User Photo</center></td></tr>";
   print "<tr class='mainrow'><td>";  
   if(isset($_POST['submit']))
   {
      $photo=$_POST['photo'];
      $thumbnail=$_POST['thumbnail'];
      if(strlen($photo)<1)
      {
        print "You did not enter a photo.";
      }
      else 
      {
        $insertphoto="INSERT into bl_userphotos (path,thumbpath,belongid) values ('$photo','$thumbnail','$getadmin3[adminid]')";
        mysql_query($insertphoto) or die("Could not insert photo");
        print "Photo inserted.";
      }    


   }
   else
   {
      print "<form action='adduserphoto.php' method='post'>";
      print "Photo(include http://):<br>";
      print "<input type='text' name='photo' size='20'><br>";
      print "Thumbnail(include http:// 100*100 in size):<br>";
      print "<input type='text' name='thumbnail' size='20'><br>";
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