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

// Handle PHPBB login data
@DoConnect($dbhost,$dbuser,$dbpasswd);
@DoSelectDb($dbname);
$q = DoQuery("SELECT config_value FROM {$table_prefix}config WHERE config_name='cookie_name'");
$cname = Do_Fetch_Row($q);


if(isset($_COOKIE["$cname[0]_sid"])){
	$cvalue = $_COOKIE["$cname[0]_sid"];
	$q = DoQuery("SELECT session_user_id,session_logged_in FROM {$table_prefix}sessions WHERE session_id='$cvalue'");
	$cinfo = Do_Fetch_Row($q);
	if($cinfo[0] != ""){
		$suid = $cinfo[0];
		if($cinfo[1] == 1){
			$q = DoQuery("SELECT  username,user_password FROM {$table_prefix}users WHERE user_id='$suid'");
			$phpbbname = Do_Fetch_Row($q);
			unset($doxlogin);
			@setcookie("X2CHATU",$phpbbname[0],time()+14000,"$SERVER[PATH]");
			@setcookie("X2CHATP",$phpbbname[1],time()+14000,"$SERVER[PATH]");
			$_COOKIE['X2CHATU'] = $phpbbname[0];
			$_COOKIE['X2CHATP'] = $phpbbname[1];
			$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$phpbbname[0]'");
			$row = Do_Fetch_Row($q);
			if($row[0] == ""){
				DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users VALUES('0','$phpbbname[0]','','','1','','','','','','','','','14000,1000,1,1,0,3,1,0,0,1')");
			}
		}
	}
}

@mysql_close();

function doXEncrypt($password){
	$password = md5($password);
	return $password;
}

function changePass($password,$username){
	global $table_prefix;
	$password = doXEncrypt($password);
	DoQuery("UPDATE {$table_prefix}users SET user_password='$password' WHERE username='$username'");
}

function getPass($username){
	global $table_prefix;
	$q = DoQuery("SELECT user_password FROM {$table_prefix}users WHERE username='$username'");
	$pass = Do_Fetch_Row($q);
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

