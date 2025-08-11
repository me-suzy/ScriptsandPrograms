<?
/////////////////////////////////////////////////////////////// 
//							 							     //
//		X7 Chat Version 1.3.1 Beta		   				     //          
//		Released February 13, 2004		     				 //
//		Copyright (c) 2004 By the X7 Group	    			 //
//		Website: http://www.x7chat.com		     			 //
//							   							     //
//		This program is free software.  You may	     		 //
//		modify and/or redistribute it under the	    		 //
//		terms of the included license as written    		 //
//		and published by the X7 Group.		    			 //
//							   							     //
//		By using this software you agree to the	    		 //
//		terms and conditions set forth in the	    		 //
//		enclosed file "license.txt".  If you did     		 //
//		not recieve the file "license.txt" please    	     //
//		visist our website and obtain an official    		 // 
//		copy of X7 Chat.		           				     //
//							    							 //
//		Removing this copyright and/or any other    		 //
//		X7 Group or X7 chat copyright from any	    		 //
//		of the files included in this distribution  		 //
//		is forbidden and doing so will terminate    		 //
//		your right to use this software.	     			 //
//							     							 //
/////////////////////////////////////////////////////////////// 

$donotincluebase = 1;
if($isbase == "notset"){
require("../../config.php");
}else{
require("../config.php");
}

// Handle Nuke Database Data
$nuke['DBHOST'] = $dbhost;
$nuke['UNAME'] = $dbuname;
$nuke['PWORD'] = $dbpass;
$nuke['DBNAME'] = $dbname;
$nukepre = $prefix."_";


// Handle Nuke login data
$cookie = $HTTP_COOKIE_VARS['user'];
$cookie = base64_decode($cookie);
$cookie = explode(":", $cookie);
$_COOKIE['X2CHATU'] = $cookie[1];
$_COOKIE['X2CHATP'] = $cookie[2];

function doXEncrypt($password){
	$password = md5($password);
	return $password;
}

function changePass($password,$username){
	global $nukepre,$nuke,$DATABASE;
	mysql_close();
	mysql_connect($nuke['DBHOST'],$nuke['UNAME'],$nuke['PWORD']);
	mysql_select_db($nuke['DBNAME']);
	$password = doXEncrypt($password);
	DoQuery("UPDATE {$nukepre}users SET user_password='$password' WHERE username='$username'");
	echo mysql_error();
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
}

function getPass($username){
	global $nukepre,$nuke,$DATABASE,$SERVER,$_COOKIE;
	mysql_close();
	mysql_connect($nuke['DBHOST'],$nuke['UNAME'],$nuke['PWORD']);
	mysql_select_db($nuke['DBNAME']);
	$q = DoQuery("SELECT user_password FROM {$nukepre}users WHERE username='$username'");
	echo mysql_error();
	$pass = Do_Fetch_Row($q);
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
	$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$username'");
	$row = Do_Fetch_Row($q);
	if($row[0] == "" && $_COOKIE['X2CHATP'] == $pass[0]){
		DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users VALUES('0','$username','','','1','','','','','','','','','14000,1000,1,1,0,3,1,0,0,1')");
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

