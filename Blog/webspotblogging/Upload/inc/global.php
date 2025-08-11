<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
session_start();

require $path."inc/config.inc.php";
require $path."inc/mysql.php";
require $path."inc/functions.php";

$database = new database;

$database->connect($config['hostname'], $config['username'], $config['password']);
$database->select($config['database']);

require $path."inc/settings.inc";
$query = $database->query("SELECT * FROM theme WHERE using_now = '1' LIMIT 1");
$theme = $database->fetch_array($query);
?>