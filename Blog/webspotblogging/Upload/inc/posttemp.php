<?
echo "
<table cellpadding=\"8\" cellspacing=\"0\" border=\"0\" width=\"".$theme['content_width']."\" class=\"tblborder\" align=\"center\"><tr>
<td colspan=\"4\" class=\"subheader\" align=\"center\">";
echo $post['title'];
echo "</td>
</tr>
<tr>
<div align=\"center\">
<td class=\"post_content\">
";
if($post['image'] && $post['image'] != "null"){
$sql2 = "SELECT * FROM images WHERE gid = '".$post['image']."';";
$query2 = $database->query($sql2);
$image = $database->fetch_array($query2);
echo "<img src=\"images/".$image['filename']."\" style=\"float:".$post['float'].";\" alt=\"".$image['alt']."\">";
}
$post['content'] = parse($post['content']);
echo $post['content'];
echo "<BR><BR>";
if($settings['showeditedby'] == "1"){
if($post['edit_uid'] > 0){
$sql9 = "SELECT * FROM `users` WHERE `uid` = '".$post['edit_uid']."'";
$query9 = $database->query($sql9);
$user = $database->fetch_array($query9);
$result=$database->query ("SELECT UNIX_TIMESTAMP(edit_date) as epoch_time FROM blog WHERE pid = '".$post['pid']."'");
$datedate = $database->fetch_array($result);
$datedate = $datedate[0];
$datedate = strtotime($settings['timeoffset']." hours",$datedate);
$datedate = date($settings['dateformat']." ".$settings['timeformat'],$datedate);
echo "<div style=\"font-size:9px; color:#333333;\" align=\"right\"><i>
Edited by ".$user['username']." at ".$datedate."</i></div><BR>";
}
}
$findauthorquery = $database->query("SELECT * FROM users WHERE uid = '".$post['uid']."'");
$author = $database->fetch_array($findauthorquery);
$result=$database->query ("SELECT UNIX_TIMESTAMP(date_time) as epoch_time FROM blog WHERE pid = '".$post['pid']."'");
$datedate = $database->fetch_array($result);
$post['date_time'] = $datedate[0];
$post['date_time'] = strtotime($settings['timeoffset']." hours",$post['date_time']);
$post['date_time'] = date($settings['dateformat']." ".$settings['timeformat'],$post['date_time']);
echo "Written by ".$author['username']." at ".$post['date_time']." <a href=\"showpost.php?id=".$post['pid']."\">Permalink</a>";
echo "</td></div></tr></table>";
echo "<BR>";
?>