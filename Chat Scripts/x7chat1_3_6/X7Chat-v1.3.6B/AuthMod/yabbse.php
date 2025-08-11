<?
///////////////////////////////////////////////////////////////
//	X7 Chat Custom AuthMod File
//	Created: Fri, 16 Apr 2004 17:18:14 -0400
//	Copyright (c) 2004 By the X7 Group
//	Website: http://www.x7chat.com
//					
//	This program is free software.  You may
//	modify and/or redistribute it under the
//	terms of the included license as written
//	and published by the X7 Group.		
//					
//	By using this software you agree to the
//	terms and conditions set forth in the
//	enclosed file "license.txt".  If you did
//	not recieve the file "license.txt" please
//	visist our website and obtain an official
//	copy of X7 Chat.		           
//						
//	Removing this copyright and/or any other
//	X7 Group or X7 chat copyright from any
//	of the files included in this distribution
//	is forbidden and doing so will terminate
//	your right to use this software.
///////////////////////////////////////////////////////////////

if($isbase == "notset"){
require("../../Settings.php");
}else{
require("../Settings.php");
}

// Decode Cookie
$cookie = unserialize($_COOKIE[$cookiename]);
$HTTP_COOKIE_VARS['yabbse_uc'] = $cookie[0];
$HTTP_COOKIE_VARS['yabbse_up'] = $cookie[1];

mysql_connect("$db_server","$db_user","$db_passwd");
mysql_select_db("$db_name");
if($HTTP_COOKIE_VARS['yabbse_uc'] != ""){
$password = mysql_query("SELECT memberName,passwd from {$db_prefix}members WHERE ID_MEMBER='$HTTP_COOKIE_VARS[yabbse_uc]'");
$password = mysql_fetch_row($password);
$HTTP_COOKIE_VARS['yabbse_uc'] = $password[0];

$_COOKIE['X2CHATU'] = $HTTP_COOKIE_VARS['yabbse_uc'];
$_COOKIE['X2CHATP'] = $HTTP_COOKIE_VARS['yabbse_up'];
}

function yabben($data, $key){
	if (strlen($key) > 64)
		$key = pack('H*', md5($key));
	$key  = str_pad($key, 64, chr(0x00));
	$k_ipad = $key ^ str_repeat(chr(0x36), 64);
	$k_opad = $key ^ str_repeat(chr(0x5c), 64);
	return md5($k_opad . pack('H*', md5($k_ipad . $data)));
}

function doXEncrypt($password){
	global $doxlogin;
	
	if(isset($doxlogin)){
		$user = $_POST['X2CHATU'];
	}else{
		$user = $_COOKIE['X2CHATU'];
	}
	
	$password = yabben($password, strtolower($user));
	
	if(isset($doxlogin))
		$password = yabben($password, "ys");

	return $password;
}


function changePass($password,$username){
	global $DATABASE, $db_server, $db_user, $db_passwd, $db_name, $db_prefix;
	mysql_close();
	@DoConnect("$db_server","$db_user","$db_passwd");
	@DoSelectDb("$db_name");
	$password = doXEncrypt($password);
	DoQuery("UPDATE {$db_prefix}members SET passwd='$password' WHERE memberName='$username'");
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
}



function getPass($username){
	global $DATABASE,$_COOKIE,$SERVER, $db_server, $db_user, $db_passwd, $db_name, $db_prefix;
	mysql_close();
	@DoConnect("$db_server","$db_user","$db_passwd");
	@DoSelectDb("$db_name");
	$q = DoQuery("SELECT passwd FROM {$db_prefix}members WHERE memberName='$username'");
	echo mysql_error();
	$pass = Do_Fetch_Row($q);
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
	$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$username'");
	$row = Do_Fetch_Row($q);
	if($row[0] == "" && $_COOKIE['X2CHATP'] == $pass[0]){
		DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users VALUES('0','$username','','','1','','','','','','','','','14000,1000,1,1,0,3,1,0,0,1')");
		echo mysql_error();
	}
	
	$pass[0] = yabben($pass[0],"ys");
	
	return $pass[0];
}



// Some Configuration Stuff
$AUTH['CAN_REG'] = 0;
$AUTH['REG_NOTICE_HEADER'] = "Error";
$AUTH['REG_NOTICE'] = "You must already be registered to use this feature.";
$AUTH['COOKIE_USERNAME'] = "X2CHATU";
$AUTH['COOKIE_PASSWORD'] = "X2CHATP";

$changevars['UE'] = 1;
$txt[14] = "";

?>
