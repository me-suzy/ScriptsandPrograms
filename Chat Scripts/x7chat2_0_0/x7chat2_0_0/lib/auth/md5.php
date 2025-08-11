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

	// This file holds data on authentication
	$auth_ucookie = "X7C2U";
	$auth_pcookie = "X7C2P";
	$auth_register_link = "";
	$auth_disable_guest = false;
	
	function auth_encrypt($data){
		return md5($data);
	}
	
	function auth_getpass($auth_ucookie){
		GLOBAL $db,$prefix;
		$query = $db->DoQuery("SELECT password FROM {$prefix}users WHERE username='$_COOKIE[$auth_ucookie]'");
		$password = $db->Do_Fetch_Row($query);
		return $password[0];
	}
	
	function change_pass($user,$newpass){
		GLOBAL $db,$prefix;
		$newpass = auth_encrypt($newpass);
		$db->DoQuery("UPDATE {$prefix}users SET password='$newpass' WHERE username='$user'");
	}
	

?>
