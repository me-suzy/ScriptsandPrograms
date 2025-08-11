<?php
session_start();
include "connect.inc";
include "languages/default.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
echo "<html><head>";
echo "<title>$rss_edit_title</title>";
echo "<link rel='stylesheet' href='$style' type='text/css'>";
echo "</head>";
echo "<body bgcolor=$getprefs3[block_background_color]>";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
include "index.php";
if(isset($_POST['submit']))
{
   $rsstitle=$_POST['rsstitle'];
   $rssdescription=$_POST['rssdescription'];
   $rssimagedescription=$_POST['rssimagedescription'];
   $rssimageurl=$_POST['rssimageurl'];
   $rssimagetitle=$_POST['rssimagetitle'];
   $editprefs="UPDATE CC_prefs SET rsstitle='$rsstitle',rssdescription='$rssdescription',rssimagedescription='$rssimagedescription',rssimageurl='$rssimageurl',rssimagetitle='$rssimagetitle'";
   mysql_query($editprefs) or die($unable_to_save_preferences_error);
   echo $preferences_saved_label;
   echo "<meta http-equiv='refresh' content='0;URL=editrssfeed.php'>";
}
else
   {
   echo "<br><br>";
   echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_rssprefs_label</font></b></td></tr>";
   echo "<td width='10%' bgcolor=$getprefs3[block_background_color]>";
   echo "<tr><td width= '20%'>";
   echo "<b>$item_label</b>";
   echo "<td width= '80%'>";
   echo "<b>$current_settings_label</b>";
   echo "<tr><td width= '20%'>";
   echo "<form action='editrssfeed.php' method='post'>";
   echo "$rss_title_label";
   echo "<td width= '80%'>";
   echo "<input type='text' name='rsstitle' size='80' value='$getprefs3[rsstitle]'>";
   echo "<tr><td width= '20%'>";
   echo "$rssdescription_label";
   echo "<td width= '80%'>";
   echo "<input type='text' name='rssdescription' size='80' value='$getprefs3[rssdescription]'>";
   echo "<tr><td width= '20%'>";


   echo "$rssimageurl_label";
   echo "<td width= '80%'>";
   echo "<input type='text' name='rssimageurl' size='80' value='$getprefs3[rssimageurl]'>";
   echo "<tr><td width= '20%'>";
   echo "$rssimagetitle_label";
   echo "<td width= '80%'>";
   echo "<input type='text' name='rssimagetitle' size='80' value='$getprefs3[rssimagetitle]'>";
   echo "<tr><td width= '20%'>";
   echo "$rssimagedescription_label";
   echo "<td width= '80%'>";
   echo "<input type='text' name='rssimagedescription' size='80' value='$getprefs3[rssimagedescription]'>";
   echo "<tr><td width= '20%'>";
   echo "<td width= '80%'>";
   echo "<br><input type='submit' name='submit' value='$save_button_label' class = 'buttons'></form>";
}
}else{
  echo $no_login_error;
  include "index.php";
}
?>