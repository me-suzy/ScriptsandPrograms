<?php
include "admin/connect.inc";
$main_page_width =  $getprefs3[main_page_width];
if ($main_page_width <= '69%')
{
      $main_page_width = "70%";
}
if ($main_page_width >= '99%')
{
      $main_page_width = "70%";
}
echo "<center><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width=$main_page_width>";
echo "<tr><td width='100%'><center>";
if ($getprefs3[showbanners]== '1')
{
      echo"<iframe src='topbanners.php' width='100%' height='86' frameborder='0' scrolling='no'></iframe><hr>";
}
echo "</td></tr></table>";
echo "<body bgcolor=$getprefs3[main_page_color]>";
echo "<table p align='center' border=$getprefs3[main_page_table_border] cellspacing='0' style='border-collapse: collapse' bordercolor=$getprefs3[main_page_table_border_color] width=$main_page_width>";
echo "<tr><td width='100%'>";
?>