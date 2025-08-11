<? 
/*
This is TigerTom's Chat Room Software (TTChat).

http://www.tigertom.com
http://www.ttfreeware.com

Copyright (c) 2005 T. O' Donnell

Released under the GNU General Public License, with the
following proviso: 

That the HTML of hyperlinks to the authors' websites
this software generates shall remain intact and unaltered, 
in any version of this software you make.
 
If this is not strictly adhered to, your licence shall be 
rendered null, void and invalid.
*/

include("config.php");

// enters a new user to the chatroom
function enterchat($user, $pass) {
	
	global $admin_list;
	$adminlevel = 0;
	$errormsg = "";
	// check if the username isn´t too short, if it is then set error message
	if (strlen($user) < min_user_len) {
		$errormsg = username_tooshort_msg;
	} elseif (strlen($user) > max_user_len) { // check if the username isn´t too long, if it is then set error message
		$errormsg = username_toolong_msg;
	} else {
		// check if the username chosen is not already taken
		if ($errormsg=="") {
			if (file_exists(chat_db_folder."/".users_text_file)) {
				$arrusers = fileread(users_text_file) or die("Can´t read the user text file");
				$users_inchat = count($arrusers);
				if ($users_inchat >= max_user_count)  {
					$errormsg = toomany_users_msg;
				} else {
					for ($i = 0; $i < $users_inchat; $i++) {
						$arr_user_data = explode("|", $arrusers[$i]);
						if ($user == $arr_user_data[0]) { // if it is then set error message
							$errormsg = username_taken_msg;
						}
					}
				}
			}
			if (array_key_exists($user, $admin_list)) {
				if ($admin_list[$user] == $pass) {
					$adminlevel = 1;
				} else {
					$errormsg = username_taken_msg;
				}
			}
		}
	}
	if ($errormsg!="") { return $errormsg; } else { adduser($user, $pass, $adminlevel); };
}

// reads the file $wichfile and returns its results in an array divided by the splitter character
function fileread($wichfile, $splitter = "\n") {
	$buffer = "";
	if (file_exists(chat_db_folder."/".$wichfile)) {
		$fp = fopen(chat_db_folder."/".$wichfile, 'r');
		while (!feof($fp)) {
			$buffer .= fgets($fp, 1024);
		}
		return explode($splitter, $buffer);
	} else {
		return NULL;
	}
}

// opens $thefile for $mode and writes $what into it
function writefile($thefile, $mode, $what) {
	$userfile = fopen(chat_db_folder."/".$thefile, $mode);
	fwrite($userfile, $what);
	fclose($userfile);
}

// adds a new user to the system
function adduser($usertowrite, $passtowrite, $isadmin = "0") {
	setcookie("chatusername", $usertowrite, time()+3600);
	$userip = $_SERVER['REMOTE_ADDR'];
	$userdata = "$usertowrite|$passtowrite|$userip|$isadmin|0|".time()."\n";
	writefile(users_text_file, 'a', $userdata);
	sendmsg("$usertowrite",user_in_msg, "exclamation.gif", "<div><b>", "</div></b>");
	header("Location: chatroom.php");
}

// updates the time the $usertoupdate posted his last message in the chat
function updateuser($usertoupdate, $banned = 0) {
	setcookie("chatusername", $usertoupdate, time()+3600);
	$arrusers = fileread(users_text_file);
	$newuserdata = "";
	$txtnewusers = "";
	for ($i = 0; $i < count($arrusers); $i++) {
		$olduserdata = explode("|", $arrusers[$i]);
		if ($olduserdata[0] == $usertoupdate) {
			$olduserdata[4] = $banned;
			$olduserdata[5] = time();
			$arrusers[$i] = implode("|", $olduserdata);
		}
		if ($arrusers[$i]!="") $txtnewusers .= "$arrusers[$i]\n";
	}
	writefile(users_text_file, 'w', $txtnewusers);
}

