<?php
session_start();
include "languages/default.php";
include "../languages/default.php";
?>
<head><title><?php echo $banners_edit_title; ?></title>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'></head>";
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
$banner_getinfo_label = "<b>Banners are not currently available on your site.</b><br>
<br>The banner manager is a purchased add on. With the banner manager installed you can accept paid adverts on your site
for both the top banner position and the side banner position. You can set the cost per click, the cost per number of views or
 the cost per number of weeks. It is very flexible and allows you to tightly control how and where banners are shown. You can even add your
 own banners.<br><br>
With automatic invoicing, you don't even have to chase your advertisers for money. The banner manager will automatically suspend their link
 until their invoice has been paid!<br><br>
The banner manager is available for just $6.99
 and you can purchase it by clicking <a href='buyblocks.php'>HERE</a>
";
 include "index.php";
 echo "<br><br>";
 echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
 echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td><left>";
 echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_banners_label</font></b></td></tr>";
 echo "<tr><td valign = 'top'><img src = '../images/information.gif'> $banner_getinfo_label<br><hr noshade color='#000000' size='1'>";
 echo "<tr><td valign = 'top' ><b>";
 echo "<tr><td width='3%'valign = 'top'>";
 echo "<br><br>";
}
?>
