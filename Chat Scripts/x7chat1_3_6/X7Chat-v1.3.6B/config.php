<?
/////////////////////////////////////////////////////////////// 
//							 							     //
//		X7 Chat Version 1.3.3 Beta		   				     //          
//		Released February 29, 2004		     				 //
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
?>
<?
// The following information must be edited before installing.
$DATABASE['HOST'] = "localhost";			// Your database host
$DATABASE['USER'] = "";					// Your database username
$DATABASE['PASS'] = "";					// Your database password
$DATABASE['DATABASE'] = "";				// Your database name
$DATABASE['TYPE'] = "mysql";				// Database type.  Must be mysql
$SERVER['NAME'] = "";					// A short name for your server (less then 10 letters)
$SERVER['TBL_PREFIX'] = "X7Chat_";			// Your database table prefix
$SERVER['PATH'] = "/";					// Use default unless you have cookie problems
$SERVER['LANGUAGE'] = "english";			// Choices: english, dutch, german, spanish, norwegian, french
$SERVER['AUTH'] = "plain";				// Choices: plain, md5 (this CANNOT be changed after install)

if(!isset($donotincluebase)){
@require("base.php");
}
?>
