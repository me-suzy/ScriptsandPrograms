<?php

$your_UIN="ENTER YOUR UIN";
$your_pass="ENTER YOUR PASSWORD";
	
require ("php_messenger.php"); 				// Include PHP MESSENGER


	
$pm=new PM_ICQ();              				// Create ICQ object
	
$pm->cfg['Debug_Mode']=0;    				// debug mode for print packets
$pm->cfg['Show_Messages']=1; 				// print encoming/outgoing messages
$pm->cfg['Show_Errors']=1;   				// print errors


	
if ($pm->login($your_UIN,$your_pass))   		// Try to login
{
	if ($pm->Send_SMS("+12345678900","It's test!\r\nSorry!"))
	{
		echo "SMS was sent!<br>";
	}else
	{
		echo "Unable to send SMS!<br>";
	}
//	$pm->Send_SMS("+12345678900",iconv("CP1251","UTF-8","à¨¢¥â!")); //for international languages
	while ($pm->connection->Get_Next_Packet(1)) {}
	$pm->Off_Line();
}else
{
	echo "Can't connect!";
}

?>
