<?
///////////////////////////////////////////////////////////////
//	X7 Chat Custom AuthMod File
//	Created: Fri, 26 Mar 2004 13:48:21 -0500
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
require("../../config.php");
}else{
require("../config.php");
}

$xmb_user = $dbuser;             
$xmb_password = $dbpw;
$xmb_db = $dbname;
$xmb_host = $dbhost;
$xmb_prefix = $tablepre;


// STOP EDITING HERE

@DoConnect("$xmb_host","$xmb_user","$xmb_password");
@DoSelectDb("$xmb_db");

if($HTTP_COOKIE_VARS['xmbuser'] != ""){
$_COOKIE['X2CHATU'] = $HTTP_COOKIE_VARS['xmbuser'];
$_COOKIE['X2CHATP'] = $HTTP_COOKIE_VARS['xmbpw'];
}

function doXEncrypt($password){
	$password = md5($password);
	return $password;
}



function changePass($password,$username){
	global $DATABASE,$xmb_host,$xmb_user,$xmb_password,$xmb_db,$xmb_prefix;
	mysql_close();
	@DoConnect("$xmb_host","$xmb_user","$xmb_password");
	@DoSelectDb("$xmb_db");
	$password = doXEncrypt($password);
	DoQuery("UPDATE {$xmb_prefix}members SET password='$password' WHERE username='$username'");
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
}



function getPass($username){
	global $DATABASE,$_COOKIE,$SERVER,$xmb_host,$xmb_user,$xmb_password,$xmb_db,$xmb_prefix;
	mysql_close();
	@DoConnect("$xmb_host","$xmb_user","$xmb_password");
	@DoSelectDb("$xmb_db");
	$q = DoQuery("SELECT password FROM {$xmb_prefix}members WHERE username='$username'");
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