<?php
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
include "meta.php";
include "admin/connect.inc";
include "admin/languages/default.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_slogan_error);
$getprefs3=mysql_fetch_array($getprefs2);
$getslogan="SELECT * from CC_slogan";
$getslogan2=mysql_query($getslogan) or die($no_slogan_error);
$getslogan3=mysql_fetch_array($getslogan2);
$slogan = $getslogan3[slogan];
if ($getslogan3[use_image_or_slogan] == "both"){
     echo "<table p align='center' border= '0' cellspacing='1' width='100%' >";
     echo "<tr><td p align = $getslogan3[site_image_alignment] width='50%'><img src = 'images/logo.gif'></td>";
     echo "<td valign = $getslogan3[slogan_vertical_align] p align = $getslogan3[site_slogan_alignment] width = '50%'><font face= $getslogan3[slogan_font_face] size= $getslogan3[slogan_font_size] color= $getslogan3[slogan_font_color]>$getslogan3[slogan]</tr></table>";
}else if ($getslogan3[use_image_or_slogan] == "slogan"){
     echo "<table p align='center' border= '0' cellspacing='0' width='100%'>";
     echo "<tr><td p align = $getslogan3[site_slogan_alignment] width='100%'><font face= $getslogan3[slogan_font_face] size= $getslogan3[slogan_font_size] color= $getslogan3[slogan_font_color]>$getslogan3[slogan]</td></tr></table>";
}elseif ($getslogan3[use_image_or_slogan]== "image"){
     echo "<table p align='center' border= '0' cellspacing='0' width='100%'>";
     echo "<tr><td p align = $getslogan3[site_slogan_alignment] width='100%'><img src = 'images/logo.gif'></td></tr></table>";
}
?>