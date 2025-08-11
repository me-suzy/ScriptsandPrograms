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
   if(isset($_POST['submit'])) //update to new picture
   {
      $idvar=$getadmin3[adminid];
      $myname=$_POST['myname'];
      $gender=$_POST['gender'];  
      $state=$_POST['state'];
      $country=$_POST['country'];
      $interests=$_POST['interests'];
      $occupation=$_POST['occupation'];
      $email=$_POST['email'];
      $quote=$_POST['quote'];
      $birthday=$_POST['birthday'];
      $exist=$_POST['exist'];
      if($exist==1)
      {
        $updateprofile="UPDATE bl_profile  set name='$myname', birthday='$birthday', sex='$gender', state='$state',country='$country',Interests='$interests',occupation='$occupation',quote='$quote',email='$email' where belongid='$idvar'";
        mysql_query($updateprofile) or die(mysql_error());
        print "Profile Updated.";
      }
      else //create new profile
      {
        $createprofile="INSERT into bl_profile (name, birthday, sex,state,country, Interests,occupation, quote,email, belongid) values('$myname','$birthday','$gender','$state','$country','$interests','$occupation','$quote', '$email','$idvar')";
        mysql_query($createprofile) or die(mysql_error());
        print "Profile Created.";
      }

   }
   else
   { 
      $profileid=$getadmin3[adminid];
      $getprofile="SELECT * from bl_profile where belongid='$profileid'"; //get old profile
      $getprofile2=mysql_query($getprofile) or die("Could not get old picture");
      $getprofile3=mysql_fetch_array($getprofile2);
      if(mysql_num_rows($getprofile2)==0)
      {
         $exist=0; //profile does not exist
      }
      else
      {
         $exist=1;
      }
      print "<form action='profile.php' method='post'>";
      print "<input type='hidden' name='exist' value='$exist'>";
      print "Name:<br>";
      print "<input type='text' name='myname' length='30' value='$getprofile3[name]'><br>";
      print "Gender:<br>";
      print "<select name='gender'>";
      if($getprofile3[sex]=="Male")
      {
        print "<option>Male</option>";
        print "<option>Female</option>";
      }
      else
      {
        print "<option>Female</option>";
        print "<option>Male</option>";
      }
      print "</select><br>";
      print "Birthday:<br>";
      print "<input type='text' name='birthday' length='20' value='$getprofile3[birthday]'><br>";
      print "State or Province:<br>";
      print "<input type='text' name='state' length='20' value='$getprofile3[state]'><br>";
      print "Country:<br>";
      print "<input type='text' name='country' length='20' value='$getprofile3[country]'><br>";
      print "Interests:<br>";
      print "<input type='text' name='interests' length='40' value='$getprofile3[Interests]'><br>";
      print "Occupation:<br>";
      print "<input type='text' name='occupation' length='20' value='$getprofile3[occupation]'><br>";
      print "Email:<br>";
      print "<input type='text' name='email' length='30' value='$getprofile3[email]'><br>";
      print "Quote:<br>";
      print "<textarea name='quote' rows='4' cols='30'>$getprofile3[quote]</textarea><br><br>";
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