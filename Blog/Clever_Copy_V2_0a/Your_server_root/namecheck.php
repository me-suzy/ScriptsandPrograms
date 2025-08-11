<?php
session_start();
include "languages/default.php";
include "admin/connect.inc";
include "antihack.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
echo "<head><link rel='stylesheet' href='$style' type='text/css'></head>";

if(isset($_POST['submit']))
   {
   $username=antihax($_POST["username"]);
   $tempuname ="";
   $nameinuse = "false";
   $res = @mysql_query( "SELECT * FROM CC_users" );
   while( $row = mysql_fetch_array( $res ) )
        {
        $tempuname = $row[username];
        if ($username ==  $tempuname)
           {
           $nameinuse = "true";

        }
   }
   if ($nameinuse == "true")
   {
   echo "<b><center>$name_already_taken_label</b>";
   }
   else
       {
       echo "<b><center>$name_is_ok_label</b>";
   }
}
else
{
echo "<center>$check_availability_of_name_label<br><br>";
echo $check_for_which_name_label;
echo "<form action='namecheck.php' method='post'>";
echo "<input type='text' name='username' size='20'><br>";
echo "<input type='submit' name='submit' value='$namecheck_button_label'class = 'buttons'>";
}
?>