<?php
if($getprefs3[showseparator]==1)
{
   echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";
}
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height]>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;$getblocks3[show_last_phorum_label]</font></b></center></td></tr>";
echo "<tr><td bgcolor=$getprefs3[block_background_color]>";
$siteaddress = $getprefs3[siteaddress];
$query =  ("SELECT * FROM phorum_messages ORDER By datestamp DESC LIMIT 5") or die($no_forums_error);
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
   $forumid = $row[forum_id];
   $messageid = $row[message_id];
   $thread = $row[thread];
   $body = $row[body];
   $posttext = substr($body,0,82);
   echo "<a href='$siteaddress/phorum/read.php?$forumid,$thread,$messageid#msg-$messageid' title = '$click_visit_forums_label' target='_new'>$row[subject]</a>";
   echo "<br>&nbsp;&nbsp;<img src = 'images/arrow.gif'> $posttext ...<br>";
}
echo "</center></td></tr></table><br>";
?>


