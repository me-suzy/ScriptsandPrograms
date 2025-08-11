<?php

//   Now this example works with msn_sample@php-messenger.com.
//   You can talk to him right now



$your_email="ENTER YOUR EMAIL";
$your_pass="ENTER YOUR PASSWORD";

ignore_user_abort(1);
	
require ("php_messenger.php"); 				// Include PHP MESSENGER
	
$pm=new PM_MSN();              				// Create MSN object
	
$pm->cfg['Debug_Mode']=0;    				// debug mode for print packets
$pm->cfg['Show_Messages']=0; 				// print encoming/outgoing messages
$pm->cfg['Show_Errors']=0;   				// print errors
	
if ($pm->login($your_email,$your_pass))   		// Try to login
{
	while ($in_message=$pm->Read_Message(-1)) 	// reading incomming message
	{
	 	//try to replay
		if ($pm->Send_Message_Confirm($in_message['UIN'],"You wrote:\r\n".$in_message['message_text']))
		{
			echo "Message to {$in_message['UIN']} was sent!<br>";
		}else
		{
			echo "Can't send message to {$in_message['UIN']}!<br>";
		}
		$pm->User_Off_Line($in_message['UIN']); // close SB session
		if (preg_match("/exit/i",$in_message['message_text'])) // exit when message contain "exit"
		{
			$pm->Off_Line();
			exit;
		}
		flush();
	}
}else
{
	echo "Can't connect!";
}

?>
