<?
     //////////////////////////////////////////////
    //		Click Counter Deluxe		//
   //        Copyright 2005 Marcus Schwab      //
  //	http://www.noveis.net                 //
 //  Instructions to come	             //
//////////////////////////////////////////////



///// Options /////

$idusers = 1; //Change to 0 if you don't want to record the IP addresses of everyone who goes through
$adminpass = "changeme"; //Set your admin password with no spaces or special characters
$mysqlhost ="localhost"; //Address to your mysql server normally localhost
$mysqllogin = "login"; //The login for your mysql database
$mysqlpassword = "password"; //Password for your mysql database
$mysqldatabase = "database"; //The name of your mysql database

///// Don't Change //////

$xrl = $_GET['xrl'];
$admin = $_GET['admin'];
$id = $_GET['id'];
$delete = $_GET['delete'];
$viewid = $_GET['viewid'];
$db = mysql_connect($mysqlhost, $mysqllogin, $mysqlpassword);
mysql_select_db($mysqldatabase,$db);
if ($xrl) {
$userdomain = $_SERVER["REMOTE_ADDR"];
$result = mysql_query("SELECT id, clicks, url, users FROM sites", $db) or die();
while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
if ($row[2]==$xrl) {
$noex=1;
$row[1]++;
if ($idusers==1) {
$users = array($row[3], $userdomain);
$udusers = implode(",", $users);
} else {
$idusers="n//a";
}
mysql_query("UPDATE sites SET clicks='$row[1]', users='$udusers' WHERE id='$row[0]'", $db) or die(mysql_error());
}
}
if($noex==0)
{
$clicks=1;
if ($idusers==1) {
$userid = $userdomain;
} else {
$idusers="n//a";
}
$sql = "INSERT INTO sites (id, clicks, url, users) VALUES ('$id', '$clicks', '$xrl', '$userid')" or die(mysql_error());
$result = mysql_query($sql) or die(mysql_error());
}
?>
<head>
<meta http-equiv="Refresh" content="0;url=<? echo $xrl; ?>">
</head>
<?
} elseif ($admin==$adminpass) {
echo "<h2>Click Counter Deluxe</h2>";
if ($delete==1) {
mysql_query("DELETE FROM sites WHERE id=$id");
}
if ($viewid) {
echo "<table border=1 width=500><tr><td>IP address for #$id</td></tr><tr>";
$result = mysql_query("SELECT id, clicks, url, users FROM sites WHERE id=$id", $db) or die();
while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
$row[3] = explode(",", $row[3]);
$row[3] = implode(", ", $row[3]);
echo "<td>$row[3]</td></tr></table>";
echo "<br><br>";
}
}
echo "<table border=\"1\">\n<tr>\n<td><strong>ID</strong></td>\n<td><strong>URL</strong></td>\n<td><strong>Clicks</strong></td>\n<td><strong>IPs</strong><td><strgon>Delete</strong></td>\n</tr>\n";
$result = mysql_query("SELECT id, clicks, url, users FROM sites", $db) or die();
while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
$current_url = $_SERVER['PHP_SELF'];
echo "<tr>\n<td>$row[0]</td>\n<td>$row[2]</td>\n<td>$row[1]</td>\n<td><a href=\"$current_url?admin=$admin&amp;viewid=1&amp;id=$row[0]\">View IPs</a></td>\n<td><a href=\"$current_url?admin=$admin&amp;delete=1&amp;id=$row[0]\">delete</a></td>\n</tr>";
}
echo "</table><br><br>Copyright 2005 Marcus Schwab <a href=\"http://noveis.net\" target=\"_blank\">http://noveis.net</a>";
} else {
echo "";
}
?>