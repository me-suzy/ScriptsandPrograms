<?
ob_start();
header("Content-Type: text/xml\n");
$_SERVER['PHP_SELF'] = str_replace("/rss.php","",$_SERVER['PHP_SELF']);
echo "<?xml version=\"1.0\""." encoding=\"utf-8\"?>";
include("inc/global.php");
$sql = "SELECT * FROM blog ORDER BY date_time DESC LIMIT ".$settings['numberrss'];
$query = $database->query($sql);
echo "	<rss version=\"2.0\">
	<channel>
		<title>".$settings['blogname']."</title>
		<description>".$settings['blogname']." -- Latest Updates</description>
		<generator>WebspotBlogging -- http://blogging.webspot.co.uk/</generator>
		<link>http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."</link>
";

while ($post = mysql_fetch_array($query)){
echo "
<item>
<title>".$post['title']."</title>
";
$sql1 = "SELECT * FROM users WHERE uid = '".$post['uid']."' LIMIT 1;";
$query1 = $database->query($sql1);
$user = $database->fetch_array($query1);
echo "
<author>".$user['username']."</author>
<description>
<![CDATA[
".$post['content']."
]]>
</description>";
echo "<link>http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."/showpost.php?id=".$post['pid']."</link>
</item>";
}

echo "</channel>
</rss>";
ob_end_flush();
?>