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
$xoopsOption['nocommon'] = 1;
if($isbase == "notset"){
require("../../../mainfile.php");
}else{
require("../../mainfile.php");
}

// Handle xoop login data
@DoConnect(XOOPS_DB_HOST,XOOPS_DB_USER,XOOPS_DB_PASS);
@DoSelectDb(XOOPS_DB_NAME);
$table_prefix = XOOPS_DB_PREFIX."_";

if(isset($_COOKIE["PHPSESSID"])){
	$cvalue = $_COOKIE["PHPSESSID"];
	$q = DoQuery("SELECT sess_data FROM {$table_prefix}session WHERE sess_id='$cvalue'");
	$cinfo = Do_Fetch_Row($q);
	if($cinfo[0] != ""){
		// Get user ID
		eregi("^xoopsUserId|[^;]*",$cinfo[0],$match);
		$match[0] = eregi_replace("xoopsUserID\|","",$match[0]);
		$suid = unserialize($match[0]);
		
		$q = DoQuery("SELECT uname,pass FROM {$table_prefix}users WHERE uid='$suid'");
		$xoopsname = Do_Fetch_Row($q);
		unset($doxlogin);
		@setcookie("X2CHATU",$xoopsname[0],time()+14000000,"$SERVER[PATH]");
		@setcookie("X2CHATP",$xoopsname[1],time()+14000000,"$SERVER[PATH]");
		$_COOKIE['X2CHATU'] = $xoopsname[0];
		$_COOKIE['X2CHATP'] = $xoopsname[1];
		
		DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
		DoSelectDb($DATABASE['DATABASE']);
	
		$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$xoopsname[0]'");
		$row = Do_Fetch_Row($q);
		if($row[0] == ""){
			DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users VALUES('0','$xoopsname[0]','','','1','','','','','','','','','14000,1000,1,1,0,3,1,0,0,1')");
		}
	}
}

@mysql_close();

function doXEncrypt($password){
	$password = md5($password);
	return $password;
}

function changePass($password,$username){
	global $table_prefix, $DATABASE;
	@DoConnect(XOOPS_DB_HOST,XOOPS_DB_USER,XOOPS_DB_PASS);
	@DoSelectDb(XOOPS_DB_NAME);
	
	$password = doXEncrypt($password);
	DoQuery("UPDATE {$table_prefix}users SET pass='$password' WHERE uname='$username'");

	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
}

function getPass($username){
	global $table_prefix, $DATABASE;
	@DoConnect(XOOPS_DB_HOST,XOOPS_DB_USER,XOOPS_DB_PASS);
	@DoSelectDb(XOOPS_DB_NAME);
	
	$q = DoQuery("SELECT pass FROM {$table_prefix}users WHERE uname='$username'");
	$pass = Do_Fetch_Row($q);
	
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
	
	if($pass[0] == ""){
		$q = DoQuery("SELECT email,password FROM $SERVER[TBL_PREFIX]users WHERE username='$username'");
		$row = Do_Fetch_Row($q);
		if($row[0] == "Guest")
			$pass[0] = $row[1];
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

