<?php
  if($getprefs3[showseparator]==1)
      {
      echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";
      }
      if ($getprefs3[useblockwrapper]==1)
         {
         echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
         if ($getprefs3[block_use_heading_graphic] ==1)
         {
          echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height] background='bkgd.gif'>";
         }else{
         echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height]>";
      }
      echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;$getblocks3[gallery_block_label]</font></b></center></td></tr>";
      echo "<tr><td bgcolor=$getprefs3[block_background_color]>";
      echo "<font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><center><a href='maingallery.php'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>&#9702; $goto_gallery_label</a><br>";
      include "gallery/photos/galrandompic.php";
      echo "</td></tr></table><br>";
 }else{
   echo "<center><font face = $getprefs3[block_heading_font_face] size = $getprefs3[block_heading_font_size] color= $getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$getblocks3[gallery_block_label]</$getprefs3[block_heading_font_decoration]></center>"; 
   echo "<hr color=$getprefs3[separatorlinecolor] size = '1'><br></font>";
   include "gallery/photos/galrandompic.php";
   echo"<br>";
}
?>