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
if($getadmin3['status']>=3)
{
   include "left.php";
   print "</td>";
   print "<td valign='top' width=70%>";
   print "<table class='maintable'><tr class='headline'><td><center>Main Admin</center></td></tr>";
   print "<tr class='mainrow'><td>";
   if(isset($_POST['submit'])) //submit button has been pushed
   {
      $username=$_POST['username'];
      $passkey=$_POST['passkey'];
      $status=$_POST['status'];
      $email=$_POST['email'];
      if(strlen($username)<2)
      {
        print "Usernames must at least be two letters long, please try again.<br>";
      }
      else if(strlen($passkey)<5)
      {
        print "Passwords must at least be 5 charaters long, please try again.<br>";
      }
      else
      {
        $checkdup="SELECT username from bl_admin where username='$username'"; //check to see if username is already present
        $checkdup2=mysql_query($checkdup) or die("Could not get duplicated");
        $checkdup3=mysql_num_rows($checkdup2);
        if($checkdup3>0)
        {
           print "There us already a user with that name.";
        }
        else //create the user
        {
           $theseed=date("U")%100000;
           srand($theseed);
           for($i=0;$i<9;$i++) //generator random key
           {
             $num=rand(48,122);
             $pwd.=chr($num);
           }
           $passkey=md5($passkey);
           $opencss=fopen("style.css","r"); //open style.css for reading
           $grabcss=fread($opencss,filesize("style.css"));
           fclose($opencss);
           $pwd=md5($pwd); //convert key into md5 hash
           $makeuser="Insert into bl_admin (username, password, status, email,keynode, validated,css) values('$username','$passkey','$status','$email','$pwd','1','<style>$grabcss</style>')";
           mysql_query($makeuser) or die("Could not make user");
           $getuserid=mysql_query("select adminid from bl_admin where username='$username'") or die("Could not get user id");
           $getuserid2=mysql_fetch_array($getuserid);
           $createvars="INSERT INTO bl_vars (showprofile,showemail,showresume,showpic,useguestbook,showcalendar,title, useright,useleft,usephoto,idvars) VALUES (1, 1, 0, 1, 1, 1, '$username site', 1, 1, 1, '$getuserid2[adminid]')";
           mysql_query($createvars) or die("Could not create variables");
            

           print "User added.";
         }
       }
   
   }
   else //form to add user
   {
      print "<form action='adduser.php' method='post'>";
      print "User name:<br>";
      print "<input type='text' name='username' size='20'><br>";
      print "Password:<br>";
      print "<input type='text' name='passkey' size='20'><br>";
      print "Status:<br>";
      print "<select name='status'>";
      print "<option value='1'>Member</option>";
      print "<option value='2'>Moderator</option>";
      print "<option value='3'>Administrator</option>";
      print "</select><br><br>";
      print "Email:<br>";
      print "<input type='text' name='email' size='20'><br>";
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