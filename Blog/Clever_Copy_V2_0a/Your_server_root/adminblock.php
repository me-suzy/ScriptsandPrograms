<?php
session_start();
include "admin/connect.inc";
$style = $getprefs3[personality];
?>
<head><title></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<?php
if(isset($_SESSION['cadmin']))
{
   $cadmin=$_SESSION['cadmin'];
   $getadmin="SELECT * from CC_admin where username='$cadmin'";
   $getadmin2=mysql_query($getadmin) or die($no_admin_error);
   $getadmin3=mysql_fetch_array($getadmin2);
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
            }
            else
            {
             echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height]>";
            }
            echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;$getblocks3[admin_link_block_label]</font></b></center></td></tr>";
            echo "<tr><td bgcolor=$getprefs3[block_background_color]>";
            echo "<font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><center><a href='admin/index.php'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$goto_admin_label</a></font><br>";
            include "waiting.php";
            echo "</td></tr></table><br>";
       }
       else
       {
        echo "<center><font face = $getprefs3[block_heading_font_face] size = $getprefs3[block_heading_font_size] color= $getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$getblocks3[admin_link_block_label]</$getprefs3[block_heading_font_decoration]></center>"; 
        echo "<hr color=$getprefs3[separatorlinecolor] size = '1'><br></font>";
        echo "<font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><center><a href='admin/index.php'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$goto_admin_label</a><br>";
        include "waiting.php";
        echo "<br>";
       }
}
echo "</font>";
?>