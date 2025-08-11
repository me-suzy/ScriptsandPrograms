<?php
include "admin/connect.inc";
include "phpBB2/config.php";
if($getprefs3[showseparator]==1)
{
   echo "<hr color=$getprefs3[separatorlinecolor] size = '1'>";
}
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height]>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;$getblocks3[last5_bb2_posts_label]</font></b></center></td></tr>";
echo "<tr><td bgcolor=$getprefs3[block_background_color]>";
$siteaddress = $getprefs3[siteaddress];
$posttable = $table_prefix.'posts';
$posttabletext = $table_prefix.'posts_text';
$forumquery = ("SELECT * FROM $posttable  ORDER BY post_time DESC LIMIT 5") or die($no_forums_error);
$forumresult = mysql_query($forumquery);
while($forumrow = mysql_fetch_array($forumresult))
{
  $topicid = $forumrow[topic_id];
  $postid = $forumrow[post_id];
  $topicstable = $table_prefix.'topics';
  $gettopic="SELECT * FROM $topicstable WHERE topic_id = '$topicid'";
  $gettopic2=mysql_query($gettopic) or die($no_forums_error);
  $gettopic3=mysql_fetch_array($gettopic2);
  $getposttext="SELECT * FROM $posttabletext WHERE post_id = '$postid'";
  $getposttext2=mysql_query($getposttext) or die($no_forums_error);
  $getposttext3=mysql_fetch_array($getposttext2);
  echo "<a href='$siteaddress/phpBB2/viewtopic.php?t=$topicid' title = '$click_visit_forums_label' target='_new'>$gettopic3[topic_title]</a>";
  $thestring = "$getposttext3[post_text]";
  $posttext = substr($thestring,0,82);
  echo "<br>&nbsp;&nbsp;<img src = 'images/arrow.gif'> $posttext ...<br>";
}
echo "</center></td></tr></table><br>";
?>