// adds the $wichone user to the ignored users list hiding his input in the messages frame
function ignoreuser($wichone) {
	if (!isset($_COOKIE['chatignoreusers'])) {
		setcookie("chatignoreusers", $wichone);
	} else {
		$alreadyignored = false;
		$arrignore = explode("|", $_COOKIE['chatignoreusers']);
		if (in_array($wichone, $arrignore)) $alreadyignored = true;
		if (!$alreadyignored) {
			$arrignore[] = $wichone;
			$newtoignore = implode("|", $arrignore);
			setcookie("chatignoreusers", $newtoignore);
		}
	}
}

// checks to see if the user is loged in
function userinchat() {
	$userinchat = false;
	if (isset($_COOKIE['chatusername'])) {
		$theuser = ($_COOKIE['chatusername']!="") ? $_COOKIE['chatusername'] : "";
		if ($theuser!="") {
			$arrusers = fileread(users_text_file);
			for ($i = 0; $i < count($arrusers); $i++) {
				$userdata = explode("|", $arrusers[$i]);
				if ($userdata[0]==$theuser) {
					$userip = $_SERVER['REMOTE_ADDR'];
					if ($userip==$userdata[2]) $userinchat = true;
				}
			}
		}
	}
	return $userinchat;
}

// checks to see if the user has been banned for using bad language
function userbanned() {
	$banned = false;
	if (isset($_COOKIE['chatusername'])) {
		$theuser = ($_COOKIE['chatusername']!="") ? $_COOKIE['chatusername'] : "";
		if ($theuser!="") {
			$arrusers = fileread(users_text_file);
			for ($i = 0; $i < count($arrusers); $i++) {
				$userdata = explode("|", $arrusers[$i]);
				if ($userdata[0]==$theuser) {
					$bannedstate = $userdata[4];
					$bannedtime = $userdata[5];
					$actualtime = time();
					if (($actualtime - $bannedtime) >= banned_cookie_len) {
						updateuser($theuser);
					} else {
						$banned = ($bannedstate==1) ? true : false;
					}
				}
			}
		}
	}
	return $banned;
}

// allows the $wichuser user again, so his messages will be showed again in the messages frame
function allowuser($wichuser) {
	if (isset($_COOKIE['chatignoreusers'])) {
		$ignoreusers = "";
		$newtoignore = array();
		$arrignored = explode("|", $_COOKIE['chatignoreusers']);
		for ($i = 0; $i < count($arrignored); $i++) {
			if ($arrignored[$i]!=$wichuser) $newtoignore[] = $wichuser;
		}
		$ignoreusers = implode("|", $newtoignore);
		setcookie('chatignoreusers', $ignoreusers);
	}
}

// returns a "|" separated list of all the users online
function usersonline() {
	$arrusers = fileread(users_text_file);
	$userlines = count($arrusers);
	$arrinchat = array();
	for ($j = 0;  $j < $userlines; $j++) {
		$arruserdata = explode("|", $arrusers[$j]);
		if ($arruserdata[0]!="") $arrinchat[] = $arruserdata[0];
	}
	$usersinchat = implode("|", $arrinchat);
	return $usersinchat;
}

// removes bad words and special characters from the $what message
function cleanup($what) {
	global $bad_words;
	$badwords = false;
	for ($i = 0; $i < count($bad_words); $i++) {
		$badlanguage = strpos($what, $bad_words[$i], 0);
		if ($badlanguage===false) {
		} else {
			$badwords = true;
		}
	}
	if ($badwords) {
		setcookie("chatuserbanned", "YES", time() + banned_cookie_len);
		$msg = banned_user_msg;
	} else {
		$msg = strip_tags($what);
		$msg = str_replace ("|", " ", $msg);
		$msg = str_replace ("'", " ", $msg);
		$msg = str_replace ("<", " ", $msg);
		$msg = str_replace (">", " ", $msg);
		$msg = str_replace ("[", "<", $msg);
		$msg = str_replace ("]", ">", $msg);
		$msg = stripslashes ($msg);
	}
	return $msg;
}

