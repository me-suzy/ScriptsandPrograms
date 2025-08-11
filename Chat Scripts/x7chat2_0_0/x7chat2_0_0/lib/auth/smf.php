<?PHP
/////////////////////////////////////////////////////////////// 
//
//		X7 Chat Version 2.0.0
//		Released July 27, 2005
//		Copyright (c) 2004-2005 By the X7 Group
//		Website: http://www.x7chat.com
//
//		This program is free software.  You may
//		modify and/or redistribute it under the
//		terms of the included license as written  
//		and published by the X7 Group.
//  
//		By using this software you agree to the	     
//		terms and conditions set forth in the
//		enclosed file "license.txt".  If you did
//		not recieve the file "license.txt" please
//		visit our website and obtain an official
//		copy of X7 Chat.
//
//		Removing this copyright and/or any other
//		X7 Group or X7 Chat copyright from any
//		of the files included in this distribution
//		is forbidden and doing so will terminate
//		your right to use this software.
//	
////////////////////////////////////////////////////////////////EOH
?><?PHP
	// The original SMF AuthMod for version 1 was programmed by Carl C
	// Parts of the original AuthMod were used when converting this to Version 2
	// Borrowed Work: Cookie Handling, Encryption Function
	

	// This file holds data on authentication
	$auth_ucookie = "X7C2U";
	$auth_pcookie = "X7C2P";
	$auth_register_link = "../index.php?action=register";
	$auth_disable_guest = true;
	
	// Get the SMF Configuration File
	include("../Settings.php");
	
	// Make a database connection to the SMF database
	$smfdb = new x7chat_db($db_server,$db_user,$db_passwd,$db_name);
	
	$data = @stripslashes(stripslashes(eregi_replace("&quot;","\"",$_COOKIE[$cookiename])));
	$cookie = unserialize("$data");
	$HTTP_COOKIE_VARS['smf_uc'] = $cookie[0];
	$HTTP_COOKIE_VARS['smf_up'] = $cookie[1];
	
	if($HTTP_COOKIE_VARS['smf_uc'] != ""){
		$password = $smfdb->DoQuery("SELECT memberName,passwd from {$db_prefix}members WHERE ID_MEMBER='$HTTP_COOKIE_VARS[smf_uc]'");
		$password = $smfdb->Do_Fetch_Row($password);
		$HTTP_COOKIE_VARS['smf_uc'] = $password[0];
		$_COOKIE['X7C2U'] = $HTTP_COOKIE_VARS['smf_uc'];
		$_COOKIE['X7C2P'] = $HTTP_COOKIE_VARS['smf_up'];
	}
	
	// Get the key
	if(isset($_COOKIE['X7C2U'])){
		$key = strtolower($_COOKIE['X7C2U']);
	}elseif(isset($_GET['admin_username'])){
		$key = strtolower($_GET['admin_username']);
	}elseif(isset($_POST['username'])){
		$key = strtolower($_POST['username']);
	}else{
		$key = "";
	}
	
	function auth_encrypt($data,$keyx=""){
		global $key;
		if($keyx != "")
			$key = $keyx;
		$key = str_pad(strlen($key) <= 64 ? $key : pack('H*', md5($key)), 64, chr(0x00));
 		return md5(($key ^ str_repeat(chr(0x5c), 64)) . pack('H*', md5(($key ^ str_repeat(chr(0x36), 64)). $data)));
	}
	
	if(isset($_POST['dologin'])){
		$_POST['password'] = auth_encrypt($_POST['password']);
		$key = "ys";
	}
	
	function auth_getpass($auth_ucookie){
		GLOBAL $smfdb,$db_prefix,$txt,$db,$g_default_settings,$prefix,$x7c;
		$query = $smfdb->DoQuery("SELECT passwd FROM {$db_prefix}members WHERE memberName='$_COOKIE[$auth_ucookie]'");
		$password = $smfdb->Do_Fetch_Row($query);
		// Check if they have an X7 Chat account
		if($password[0] != ""){	
			$query = $db->DoQuery("SELECT * FROM {$prefix}users WHERE username='$_COOKIE[$auth_ucookie]'");
			$row = $db->Do_Fetch_Row($query);
			if($row[0] == ""){
				// Create an X7 Chat account for them.
				$time = time();
				$ip = $_SERVER['REMOTE_ADDR'];
				$db->DoQuery("INSERT INTO {$prefix}users (id,username,password,status,user_group,time,settings,hideemail,ip) VALUES('0','$_COOKIE[$auth_ucookie]','$password[0]','$txt[150]','{$x7c->settings['usergroup_default']}','$time','{$g_default_settings}','0','$ip')");
			}
		}
		return auth_encrypt($password[0],"ys");
	}
	
	function change_pass($user,$newpass){
		GLOBAL $db_prefix,$smfdb;
		$newpass = auth_encrypt($newpass,strtolower($user));
		$query = $smfdb->DoQuery("UPDATE {$db_prefix}members SET passwd='$newpass' WHERE memberName='$user'");
	}
	
?>
