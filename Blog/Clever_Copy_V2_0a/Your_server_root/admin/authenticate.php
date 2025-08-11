<?php
session_start();
include "connect.inc";
include "languages/default.php";
include "../languages/default.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
echo "<head><link rel='stylesheet' href='$style' type='text/css'></head> ";
echo "<center><table><tr><td>$getting_login_label</center></td></tr>";
echo "<tr><td>";
if (isset($_POST['submit']))
{
   $username=$_POST['username'];
   $password=$_POST['password'];
   $password=md5($password);
   $getadmin="SELECT * from CC_admin where username='$username' and password='$password'";
   $getadmin2=mysql_query($getadmin) or die($no_admin_error);
   $getadmin3=mysql_fetch_array($getadmin2);
   if ((strlen($getadmin3['password'])<1) || (strlen($getadmin3['username'])<1))
   {
      echo $wrong_login_label;
      echo "<meta http-equiv='refresh' content='3;URL=index.php' target='_top'>";
      echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
   }else{
      $_SESSION['cadmin']= $username;
      echo "<meta http-equiv='refresh' content='3;URL=index.php' target='_top'>";
      echo "<p align = 'center'>$if_you_see_label <A href='index.php'> $click_here_label</a></p>";
   }
}
print "</td></tr></table>";
?>