// writes a line to the chat_text_file with the user´s message
function sendmsg($from, $msg, $smile = "", $formatstart = "", $formatend = "") {
	$chatlines = 0;
	$newmsg = cleanup($msg);
	$chatted = "$from|$newmsg|$smile|$formatstart|$formatend\n";
	$oldchat = fileread(chat_text_file);
	if (!is_null($oldchat)) {
		$chatlines = count($oldchat);
		if ($chatlines >= max_chat_lines) $chatlines = max_chat_lines - 1;
		for ($i=0;  $i < $chatlines; $i++) {
			if ($oldchat[$i]!="") $chatted .= "$oldchat[$i]\n";
		}
	}
	writefile(chat_text_file, 'w', $chatted);
	if ($from!="") {
		$userbanned = ($newmsg == banned_user_msg) ? 1 : 0;
		updateuser($from, $userbanned);
		if ($userbanned) header("Location: chat_form.php?username=$from");
	}
}

// displays the contents of the chat_text_file in the messages window
function showchat() {
	$arrignoreusers = array();
	$ignoreusers = false;
	if (isset($_COOKIE['chatignoreusers'])) { // check if i have to ignore some users
		$arrignoreusers = explode("|", $_COOKIE['chatignoreusers']);
		$ignoreusers = true;
	}
	$arrchatted = fileread(chat_text_file); // get the contents of the chat
	if (!is_null($arrchatted)) {
		$chatlines = count($arrchatted);
		$msgtowrite = "";
		$usersinchat = "";
		$updateuserslist = false;
		if (users_refresh_rate==0) $usersinchat = usersonline(); // get the users online
		for ($i = 0;  $i < $chatlines; $i++) { // begin loop through the chatted lines
			if (isset($arrchatted[$i])) {
				if (strpos($arrchatted[$i], "|")!==false) {
					$arrmsg = explode("|", $arrchatted[$i]);
					// check to see if i have to reload the users list
					if (users_refresh_rate==0)  {
						if (($arrmsg[1]==user_in_msg)||($arrmsg[1]==user_out_msg)) {
								if ((isset($_COOKIE['chatuserslist']))&&($_COOKIE['chatuserslist']!=$usersinchat)) $updateuserslist = true;
						}
					}
					if ($ignoreusers) { // check to see if i have to filter the messages of the ignored users
						if (($arrmsg[0]!="")&&(!in_array($arrmsg[0], $arrignoreusers))) {
							$msgtowrite .= "$arrmsg[3]<b>$arrmsg[0]</b>";
							if ($arrmsg[2]!="") $msgtowrite .= '&nbsp;<img src="smilies/'.$arrmsg[2].'" border="0" width="20" height="20" align="absmiddle">&nbsp;';
							$msgtowrite .= ": $arrmsg[1]$arrmsg[4]";
						}
					} else {
						$msgtowrite .= "$arrmsg[3]<b>$arrmsg[0]</b>";
						if ($arrmsg[2]!="") $msgtowrite .= '&nbsp;<img src="smilies/'.$arrmsg[2].'" border="0" width="20" height="20" align="absmiddle">&nbsp;';
						$msgtowrite .= ": $arrmsg[1]$arrmsg[4]";
					}
				}
			}
		} // end loop of the chatted lines
		if ($updateuserslist) echo '<script language="JavaScript" type="text/javascript">top.window.frames["chatusers"].window.location.reload();</script>';
		if (users_refresh_rate==0) clearinactiveusers(); // delete inactive users and show the chat content
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><title>'.chat_name.'</title><link rel="STYLESHEET" type="text/css" href="chatstyles.css"><meta name="pragma" content="no-cache"><META HTTP-EQUIV=Refresh CONTENT="'.meta_refresh_rate.'; URL='.$_SERVER['PHP_SELF'].'"></head><body class="chatmsgsarea">'.$msgtowrite.'</body></html>';
	} else {
		echo '<script language="JavaScript" type="text/javascript">top.location.replace("exit.php?username='.$_COOKIE['chatusername'].'");</script>';
	}
}

// deletes inactive members from the userslist after the user_delete_time has passed
function clearinactiveusers() {
	$arrusers = fileread(users_text_file);
	for ($i = 0; $i < count($arrusers); $i++) {
		if ($arrusers[$i]!="") {
			$userdata = explode("|", $arrusers[$i]);
			$usertime = $userdata[5];
			$actualtime = time();
			if (($actualtime - $usertime) >= user_delete_time) exitchat($userdata[0], user_cleared_msg);
		}
	}
}

