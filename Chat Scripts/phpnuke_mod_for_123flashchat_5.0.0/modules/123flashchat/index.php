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

if (!eregi("modules.php", $PHP_SELF)) {
die ("You can't access this file directly...");
}
$index = 1;
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

include "modules/$module_name/config.php";

$chat_client_root_path = ($chat_client_root_path == "") ? "modules/".$module_name . "/" : $chat_client_root_path;

function loginChat()
{
	global $db, $user_prefix, $HTTP_GET_VARS;

	$LOGIN_SUCCESS = 0;
	$LOGIN_PASSWD_ERROR = 1;
	$LOGIN_NICK_EXIST = 2;
	$LOGIN_ERROR = 3;
	$LOGIN_ERROR_NOUSERID = 4;
	$LOGIN_SUCCESS_ADMIN = 5;
	$LOGIN_NOT_ALLOW_GUEST = 6;
	$LOGIN_USER_BANED = 7;

	$username = isset($HTTP_GET_VARS['username']) ? trim(htmlspecialchars($HTTP_GET_VARS['username'])) : '';
	$username = substr(str_replace("\\'", "'", $username), 0, 25);
	$username = str_replace("'", "\\'", $username);
	$password = isset($HTTP_GET_VARS['password']) ? $HTTP_GET_VARS['password'] : '';
	
	$sql = "SELECT user_password FROM ".$user_prefix."_users ".
		"WHERE username = '" . str_replace("\\'", "''", $username) . "'";
	
	//echo $sql;
	
	if ( !($result = $db->sql_query($sql)) )
	{
		echo $LOGIN_ERROR;
		exit;	
	}
	
	if( $row = $db->sql_fetchrow($result) )
	{

		if( $password == $row['user_password'] )
		{
			echo $LOGIN_SUCCESS;
			exit;
		}
		else if (md5($password) == $row['user_password'])
		{
			echo $LOGIN_SUCCESS;
			exit;			
		}
		else
		{	
			echo $LOGIN_PASSWD_ERROR;
			exit;
		}

	}
	else
	{
		echo $LOGIN_ERROR_NOUSERID;
		exit;
	}	
}

function viewChat()
{
	global $module_name;
	
	
	include("header.php");
	
	?>
	<script language="Javascript" type="text/javascript">
	<!--
		function openChat()
		{
			window.open('modules.php?name=<? echo $module_name; ?>&op=chat', '_123flashchat', 'HEIGHT=476,resizable=yes,WIDTH=634');
		}
	//-->
	</script>	
	<?
	$chatters = getChatters();

	$c_connections = $chatters['connections'];
	$c_rooms = $chatters['room_numbers'];
	$c_logon_users = $chatters['logon_users'];

	$l_chat_user_list = getChatterList();

	OpenTable();
	echo "<div align='center'><a href='http://www.123flashchat.com' onclick='openChat();return false;' onmouseover='window.status=\""._CHAT_NOW."\";return true'><img src='modules/$module_name/images/logo_123.gif' border='0' alt='"._CHAT_NOW."'></a></div>";
	CloseTable();
	echo "<br>";
	OpenTable();

	echo "<b>". _CHAT_TITLE . "</b><br><br>";
	echo "<ul>";
	
	echo "<li>". _CHAT_THEREARE . " <b>" . $c_connections . "</b> "._CHAT_CONNECTIONS;
	echo "<li>". _CHAT_THEREARE . " <b>" . $c_rooms. "</b> ". _CHAT_ROOMS;
	echo "<li>". _CHAT_THEREARE . " <b>" . $c_logon_users . "</b> "._CHAT_LOGON_USERS;
	echo "<li>". _CHAT_USERLIST . " <b>" . $l_chat_user_list . "</b>";
	
	echo "</ul>";
	

	
	CloseTable();	
	
	include("footer.php");
}

/**
 * getting 123 flash chat server data functions --------- begin
 */
function getChatters()
{
	global $extend_chat_server;
	
	if ($extend_chat_server)
	{
		return getChattersFromExtendServer();
	}
	else
	{
		return getChattersFromLocalServer();
	}
}

function getChattersFromExtendServer()
{
	global $chat_client_root_path;

	$room = array();

	$room['connections'] = "<script lanauge=javascript src='".$chat_client_root_path."connections.php'></script>";
	$room['logon_users'] = "<script lanauge=javascript src='".$chat_client_root_path."logon_users.php'></script>";
	$room['room_numbers'] = "<script lanauge=javascript src='".$chat_client_root_path."room_numbers.php'></script>";

	return $room;
}

function getChattersFromLocalServer()
{
	global $chat_data_path;

	$room = array();

	$room['connections'] = 0;
	$room['logon_users'] = 0;
	$room['room_numbers'] = 0;

	$online_file = $chat_data_path."online.txt";

	if (!file_exists($online_file))
	{
		return $room;
	}

	if (!$row = file($online_file))
	{
		return $room;
	}

	$room_data = explode("|", $row[0]);


	if (count($room_data) == 3)
	{
		$room['connections'] = 	intval($room_data[0]);
		$room['logon_users'] = 	intval($room_data[1]);
		$room['room_numbers'] = intval($room_data[2]);
	}

	return $room;
}


function getChatterList()
{
	global $extend_chat_server;
	
	if ($extend_chat_server)
	{
		return getChatterListFromExtendServer();
	}
	else
	{
		return getChatterListFromLocalServer();
	}	
	
}

function getChatterListFromExtendServer()
{
	global $chat_client_root_path;

	$userListStr = "<script lanauge=javascript src='".$chat_client_root_path."user_list.php'></script>";
	return $userListStr;
}

function getChatterListFromLocalServer()
{
	global $chat_data_path;

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
					$userListStr = ($userListStr == "") ? $f_line : $userListStr. "," . $f_line;
				}
			}
			
		}	   	
	   }

	}
	$d->close();

	$userListStr = ($userListStr == "") ? _CHAT_NONE_USER : $userListStr;
	return $userListStr;
}
/**
 * getting 123 flash chat server data functions -------------- end
 */
 
function openChat($user)
{
	global $userinfo,  $swf_file_name, $chat_client_root_path;
	if (is_user($user)) 
	{
    		getusrinfo($user);
		$swf_path = $chat_client_root_path . $swf_file_name . "?init_user=".rawurlencode($userinfo[username])."&init_password=". $userinfo[user_password]."&md5=true&init_root=".$chat_client_root_path;
	}
	else
	{
	    	$swf_path = $chat_client_root_path . $swf_file_name . "?init_root=".$chat_client_root_path;
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.51 Transitional//EN">
<html>
<head>
<title><? echo _CHAT_NOW; ?></title>
</head>
<style>
BODY {	margin:0; }
</style>
<body bgcolor="#FFFFFF">
<div align="center">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="634" height="476">
  <param name=movie value="<? echo $swf_path; ?>">
  <param name=quality value=high>
  <param name=menu value=false>
  <param name=scale value=noscale>
  <embed src="<? echo $swf_path; ?>" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="634" height="476" menu="false" scale="noscale">
  </embed> 
</object>
</div>
</body>
</html>

<?	
	exit;		
}

//echo "op: $op";

switch($op)
{

 	case "login":
	loginChat();
	break;
	
	case "chat":
	openChat($user);
	break;
	
	default:
	viewChat();

}	

?> 
 
