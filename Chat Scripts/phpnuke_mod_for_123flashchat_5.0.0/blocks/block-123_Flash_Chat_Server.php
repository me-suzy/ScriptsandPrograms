<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System
/* Module for 123 flash chat server software                            */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2001-2005 by TopCMM 					*/
/* Daniel Jiang (support@123flashchat.com)          			*/
/* http://www.topcmm.com						*/
/* http://www.123flashchat.com						*/
/*									*/
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Before you start using this module,                                  */
/* please read the Readme.txt carefully                                 */
/************************************************************************/

if (eregi("block-Sample_Block.php",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}


define("_CHAT_TITLE","123 Flash Chat Server Module for PHP-Nuke");
define("_CHAT_NOW","Chat Now");
define("_CHAT_USERLIST","Chatting users: ");
define("_CHAT_NONE_USER","None");
define("_CHAT_THEREARE","There are");
define("_CHAT_CONNECTIONS","users connected to the chat server");
define("_CHAT_ROOMS","Chat Rooms");
define("_CHAT_LOGON_USERS","Logon chatters");

include "modules/123flashchat/config.php";

$room = array();

$room['connections'] = 0;
$room['logon_users'] = 0;
$room['room_numbers'] = 0;

$online_file = $chat_data_path."online.txt";

if (!file_exists($online_file))
{
	return false;
}

if (!$row = file($online_file))
{
	return false;
}

$room_data = explode("|", $row[0]);


if (count($room_data) == 3)
{
	$room['connections'] = 	intval($room_data[0]);
	$room['logon_users'] = 	intval($room_data[1]);
	$room['room_numbers'] = intval($room_data[2]);
}

$c_connections = $room['connections'];
$c_rooms = $room['room_numbers'];
$c_logon_users = $room['logon_users'];



$userListStr = "";

$d = dir($chat_data_path);

while (false !== ($entry = $d->read())) 
{
   $rest = substr($entry, 0, 5);
   if ($rest == "room_")
   {
	
	if (file_exists($chat_data_path.$entry))
	{
		
		$f_users = file($chat_data_path.$entry);
		
		for ($i = 0; $i < count($f_users); $i ++)
		{
			$f_line = trim($f_users[$i]);
			
			if ($f_line != "")
			{
				$userListStr = ($userListStr == "") ? $f_line : $userListStr. ", " . $f_line;
			}
		}
		
	}	   	
   }

}
$d->close();

$userListStr = ($userListStr == "") ? _CHAT_NONE_USER : $userListStr;

$content  = "	<script language='Javascript' type='text/javascript'>\n";
$content .= "	<!--\n";
$content .= "		function startChat()\n";
$content .= "		{\n";
$content .= "			window.open(\"modules.php?name=123flashchat&amp;op=chat\", \"_123flashchat\", \"HEIGHT=476,resizable=yes,WIDTH=634\");\n";
$content .= "		}\n";
$content .= "	//-->\n";
$content .= "	</script>\n";

$content .= _CHAT_THEREARE . " <b>" . $c_connections . "</b> "._CHAT_CONNECTIONS;
$content .= "<br><br>". _CHAT_THEREARE . " <b>" . $c_rooms. "</b> ". _CHAT_ROOMS;
$content .= "<br><br>". _CHAT_THEREARE . " <b>" . $c_logon_users . "</b> "._CHAT_LOGON_USERS;
$content .= "<br><br>". _CHAT_USERLIST . " <b>" . $userListStr . "</b>";
$content .= "<br><br>You can open the chat by clicking <a href='http://www.123flashchat.com' onclick='startChat();return false;' onmouseover='window.status=\""._CHAT_NOW."\";return true'>here</a>";


?>