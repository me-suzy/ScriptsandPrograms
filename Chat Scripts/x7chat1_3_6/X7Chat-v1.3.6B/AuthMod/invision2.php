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
require("../../conf_global.php");
}else{
require("../conf_global.php");
}

// Initialize IB 2 information

// Check if they are logged in on the IB
if(isset($_COOKIE['member_id']) && @$_COOKIE['member_id'] != 0){
	// Yes they are logged in, do a cookie transfer
	$uid = intval($_COOKIE['member_id']);
	$_COOKIE['X2CHATP'] = $_COOKIE['pass_hash'];
	mysql_connect($INFO['sql_host'],$INFO['sql_user'],$INFO['sql_pass']);
	mysql_select_db($INFO['sql_database']);
	$q = mysql_query("SELECT name,member_login_key FROM {$INFO[sql_tbl_prefix]}members WHERE id='$uid'");
	$row = mysql_fetch_row($q);
	$_COOKIE['X2CHATU'] = $row[0];
	$ib2_member_login_key = $row[1];

	// Grab password information
	$query = mysql_query("SELECT converge_pass_salt,converge_pass_hash FROM {$INFO[sql_tbl_prefix]}members_converge WHERE converge_id=$uid");
	echo mysql_error();
	$row = mysql_fetch_row($query);
	$ib2_salt = $row[0];
	$ib2_pash_hash = $row[1];
	
	if($ib2_member_login_key == $_COOKIE['X2CHATP']){
		$_COOKIE['X2CHATP'] = $ib2_pash_hash;
	}else{
		$_COOKIE['X2CHATU'] = "";
		$_COOKIE['X2CHATP'] = "";
	}
	
	mysql_close();
}

function init_by_username($username){
	global $uid,$ib2_salt,$ib2_pash_hash, $INFO, $DATABASE;
	mysql_close();
	mysql_connect($INFO['sql_host'],$INFO['sql_user'],$INFO['sql_pass']);
	mysql_select_db($INFO['sql_database']);
	$q = mysql_query("SELECT id FROM {$INFO[sql_tbl_prefix]}members WHERE name='$username'");
	$row = mysql_fetch_row($q);
	$uid = $row[0];
	$query = mysql_query("SELECT converge_pass_salt,converge_pass_hash FROM {$INFO[sql_tbl_prefix]}members_converge WHERE converge_id='$uid'");
	$row = mysql_fetch_row($query);
	$ib2_salt = $row[0];
	$ib2_pash_hash = $row[1];
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
}

function doXEncrypt($password){
	global $ib2_salt, $X2CHATU;
	if($ib2_salt == ""){
		init_by_username($X2CHATU);
	}
	$password = md5(md5($ib2_salt).md5($password));
	return $password;
}

function changePass($password,$username){
	global $DATABASE, $INFO, $uid;
	mysql_close();
	mysql_connect($INFO['sql_host'],$INFO['sql_user'],$INFO['sql_pass']);
	mysql_select_db($INFO['sql_database']);
	$password = doXEncrypt($password);
	mysql_query("UPDATE {$INFO[sql_tbl_prefix]}members_converge SET converge_pass_hash='$password' WHERE converge_id='$uid'");
	mysql_close();
	DoConnect($DATABASE['HOST'],$DATABASE['USER'],$DATABASE['PASS']);
	DoSelectDb($DATABASE['DATABASE']);
}

function getPass($username){
	global $ib2_pash_hash, $DATABASE, $SERVER, $INFO, $ib2_salt, $X2CHATU;
	if(@$ib2_pash_hash == ""){
		init_by_username($X2CHATU);
	}
	$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users WHERE username='$username'");
	$row = Do_Fetch_Row($q);
	if($row[0] == "" && $_COOKIE['X2CHATP'] == $ib2_pash_hash){
		DoQuery("INSERT INTO $SERVER[TBL_PREFIX]users VALUES('0','$username','','','1','','','','','','','','','14000,5000,1,1,0,3,1,0,0,1')");
	}
	return $ib2_pash_hash;
}

// Some Configuration Stuff
$AUTH['CAN_REG'] = 0;
$AUTH['REG_NOTICE_HEADER'] = "Error";
$AUTH['REG_NOTICE'] = "Please use your Invision Board 2.0 Account to login.";
$AUTH['COOKIE_USERNAME'] = "X2CHATU";
$AUTH['COOKIE_PASSWORD'] = "X2CHATP";

$changevars['UE'] = 1;
$txt[14] = "";

?> 

