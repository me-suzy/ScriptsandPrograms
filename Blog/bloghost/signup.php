<link rel="stylesheet" href="admin/style.css" type="text/css">
<center>
<?php
include "admin/connect.php";
include "admin/var.php";
print "<table class='maintable'>";
print "<tr class='headline'><td><center>Sign Up!</center></td></tr>";
print "<tr class='mainrow'><td>";
if(isset($_POST['submit']))
{
   $username=$_POST['username'];
   $passkey=$_POST['passkey'];
   $email=$_POST['email'];
   $getusers=mysql_query("select adminid from bl_admin where username='$username'");
   $dupuser=mysql_num_rows($getusers);
   if(strlen($username)<1)
   {
      print "You did not enter a username, please try again.";
   }
   else if($dupuser>0)
   {
      print "Someone has already signed up with that username.";
   }
   else if(strlen($passkey)<4)
   {
      print "You password must at least be 4 letter long, please try again.";
   }
   else if(strlen($email)<4)
   {
     print "That email is not valid.";
   }
   else
   {
      $checkemail="SELECT username from bl_admin where email='$email'"; //check for duplicate emails
      $checkemail2=mysql_query($checkemail) or die(mysql_error());
      $checkmail3=mysql_num_rows($checkemail2);
      if($checkmail3>0)
      {
         print "Someone is already registered with that email address.";
      }
      else
      {
         $randomseed=date("U");
         srand($randomseed);
         $validkey=rand(10000,1000000000);
         $validkey=md5($randomseed);
         $headers="From:$youremail";
         $passkey=md5($passkey);
         $opencss=fopen("style.css","r"); //open style.css for reading
         $grabcss=fread($opencss,filesize("style.css"));
         fclose($opencss); 
         $makeuser="Insert into bl_admin (username, password, status, email,keynode, validated,css) values('$username','$passkey','1','$email','$validkey','0','<style>$grabcss</style>')";
         mysql_query($makeuser) or die("Could not make user");
         $getuserid=mysql_query("select adminid from bl_admin where username='$username'") or die("Could not get user id");
         $getuserid2=mysql_fetch_array($getuserid);
         $createvars="INSERT INTO bl_vars (showprofile,showemail,showresume,showpic,useguestbook,showcalendar,title, useright,useleft,usephoto,idvars) VALUES (1, 1, 0, 1, 1, 1, '$username site', 1, 1, 1, '$getuserid2[adminid]')";
         mysql_query($createvars) or die("Could not create variables");
         mail($email,"Blog Registration","Please click on the following link to confirm your account: $path/validate.php?username=$username&thekey=$validkey",$headers);
         print "Registration successfull, check your email for an activation key.";
      }
    }

}
else
{ 
 print "<form action='signup.php' method='post'>";
 print "Username:<br>";
 print "<input type='text' name='username' size='20'><br>";
 print "Password:<br>";
 print "<input type='password' name='passkey' size='20'><br>";
 print "Email:<br>";
 print "<input type='email' name='email' size='20'><br>";
 print "<input type='submit' name='submit' value='submit'></form>";
}

print "</td></tr></table>";

