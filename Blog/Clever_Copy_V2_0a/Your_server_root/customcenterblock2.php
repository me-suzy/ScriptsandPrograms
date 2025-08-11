<?php
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height]>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;$getblocks3[custom_bottom_center_block_label]</font></b></center></td></tr>";
echo "<tr><td bgcolor=$getprefs3[block_background_color]>";
$getblock="SELECT * from CC_custom_centre_blocks WHERE customid = '2'";
$getblock2=mysql_query($getblock) or die($no_customblock_error);
$getblock3=mysql_fetch_array($getblock2);
echo $getblock3[customblock];
echo "</td></tr></table><br>";
if($getprefs3[showseparator]==1)
{
   echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";
}
echo "<br>";
?>