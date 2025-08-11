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
   print "<table class='maintable'><tr class='headline'><td><center>Resume</center></td></tr>";
   print "<tr class='mainrow'><td>";
   if(isset($_POST['submit']))
   {
      if(strlen($_POST['yourname'])<1)
      {
         print "You did not enter your name.";
      }
      else if(strlen($_POST['body'])<1)
      {
         print "You did not enter a body.";
      }
      else
      {
         $exist=$_POST['exist'];
         $yourname=$_POST['yourname'];
         $address=$_POST['address'];
         $state=$_POST['state'];
         $telephone=$_POST['telephone'];
         $obj=$_POST['obj'];
         $body=$_POST['body'];
         if($exist==1)
         {
           $createresume="Update bl_resume set yourname='$yourname',address='$address',email='$email',phone='$telephone',zip='$state',mission='$obj',body='$body' where idresume='$getadmin3[adminid]'";
           mysql_query($createresume) or die(mysql_error());
           print "Resume Edited.";
         }
         else if($exist==0)
         {
           $createresume="INSERT into bl_resume (yourname,address,email,phone,zip,mission,body,idresume) values('$yourname','$address','$email','$telephone','$state','$obj','$body','$getadmin3[adminid]')";
           mysql_query($createresume) or die("Could not create resume");
           print "Resume created.";
         }
 

      }


   }
   else
   {

      $getcurrentresume="SELECT * from bl_resume where idresume='$getadmin3[adminid]'"; //fetch current resume
      $getcurrentresume2=mysql_query($getcurrentresume) or die("Could not get current resume");
      $getcurrentresume3=mysql_fetch_array($getcurrentresume2);
      if(mysql_num_rows($getcurrentresume2)>0)
      {

        $exist=1; 
      }
      else
      {
        $exist=0;
      }
      print "<form action='resume.php' method='post'>";
      print "<input type='hidden' name='exist' value='$exist'>";
      print "Name:*<br>";
      print "<input type='text' name='yourname' size='20' value='$getcurrentresume3[yourname]'><br>";
      print "Address:<br>";
      print "<input type='text' name='address' size='40' value='$getcurrentresume3[address]'><br>";
      print "City, State, Zip:<br>";
      print "<input type='text' name='state' size='40' value='$getcurrentresume3[zip]'><br>";
      print "Telephone:<br>";
      print "<input type='text' name='telephone' size='25' value='$getcurrentresume3[phone]'><br>";
      print "Email:<br>";
      print "<input type='text' name='email' size='20' value='$getcurrentresume3[email]'><br>";
      print "Objective(400 chars):<br>";
      print "<input type='text' name='obj' size='40' value='$getcurrentresume3[mission]'><br><br>";
      print "Resume Body*:<br>";
      print "<textarea name='body' rows='10' cols='60'>$getcurrentresume3[body]</textarea><br><br>";
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
