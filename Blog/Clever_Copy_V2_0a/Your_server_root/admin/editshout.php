<?php
session_start();
include "languages/default.php";
include "../languages/default.php";
?>
<head><title><?php echo $shout_edit_title; ?></title>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'></head>";
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
$banner_getinfo_label = "<b>The Shout Box is not currently available on your site.</b><br>
<br>The shout box is a purchased add on. With the shout box installed your visitors can 'shout' to one another in realtime. Great for getting visitors
 back to your site!<br><br>
The shout box is available for just $9.99
 and you can purchase it by clicking <a href='buyblocks.php'>HERE</a>
";
 include "index.php";
 echo "<br><br>";
 echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
 echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td><left>";
 echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_shout_label</font></b></td></tr>";
 echo "<tr><td valign = 'top'><img src = '../images/information.gif'> $banner_getinfo_label<br><hr noshade color='#000000' size='1'>";
 echo "<tr><td valign = 'top' ><b>";
 echo "<tr><td width='3%'valign = 'top'>";
 echo "<br><br>";
}
?>