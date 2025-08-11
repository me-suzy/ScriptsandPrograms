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
?>
<?
if(@$page != "update"){
$isbase = "set";
require("config.php");
}

if(!isset($page)){
	print("Error, no page specified");
	exit;
}

if($page == "top"){

	if(!@include("frames/new.top.php")){
		echo "Error, Top frame not found in frames directory";
	}

}elseif($page == "left.middle"){

	if(!@@include("frames/new.left.middle.php")){
		echo "Error, Top frame not found in frames directory";
	}

}elseif($page == "right.middle"){

	if(!@include("frames/new.right.middle.php")){
		echo "Error, Top frame not found in frames directory";
	}

}elseif($page == "left.bottom"){

	if(!@include("frames/new.left.bottom.php")){
		echo "Error, Top frame not found in frames directory";
	}

}elseif($page == "right.bottom"){

	if(!@include("frames/new.right.bottom.php")){
		echo "Error, Top frame not found in frames directory";
	}

}elseif($page == "send"){

	if(!@include("frames/send.php")){
		echo "Error, Top frame not found in frames directory";
	}

}elseif($page == "update"){

	if(!@include("frames/update.php")){
		echo "Error, Top frame not found in frames directory";
	}

}



?> 
