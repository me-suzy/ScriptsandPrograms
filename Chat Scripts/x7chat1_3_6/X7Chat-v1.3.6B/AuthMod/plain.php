<?
/////////////////////////////////////////////////////////////// 
//							 							     //
//		X7 Chat Version 1.3.0 Beta		   				     //          
//		Released February 2, 2004		     				 //
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

function doXEncrypt($password){
	return $password;
}

function changePass($password,$username){
	global $SERVER;
	$password = doXEncrypt($password);
	DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET password='$password' WHERE username='$username'");
}

function getPass($username){
	global $SERVER;
	$q = DoQuery("SELECT password FROM $SERVER[TBL_PREFIX]users WHERE username='$username'");
	$pass = Do_Fetch_Row($q);
	return $pass[0];
}
// Some Configuration Stuff
$AUTH['CAN_REG'] = 1;
$AUTH['REG_NOTICE_HEADER'] = "Please Register Elsewhere";
$AUTH['REG_NOTICE'] = "You must be registered to use this feature";
$AUTH['COOKIE_USERNAME'] = "X2CHATU";
$AUTH['COOKIE_PASSWORD'] = "X2CHATP";

$changevars['UE'] = 0;

?> 

