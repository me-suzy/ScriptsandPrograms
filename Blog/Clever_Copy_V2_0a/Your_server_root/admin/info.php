<?php
session_start();
include "connect.inc";
include "languages/default.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
echo "<body bgcolor=$getprefs3[block_background_color]>";
echo "<font face=$getprefs3[text_font_face] size=$getprefs3[text_font_size] color=$getprefs3[text_font_color]>";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
echo "<center><b>$server_config_info_label</b><br><br>";
phpinfo();
}
else
{
  echo $not_logged_in_label;
  echo "</td></tr></table>";

}
?>