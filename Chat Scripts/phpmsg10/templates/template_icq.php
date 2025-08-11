<?php

//   Now this example works with UIN 304954521.
//   You can talk to him right now



$your_UIN="ENTER YOUR UIN";
$your_pass="ENTER YOUR PASSWORD";
	
ignore_user_abort(1);
	
require ("php_messenger.php"); 				// Include PHP MESSENGER
	
$pm=new PM_ICQ();              				// Create ICQ object
	
$pm->cfg['Debug_Mode']=0;    				// debug mode for print packets
$pm->cfg['Show_Messages']=0; 				// print encoming/outgoing messages
$pm->cfg['Show_Errors']=0;   				// print errors
	
if ($pm->login($your_UIN,$your_pass))   		// Try to login
{
	while ($in_message=$pm->Read_Message(-1)) 	// reading incomming message
	{
		if ($in_message['online'])
		{
			// it's online message
			// replay including original text
			$pm->Send_Message($in_message['UIN'],"You wrote:\r\n".$in_message['message_text']);
		}else
		{
			// it's offline message
			// replay including original text with date/time
			$pm->Send_Message($in_message['UIN'],"{$in_message['year']}-{$in_message['month']}-{$in_message['day']} ({$in_message['hour']}:{$in_message['minutes']}) you wrote:\r\n".$in_message['message_text']);
		}
		if (preg_match("/exit/i",$in_message['message_text'])) // exit when message contain "exit"
		{
			$pm->Off_Line();
			exit;
		}
	}
}else
{
	echo "Can't connect!";
}

?>
