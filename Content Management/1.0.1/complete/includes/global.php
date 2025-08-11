<?php
// global.php global include file
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ALL);

// include the basic files
require("config.php");
include("functions.php");
include("database.php");
include("constants.php");
include("usersys.php");

// connect to the database
if (!$dbname){ die("No database information - please edit config.php"); }
$db = new Database($dbhost, $dbuser, $dbpass, $dbname);

// do the user system
$usr = New Usersys;
StartSession();
$usr->Auth(0);

// extract configuration from db
$config = Array();
$sql = "SELECT * FROM " . $dbprefix . "config";
$result = $db->execute($sql);
if ( !($result = $db->execute($sql)) )
	{ Die("Could not query config table");
} else {
	do{
		// put config into array
		$config[$result->fields["config_name"]] = $result->fields["config_value"];
	} while($result->fields = mysql_fetch_array($result->res));
}

// set up some variables, etc
$skin = $config["defaultskin"];
?>