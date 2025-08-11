<?php

/*
ShoutPro 1.0 - include.php
ShoutPro is released under the GNU General Public Liscense.  A full copy of this license is included with this distribution under the file LICENSE.TXT.  By using ShoutPro or the source code, you acknowledge you have read and agree to the license.

This file is include.php.  It is required to run ShoutPro, calling the settings and functions and using IP banning.  There is no need to modify anything in this file.  All modifications should be done in the file config.php.
*/

include("config.php");
include("functions.php");
if ($path){
	$ips = file("$path/lists/bannedips.php");
} else {
	$ips = file("lists/bannedips.php");
}
if (in_array($REMOTE_ADDR,$ips)) {   
	echo($bannedmessage);
	die;
}
?>