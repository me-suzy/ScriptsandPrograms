<?php
$getweblinks = "SELECT * FROM CC_weblinks ORDER by weblinksid DESC";
$getweblinks2 = mysql_query($getweblinks)or die($no_weblinks_error); ;
$getweblinks3 = mysql_num_rows($getweblinks2);
for ($i=0; $i <$getweblinks3; $i++)
{
$row = mysql_fetch_array($getweblinks2);
     ($i+1);
     echo "<font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title='$row[title]' href='$row[weblink]'style='text-decoration: none' target='_new'><font color=$getprefs3[linkfont_color]>&#9702; $row[description]</a></font><br>";
}
echo "<hr><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title='$add_your_site_weblinks_alt_label' href='$getprefs3[siteaddress]/addtoweblinks.php'style='text-decoration:none'><font color=$getprefs3[linkfont_color]>&#9702; $add_your_site_weblinks_label</a></font><br>";
?>