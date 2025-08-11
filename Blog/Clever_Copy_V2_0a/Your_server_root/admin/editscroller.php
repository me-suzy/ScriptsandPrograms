<?php
session_start();
include "connect.inc";
include "languages/default.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
echo "<html><head>";
echo "<title>$scroller_edit_title</title>";
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
   $stext=$_POST['stext'];
   $sspeed=$_POST['sspeed'];
   $sdirection=$_POST['sdirection'];
   $editscroller="UPDATE CC_scroller SET sdirection='$sdirection',stext='$stext',sspeed='$sspeed'";
   mysql_query($editscroller) or die($unable_to_save_preferences_error);
   echo $preferences_saved_label;
   echo "<meta http-equiv='refresh' content='0;URL=editscroller.php'>";
}else{
   $getscroller="SELECT * from CC_scroller";
   $getscroller2=mysql_query($getscroller) or die($no_scroller_error);
   $getscroller3=mysql_fetch_array($getscroller2);
   echo "<br><br>";
   $textsize= $getprefs3[text_font_size];
   $textsize = ($textsize+9);
   echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_scroller_label</font></b></center></td></tr>";
   echo "<td width='10%' bgcolor=$getprefs3[block_background_color]>";
   echo "<tr><td colspan = '2'><br><img src = '../images/information.gif'> $scroller_info_message_label<br><br>";
   echo "<tr><td width= '20%'>";
   echo "<b>$item_label</b>";
   echo "<td width= '80%'>";
   echo "<b>$current_settings_label</b>";
   echo "<tr><td width= '20%'>";
   echo "<form action='editscroller.php' method='post'>";
   echo "$current_scroller_label";
   echo "<td width= '80%'>";
   echo "<textarea rows='9' name='stext' cols = '55'>$getscroller3[stext]</textarea>";
   echo "<tr><td width= '20%'>";
   echo "$scroll_speed_label";
   echo "<td width= '80%'>";
   echo "<input type='text' name='sspeed' size='8' value='$getscroller3[sspeed]'>";
   echo "<tr><td width= '20%'>";
   echo "$scroller_direction_label";
   echo "<td width= '80%'>";
   echo "<select name='sdirection'>";
   if($getscroller3[sdirection]=="Up")
   {
           echo "<option value='Up'>$up_label</option>";
           echo "<option value='Down'>$down_label</option>";
   }else{
           echo "<option value='Down'>$down_label</option>";
           echo "<option value='Up'>$up_label</option>";
   }
   echo "<tr><td width= '20%'>";
   echo "$scroller_looks_like_this_label";
   echo "<td width= '80%'>";
   include "../scroller.php";
   echo "<tr><td width= '20%'>";
   echo "<td width= '80%'>";
   echo "<br><input type='submit' name='submit' value='$save_button_label' class = 'buttons'></form>";
}
}else{
  echo $no_login_error;
  include "index.php";
}
?>