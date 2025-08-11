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
    
      $existed=$_POST['existed'];
      $lblock=$_POST['leftblock'];
      if($existed==1)
      {
         $left="UPDATE `bl_left` SET `lefts` = '$lblock' where idf='$getadmin3[adminid]' ";
      mysql_query($left) or die(mysql_error());
      print "Left block edited.";
      }
      else if($existed==0)
      {
          $left="INSERT INTO bl_left (idf,lefts) values ('$getadmin3[adminid]','$lblock')";
          mysql_query($left) or die(mysql_error());
          print "Left block inserted";
      }
   }
   else
   {  
      $getleftblock="SELECT * from bl_left where idf='$getadmin3[adminid]'";
      $getleftblock2=mysql_query($getleftblock) or die("Could not get left block");
      $getleftblock3=mysql_fetch_array($getleftblock2);
      if(mysql_num_rows($getleftblock2)>0)
     {
         $existed=1;
     }
     else
     {
         $existed=0;
      }
      print "<form action='uleft.php' method='post'>";
      print "<input type='hidden' name='exist' value='$existed'>";
      print "Put custom left block here(HTML allowed):<br>";
      print "<textarea name='leftblock' rows='5' cols='40'>$getleftblock3[lefts]</textarea><br>";
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




