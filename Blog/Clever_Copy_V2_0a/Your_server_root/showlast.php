<?php

include "db_config.inc";
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height]>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;$getblocks3[last5_class1_posts_label]</font></b></center></td></tr>";
echo "<tr><td bgcolor=$getprefs3[block_background_color]>";
$siteaddress = $getprefs3[siteaddress];
$query =  ("SELECT * FROM messages ORDER By date DESC LIMIT 5") or die($no_forums_error);
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
   $id = $row[id];
   $subject = $row[subject];
   $message = $row[message];
   $posttext = stripslashes(substr($message,0,82));
   if ($row[reply_to_id] !== '0'){
     $replid = $row[reply_to_id];
     $getsub="SELECT subject,id FROM messages WHERE id = '$replid'";
     $getsub2=mysql_query($getsub) or die($no_forums_error);
     $getsub3=mysql_fetch_array($getsub2);
     $subject = $getsub3[subject];
     $id = $getsub3[id];
   }
   echo "<a href='$siteaddress/forum/viewforum.php?mode=view&id=$id&start=0' title = '$click_visit_forums_label' target='_new'>$subject</a>";
   echo "<br>&nbsp;&nbsp;<img src = 'images/arrow.gif'> $posttext ...<br>";
}
echo "</td></tr></table><br>";
?>