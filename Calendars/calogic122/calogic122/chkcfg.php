<?php

// try to get config info

print "Checking MySQL Library Version, this must be >= 3.23.47<br><br>";
print "Your MySQL Library Version: ".mysql_get_client_info()."<br><br>";

print "Checking MySQL Server Version, this must be >= 4.x<br>Note: This may not work if if there was no previous connection to MySQL<br><br>";
print "Your MySQL Server Version: ".@mysql_get_server_info()."<br><br>";

print "Checking PHP Version, this must be >= 4.3<br>
CaLogic was programed with PHP Version 4.3.2<br><br>";
print "Your PHP Version: ".PHP_VERSION."<br><br><br>";

print "Getting Path Info. This is the path to your Root Directory.<br>
Use this info to set the path to the settings.php file or to use the mini cal plug in.<br><br>";
print "Web Root: ".$HTTP_SERVER_VARS["DOCUMENT_ROOT"]."<br><br><br>";
print "CaLogic Root: ".dirname(__FILE__)."<br><br><br>";

//print "PHP Config File Path: ".get_cfg_var("cfg_file_path")."<br><br>";
//print "PHP magic_quotes_gpc: ".get_magic_quotes_gpc()."<br><br>";
//print "PHP path info: ".$PATH_INFO."<br><br>";
//print "PHP Path Info: ".$PATH_TRANSLATED."<br><br>";
//print "script: ".$SCRIPT_NAME."<br><br>";

/*
$rgio = 0;
$iniar = ini_get("register_globals");

if(is_array($iniar)) {
	print "is array<br>";
} else {
	print "is NOT array<br>";
}

if($iniar != 1) {
	$rgio = 0;
} else {
	$rgio = 1;
}

print "register_globals: = ".$rgio;

*/

/*
$is_session_autostart_on = ini_get('session.auto_start');
if($is_session_autostart_on != 1) {
	$is_session_autostart_on = 0;
} else {
	$is_session_autostart_on = 1;
}

print "AS ".$is_session_autostart_on;
*/

//print "PHP Logo: ".php_logo_guid()."<br><br>";
/*
$iniar = ini_get_all();

foreach($iniar as $k1 => $v1) {
	$inival = $v1;

    print $k1. " Global = ".$inival["global_value"].", Local = ".$inival["local_value"]."<br><br>";
}

//phpinfo()
*/
?>
