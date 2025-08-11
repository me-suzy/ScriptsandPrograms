<?php
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$numb_of_archives_to_show= $getprefs3[shownumofarchives];
$numb_of_archives_to_show_from= $getprefs3[shownumofnewsitems];
$getblog="SELECT * from CC_news order by realtime desc limit $numb_of_archives_to_show_from, $numb_of_archives_to_show";
$getblog2=mysql_query($getblog) or die($no_archives_error);
echo "<table border='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%'>";
echo  "<tr><td width='100%'>";
while($getblog3=mysql_fetch_array($getblog2))
{
   echo "<table width= '100%'><tr><td><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]>[<A href='more.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$getblog3[newstitle]</b></a></font>] ";
   echo "<i>$getblog3[thetime]</i></td></tr>";
   if(isset($_SESSION['cadmin']))
   {
      echo "<br><br><font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><A href='../admin/editblog.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$edit_item_label</a> - <A href='../admin/deleteentry.php?ID=$getblog3[entryid]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>$delete_item_label</a></font>";
   }
   echo "</td></tr></table></font><br>";
}
echo "</td></tr></table></font>";
?>