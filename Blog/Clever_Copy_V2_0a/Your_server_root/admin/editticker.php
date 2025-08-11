<?php
session_start();
include "connect.inc";
include "languages/default.php";
?>
<html><head>
<title><?php echo $newsticker_edit_title; ?></title>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'>";
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
   $ticker=$_POST['ticker'];
   $speed=$_POST['speed'];
   $ticker_font=$_POST['ticker_font'];
   $ticker_font_color=$_POST['ticker_font_color'];
   $ticker_font_size=$_POST['ticker_font_size'];
   $editticker="update CC_ticker set ticker_font_color='$ticker_font_color', ticker_font_size='$ticker_font_size',ticker_font='$ticker_font',ticker='$ticker',speed='$speed'";
   mysql_query($editticker) or die($unable_to_save_preferences_error);
   echo $preferences_saved_label;
   echo "<meta http-equiv='refresh' content='0;URL=editticker.php'>";
}
else
   {
   $getticker="SELECT * from CC_ticker";
   $getticker2=mysql_query($getticker) or die($no_ticker_error);
   $getticker3=mysql_fetch_array($getticker2);
   echo "<br><br>";
   echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_ticker_label</font></b></center></td></tr>";
   echo "<td width='10%' bgcolor=$getprefs3[block_background_color]>";
   echo "<tr><td width= '20%'>";
   echo "<b>$item_label</b>";
   echo "<td width= '80%'>";
   echo "<b>$current_settings_label</b>";
   echo "<tr><td width= '20%'>";
   echo "<form action='editticker.php' method='post'>";
   echo $current_news_label;
   echo "<td width= '80%'>";
   echo "<textarea rows='9' name='ticker' cols = '55'>$getticker3[ticker]</textarea>";
   echo "<tr><td width= '20%'>";
   echo $scroll_speed_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='speed' size='8' value='$getticker3[speed]'>";
   echo "<tr><td width= '20%'>";
   echo $ticker_font_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='ticker_font' size='8' value='$getticker3[ticker_font]'>";
   echo "<tr><td width= '20%'>";
   echo $ticker_font_color_label;
   echo "<td width= '80%'>";
   echo "<input type='text' name='ticker_font_color' size='8' value='$getticker3[ticker_font_color]'>";
   echo "<tr><td width= '20%'>";
   echo $ticker_font_size;
   echo "<td width= '80%'>";
   echo "<input type='text' name='ticker_font_size' size='8' value='$getticker3[ticker_font_size]'>";
   echo "<tr><td width= '20%'>";
   echo $ticker_looks_like_this_label;
   echo "<td width= '80%'>";
   include "../ticker.php";
   echo "<tr><td width= '20%'>";
   echo "<td width= '80%'>";
   echo "<br><input type='submit' name='submit' value='$save_button_label' class = 'buttons'></form>";
}
}else
 {
  echo $no_login_error;
  include "index.php";
}
?>