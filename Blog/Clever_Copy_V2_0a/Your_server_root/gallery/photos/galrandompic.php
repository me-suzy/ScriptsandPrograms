<?php
// MAX ALLOWABLE WIDTH OF IMAGE IS 160
$getgal="SELECT * from CC_gallery";
$getgal2=mysql_query($getgal) or die($no_preferences_error);
$getgal3=mysql_fetch_array($getgal2);
$extensions_to_use = 'jpg|gif|bmp';
$pictures_directory  = 'gallery/photos/thumb/';
$system_path =  $getgal3[galranpicpath];
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
echo "<br></font>$gallery_user_message<br><br>";
echo"<center><img src=$pictures_directory$the_pic[$ranum]>";
?>