<?php
require("../../includes/global.php");

// check for the version info
$sql = "SELECT * FROM " . $dbprefix . "config WHERE config_name = 'versionint'";
$rec = $db->execute($sql);
if ($rec->rows > 0){
	die("You are not running version 1.0.0");
}

// run the update SQL
$sql = "UPDATE " . $dbprefix . "config SET config_value = '1.0.1', config_info = '' WHERE config_name = 'version'";
$db->execute($sql);

$sql = "INSERT INTO " . $dbprefix . "config (config_name, config_value) VALUES ('versionint', '2')";
$db->execute($sql);

// and finish
echo("Finished upgrade to latest version!");
?>