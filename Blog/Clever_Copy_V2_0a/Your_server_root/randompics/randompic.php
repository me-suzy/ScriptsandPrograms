<?php
// MAX ALLOWABLE WIDTH OF IMAGE IS 160
include "./languages/default.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$extensions_to_use = 'jpg|bmp|gif';
$pictures_directory  = 'randompics/';
$system_path =  $getprefs3[ranpicpath];
$pic_directory=opendir ($system_path);
$extensions="\.($extensions_to_use)$";
if(!$pic_directory)
{
die($random_pictures_not_found_error);
}
$ct=readdir($pic_directory);
$count="0";
$the_pic;
while($ct)
{
if(ereg($extensions, $ct))
{
$the_pic[$count]=$ct;
$count++;
}
$ct=readdir($pic_directory);
}
closedir($pic_directory);
$max=count($the_pic);
$max--;
$ranum=rand(0,$max);
echo "<center>$random_pics_label<br><br>";
echo"<center><img src=\"$pictures_directory$the_pic[$ranum]\">";
?>