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
   print "<table class='maintable'><tr class='headline'><td><center>Main Admin</center></td></tr>";
   print "<tr class='mainrow'><td>";
   if(isset($_POST['submit']))
   {
    
      $exist=$_POST['exist'];
      $rightblock=$_POST['rightblock'];
      if($exist==1)
      {
        $rblock="UPDATE `bl_right` SET `rights` = '$rightblock' ";
         mysql_query($rblock) or die("Could not get right block");
         print "Right block edited.";
      }
      else if($exist==0)
      {
          $rblock="INSERT into bl_right (rights,idf) values('$rightblock','$getadmin3[adminid]')";
           mysql_query($rblock) or die("Could not insert block");
           print "Right block inserted.";
       }

   }
   else
   {  
      $getrightblock="SELECT * from bl_right where idf='$getadmin3[adminid]'";
      $getrightblock2=mysql_query($getrightblock) or die("Could not get right block");
      $getrightblock3=mysql_fetch_array($getrightblock2);
      if(mysql_num_rows($getrightblock2)>0)
      {
           $exist=1;
      }
      else 
      {
           $exist=0;
      }
      print "<form action='right.php' method='post'>";
      print "<input type='hidden' name='exist' value='$exist'>";
      print "Put custom right block here(HTML allowed):<br>";
      print "<textarea name='rightblock' rows='5' cols='40'>$getrightblock3[rights]</textarea><br>";
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




