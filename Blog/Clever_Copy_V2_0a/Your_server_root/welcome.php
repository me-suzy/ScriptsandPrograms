<?php
$query="SELECT * from CC_welcome";
$query2=mysql_query($query) or die($no_welcome_error);
$query3=mysql_fetch_array($query2);
echo "<br>";
echo "<table border=$welcome_message_border cellspacing='0' cellpadding = '3' style='border-collapse: collapse' bordercolor=$getprefs3[center_blockbordercolor] width='100%'>";
echo "<tr><td width='100%'><p align = center><font face = $query3[welcome_font_face] size=$query3[welcome_font_size] color=$query3[welcome_font_color]>$query3[welcome_message]</td>";
echo "</font></p></table><br>";
?>