// displays the list of users in the user list frame
function showusers() {
	if (users_refresh_rate!=0) clearinactiveusers();
	// get the list of the ignored users from my cookie
	if (isset($_COOKIE['chatignoreusers'])) $arrignored = explode("|", $_COOKIE['chatignoreusers']);
	$arrusers = fileread(users_text_file);
	$userlist = "";
	$iam = $_COOKIE['chatusername'];
	$imkicked = true;
	$arronline = array();
	for ($i = 0; $i < count($arrusers); $i++) {
		$userdata = explode("|", $arrusers[$i]);
		if ($userdata[0]!="") {
			$arronline[] = $userdata[0];
			if ($iam==$userdata[0]) {
				$imkicked = false;
				$userlist .= '<div class="itsme">'.$userdata[0].'</div>';
			} else {
				if (isset($arrignored)) {
					if (in_array($userdata[0], $arrignored)) {
						$userlist .= '<div class="chatuser"><a href="chat_users.php?ignore=no&user='.$userdata[0].'" title="Accept this user again"><img src="smilies/smile.gif" alt="" width="20" height="20" vspace="2" border="0" align="right"></a><s>'.$userdata[0].'</s></div>';
					} else {
						$userlist .= '<div class="chatuser"><a href="chat_users.php?ignore=yes&user='.$userdata[0].'" title="Ignore this user"><img src="smilies/ignore.gif" width="20" height="20" vspace="2" border="0" align="right"></a>'.$userdata[0].'</div>';
					}
				} else {
						$userlist .= '<div class="chatuser"><a href="chat_users.php?ignore=yes&user='.$userdata[0].'" title="Ignore this user"><img src="smilies/ignore.gif" width="20" height="20" vspace="2" border="0" align="right"></a>'.$userdata[0].'</div>';
				}
			}
		}
	}
	$usersinchat = implode("|", $arronline);
	setcookie('chatuserslist', $usersinchat);
	if ($imkicked) {
		echo '<script language="JavaScript" type="text/javascript">top.location.replace("./");</script>';
	} else {
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><title>'.chat_name.'</title><link rel="STYLESHEET" type="text/css" href="chatstyles.css"><meta name="pragma" content="no-cache">';
		if (users_refresh_rate!=0) echo '<META HTTP-EQUIV=Refresh CONTENT="'.users_refresh_rate.'; URL='.$_SERVER['PHP_SELF'].'">';
		echo '</head><body class="chatusersarea">'.$userlist.'</body></html>';
	}
}

// exits $usertoexit if it´s set or the user logged in in this machine, out of the chat
function exitchat($usertoexit = "", $message = user_out_msg) {
	$theuser = "";
	if ($usertoexit!="") {
		$theuser = $usertoexit;
	} else {
		if (isset($_COOKIE['chatusername'])) $theuser = $_COOKIE['chatusername'];
	}
	$arrusers = fileread(users_text_file);
	$txtnewusers = "";
	for ($i = 0; $i < count($arrusers); $i++) {
		$userdata = substr($arrusers[$i], 0, strpos($arrusers[$i], "|"));
		if ($userdata == $theuser) $arrusers[$i] = "";
		if ($arrusers[$i]!="") $txtnewusers .= "$arrusers[$i]\n";
	}
	if ($txtnewusers!="") {
		writefile(users_text_file, 'w', $txtnewusers);
		sendmsg($theuser, $message, "exclamation.gif", "<div><b>", "</div></b>");
	} else {
		if (file_exists(chat_db_folder."/".users_text_file)) unlink(chat_db_folder."/".users_text_file);
		if (file_exists(chat_db_folder."/".chat_text_file)) unlink(chat_db_folder."/".chat_text_file);
	}
	if (isset($_COOKIE['chatusername']) && $theuser == $_COOKIE['chatusername']) echo '<script language="JavaScript" type="text/javascript">top.location.replace("./");</script>';
	//header("Location: ./");
}

 ?>