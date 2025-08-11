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
	if(!isset($_GET['step'])){
		$_GET['step'] = "1";
	}
	
	if($_GET['step'] == "1"){
	
		$head = "Upgrade X7 Chat 1.3.6";
		$body = "This script will allow you to upgrade your X7 Chat Version 1.3.6 Installation to X7 Chat Version 2.X.X.  If you are not using version 1.3.6, then you must visit our site and obtain a copy of
		1.3.6 and upgrade to it before upgrading to Version 2.  (ex: You cannot upgrade from 1.2.0 to 2.X.X, upgrade from 1.2.0 to 1.3.6, and then upgrade to 2.X.X)<Br><br>
		To upgrade from 1.3.6 to 2.X.X you must first run the X7 Chat 2 installer and install a blank copy of X7 Chat 2.  Then, visit this upgrade script and follow
		the instructions to import your Version 1 database into Version 2.  <font color=\"red\">All content in the Version 2 database will be overwritten.</font>  When installing Version 2 it is important that you do not overwrite the existing X7 Chat Version 1 tables, and use a different table prefix, otherwise this script will not work.<Br><br><b>Notes:</b><Br>* Permissions data for individual users will not be upgraded, only the user and admin defaults.<Br>* Smilies, bad word filters, messages, and bandwidth data will not be transfered.";
		$button['Start'] = "upgradev1.php?step=2";
	
	}elseif($_GET['step'] == "2"){
	
		$head = "Enter upgrade information";
		$body = "Please enter the following information to complete the upgrade:<Br>
		<form name=\"install\" action=\"./upgradev1.php?step=3\" method=\"post\" name=\"install\">
			<table border=\"0\">
				<tr>
					<td width=\"250\">X7 Chat 1.3.6 Table Prefix:</td>
					<td><input type=\"text\" name=\"old_prefix\" value=\"X7Chat_\"></td>
				</tr>
				<tr>
					<td width=\"250\">Import : Member Accounts and User Data</td>
					<td><input type=\"hidden\" name=\"member_accounts\" value=\"1\"><img src=\"./themes/install.images/checked.png\" onClick=\"c_img = document.install.member_accounts;if(c_img.value == '1'){this.src = './themes/install.images/unchecked.png';c_img.value = '0';}else{this.src = './themes/install.images/checked.png';c_img.value = '1';}\"></td>
				</tr>
				<tr>
					<td width=\"250\">Import : Rooms</td>
					<td><input type=\"hidden\" name=\"rooms\" value=\"1\"><img src=\"./themes/install.images/checked.png\" onClick=\"c_img = document.install.rooms;if(c_img.value == '1'){this.src = './themes/install.images/unchecked.png';c_img.value = '0';}else{this.src = './themes/install.images/checked.png';c_img.value = '1';}\"></td>
				</tr>
				<tr>
					<td width=\"250\">Import : Settings</td>
					<td><input type=\"hidden\" name=\"settings\" value=\"1\"><img src=\"./themes/install.images/checked.png\" onClick=\"c_img = document.install.settings;if(c_img.value == '1'){this.src = './themes/install.images/unchecked.png';c_img.value = '0';}else{this.src = './themes/install.images/checked.png';c_img.value = '1';}\"></td>
				</tr>
				<tr>
					<td width=\"250\">Convert passwords to MD5</td>
					<td><input type=\"hidden\" name=\"convert\" value=\"0\"><img src=\"./themes/install.images/unchecked.png\" onClick=\"c_img = document.install.convert;if(c_img.value == '1'){this.src = './themes/install.images/unchecked.png';c_img.value = '0';}else{this.src = './themes/install.images/checked.png';c_img.value = '1';}\"> &nbsp;&nbsp;&nbsp;&nbsp; * Check this if your old Auth type was \"plain\"</td>
				</tr>
			</table>
		</form>
		";
		$button['Upgrade'] = "javascript: document.install.submit();";
	
	}elseif($_GET['step'] == "3"){
	
		// Test Connection
		$body = "<b>Checking connection to database ... </b>";
		include("./config.php");
		include("./lib/db/".strtolower($X7CHAT_CONFIG['DB_TYPE']).".php");
		$db = new x7chat_db();
			
		if($db->error == 2){
			$body .= " <font color=\"red\">FAILED</font><Br><br>";
			$dbconnect_error = 1;
		}else{
			$body .= " <font color=\"green\">OK</font><br><Br>";
			$dbconnect_error = 0;
		}
		
		// Check database permissions
		$body .= "<b>Checking for database permissions ... </b>";
		if($db->error == 3 && $db->error != 2){
			$body .= " <font color=\"red\">FAILED</font><Br><br>";
			$dbselect_error = 1;
		}elseif($db->error == 0){
			$body .= " <font color=\"green\">OK</font><br><Br>";
			$dbselect_error = 0;
		}else{
			$body .= " Test not completed<br><Br>";
		}
		// If connection is ok
		$error = "";
		if($dbconnect_error)
			$error .= "<B>Database Connection Error: </b> The Username, Password, or Host that you gave us to connect to the database is incorrect.  Please double check these values.<br><Br>";
			
		if($dbselect_error)
			$error .= "<B>Database Permissions Error: </b> The database name you entered is incorrect or the database Username that you entered does not have permission to access this database.  For information on how to give a Username permission to access a database please visit our support page by clicking on the Help Link at the bottom of this page.<br><Br>";
					
		if($error == ""){
			$old_prefix = eregi_replace("'","\'",$_POST['old_prefix']);
			$error = "";
			
			// Get X7 Chat 2 settings
			$query = $db->DoQuery("SELECT * FROM {$prefix}settings");
			while($row = $db->Do_Fetch_Row($query)){
				$x2_settings[$row[1]] = $row[2];
			}
			
			if($_POST['member_accounts'] == 1){
				// Bring over _ignore, _users
				
				// Drop all X7c2 ignores
				$db->DoQuery("DELETE FROM {$prefix}muted");
				// Ignore Table
				$query1 = $db->DoQuery("SELECT * FROM {$old_prefix}ignore");
				if(mysql_error() != ""){
					$error .= "There was an error reading {$old_prefix}ignore.<br>";
				}
				while($row = $db->Do_Fetch_Row($query1)){
					$db->DoQuery("INSERT INTO {$prefix}muted VALUES('0','$row[1]','$row[2]'");
				}
				
				// Clear users in X7 Chat 2 DB so we don't have overlapping admin accounts
				$db->DoQuery("DELETE FROM {$prefix}users");
				// Users table
				$query1 = $db->DoQuery("SELECT * FROM {$old_prefix}users");
				if(mysql_error() != ""){
					$error .= "There was an error reading {$old_prefix}users.<br>";
				}
				while($row = $db->Do_Fetch_Row($query1)){
					
					if($row[4] == "4" || $row[4] == "5")
						$group = $x2_settings['usergroup_admin'];
					else
						$group = $x2_settings['usergroup_default'];
					
					if($_POST['convert'] == 1)
						$row[2] = md5($row[2]);
						
					$old_uset = explode(",",$row[13]);
					if($old_uset[7] == "0")
						$old_uset[7] = "default";
					$u_set = "default;default;{$x7c->settings['cookie_time']};default;default;default;$old_uset[2];$old_uset[3];$old_uset[8];$old_uset[4];$old_uset[1];$old_uset[7];default;0;0";
					$db->DoQuery("INSERT INTO {$prefix}users VALUES('0','$row[1]','$row[2]','$row[3]','$row[5]','$row[6]','$row[7]','$row[8]','$row[9]','Available','$group','$row[12]','$u_set','0','0','')");
				}
			}
			
			if($_POST['rooms'] == 1){
				$db->DoQuery("DELETE FROM {$prefix}rooms");
				// Bring over _rooms
				$query1 = $db->DoQuery("SELECT * FROM {$old_prefix}rooms");
				if(mysql_error() != ""){
					$error .= "There was an error reading {$old_prefix}rooms.<br>";
				}
				while($row = $db->Do_Fetch_Row($query1)){
					$db->DoQuery("INSERT INTO {$prefix}rooms VALUES('0','$row[1]','$row[2]','$row[5]','$row[6]','','$row[7]','$row[8]','$row[9]','','','0','','')");
				}
			}
			
			if($_POST['settings'] == 1){
				// Bring over _bans, _permissions, _settings
				$db->DoQuery("DELETE FROM {$prefix}banned");
				$query1 = $db->DoQuery("SELECT * FROM {$old_prefix}bans");
				if(mysql_error() != ""){
					$error .= "There was an error reading {$old_prefix}bans.<br>";
				}
				while($row = $db->Do_Fetch_Row($query1)){
					$name_ip = $row[2].$row[3];
					$db->DoQuery("INSERT INTO {$prefix}banned VALUES('0','$row[1]','$name_ip','$row[4]','$row[5]','')");
				}
				
				// We don't clear original X7Chat2 permissions on this one, simply update them
				$query1 = $db->DoQuery("SELECT * FROM {$old_prefix}permissions");
				if(mysql_error() != ""){
					$error .= "There was an error reading {$old_prefix}permissions.<br>";
				}
				while($row = $db->Do_Fetch_Row($query1)){
					if($row[1] == "DEFAULT_1")
						$group = $x2_settings['usergroup_default'];
					elseif($row[1] == "DEFAULT_4")
						$group = $x2_settings['usergroup_admin'];
					if(isset($group))
						$db->DoQuery("UPDATE {$prefix}permissions SET  make_rooms='$row[2]',make_nexp='$row[3]',make_proom='$row[4]',make_mod='$row[5]',make_admins='$row[6]',AOP_all='$row[8]',viewip='$row[9]',kick='$row[10]',admin_ban='$row[12]',admin_settings='$row[14]',admin_themes='$row[15]',admin_groups='$row[16]',admin_users='$row[17]',admin_rooms='$row[18]',admin_smilies='$row[19]',admin_filter='$row[20]',admin_bandwidth='$row[21]' WHERE usergroup='$group'");
					unset($group);
				}
				
				// Settings, this is going to be a long one :(
				$query1 = $db->DoQuery("SELECT * FROM {$old_prefix}settings");
				if(mysql_error() != ""){
					$error .= "There was an error reading {$old_prefix}settings.<br>";
				}
				while($row = $db->Do_Fetch_Row($query1)){
					switch($row[1]){
						case "ed_sounds":
							$new_name = "disable_sounds";
							if($row[2] != 1)
								$row[2] = 0;
						break;
						case "ed_chat":
							$new_name = "disable_chat";
							if($row[2] != 1)
								$row[2] = 0;
						break;
						case "ed_registration":
							$new_name = "allow_reg";
							if($row[2] == 1)
								$row[2] = 0;
							else
								$row[2] = 1;
						break;
						case "ed_chat":
							$new_name = "disable_chat";
							if($row[2] != 1)
								$row[2] = 0;
						break;
						case "exp_room":
							$new_name = "expire_rooms";
						break;
						case "exp_msg":
							$new_name = "expire_messages";
						break;
						case "max_idletime":
							$new_name = "online_time";
							if($row[2] == "240")
								$row[2] = "30";
						break;
						case "ed_links":
							$new_name = "disable_autolinking";
							if($row[2] != 1)
								$row[2] = 0;
						break;
						case "ed_style":
							$new_name = "disable_styles";
							if($row[2] != 1)
								$row[2] = 0;
						break;
						case "ed_smile":
							$new_name = "disable_smiles";
							if($row[2] != 1)
								$row[2] = 0;
						break;
						case "bgimage":
							$new_name = "background_image";
						break;
						case "news":
							$new_name = "news";
						break;
						case "maxlog":
							$new_name = "max_log_room";
						break;
						case "defband":
							$new_name = "max_default_bandwidth";
						break;
						case "style_sysmsg":
							$new_name = "system_message_color";
						break;
						case "serveroffset":
							$new_name = "time_offset_hours";
						break;
						default:
							$new_name = "";
						break;
					}
					if($new_name != "")
						$db->DoQuery("UPDATE {$prefix}settings SET setting='$row[2]' WHERE variable='$new_name'");
				}
			}
			
			if($error != ""){
				$head = "An error has occured";
				$body = "The following errors occured:<Br><Br>$error<br><br>These errors are most likely caused by an incorrect table prefix, please go back and double check your X7 Chat 1.3.6 table prefix.";
				$button["Back"] = "javascript: history.back();";
			}else{
				$head = "Upgrade Complete";
				$body = "Your chat room has successfully been upgraded.";
				$button['Chat!'] = "./index.php";
			}
			
			
		}else{
			$head = "An error has occured";
			$body = "$error";
			$button["Reload"] = "javascript: location.reload();";
			$button["Back"] = "javascript: history.back();";
		}	
		
	
	}
	
	
?>
<?PHP
	// Get the step images
	for($i = 1;$i <= 6;$i++){
		if($_GET['step'] == $i){
			$stepimg[$i] = "_g";
		}elseif($step > $i){
			$stepimg[$i] = "_b";
		}else{
			$stepimg[$i] = "";
		}
	}
	
	// Reset to null if step is 0
	if($step == 0)
		$step = "&nbsp;";
		
	// Generate code for any extra buttons
	$buttons = ""; $one = 0;
	$pri_text = "";
	$pri_val = "";
	foreach($button as $key=>$val){
		if($one != 0){
			$buttons .= "<td width=\"75\" style=\"background: url(./themes/install.images/body_bm.png);cursor: hand;cursor: pointer;text-align: center;\"  onClick=\"document.location='$val';\"><b>$key</b></td>
						<td width=\"5\" style=\"background: #f1f2f6;border-bottom: 1px solid black;\">&nbsp;</td>";
		}else{
			$pri_text = $key;
			$pri_url = $val;
			$one = 1;
		}
	}
?>
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>
	<title>X7 Chat 2</title>
	<META NAME=\"COPYRIGHT\" CONTENT=\"Copyright 2004/2005 By The X7 Group\">
	<META HTTP-EQUIV=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
	<META HTTP-EQUIV=\"CACHE-CONTROL\" CONTENT=\"NO-CACHE\">
	<META HTTP-EQUIV=\"PRAGMA\" CONTENT=\"NO-CACHE\">
	<LINK REL=\"SHORTCUT ICON\" HREF=\"./favicon.ico\">
	<style type="text/css">
		TD,BODY {
			font-family: arial, helvetica, sans-serif;
			font-size: 12px;
		}
		
		INPUT {
			background: url(./themes/install.images/input_bg.png);
			border: 1px solid #8F8F8F;
			font-family: arial, helvetica, sans-serif;
			font-size: 12px;
			height: 20px;
			vertical-align: center;
			padding-left: 2px;
			width: 150px;
		}
		
		SELECT {
			background: url(./themes/install.images/input_bg.png);
			border: 1px solid #8F8F8F;
			font-family: arial, helvetica, sans-serif;
			font-size: 12px;
			height: 20px;
			vertical-align: center;
			width: 150px;
		}
		
		OPTION {
			background: #dddddd;
			font-family: arial, helvetica, sans-serif;
			font-size: 12px;
			vertical-align: center;
		}
		
		A {
			font-family: arial, helvetica, sans-serif;
			font-size: 12px;
			color: #334570;
			text-decoration: none;
		}
		
		A:hover {
			color: #264eab;
			text-decoration: underline;
		}
		
		A:active {
			color: #ff0000;
			text-decoration: underline;
		}
	</style>
</head>
<body topmargin="0" marginheight="0" leftmargin="0" marginwidth="0">

	<table	width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr valign="top">
			<td height="125" width="500" style="border-bottom: 1px solid black;background: url(./themes/install.images/logo.png)">&nbsp;</td>
			<td height="125" style="border-bottom: 1px solid black;background: url(./themes/install.images/header.png)">&nbsp;</td>
			<td height="125" width="250" style="border-bottom: 1px solid black;background: url(./themes/install.images/steps.png)">
				<table border="0" cellspacing="0" cellpadding="0" align="center">
					<tr valign="top">
						<td height="35" colspan="10" style="font-size: 16px;text-align: center;padding-top: 25px;padding-bottom: 15px;"><b>Step</b></td>
					</tr>
					<tr>
						<td height="2" colspan="10">&nbsp;</td>
					</tr>
					<tr>
						<td height="25" width="25" style="text-align: center;background: url(./themes/install.images/ball<?=$stepimg[1]?>.gif);">1</td>
						<td width="4">&nbsp;</td>
						<td height="25" width="25" style="text-align: center;background: url(./themes/install.images/ball<?=$stepimg[2]?>.gif);">2</td>
						<td width="4">&nbsp;</td>
						<td height="25" width="25" style="text-align: center;background: url(./themes/install.images/ball<?=$stepimg[3]?>.gif);">3</td>
						<td width="4">&nbsp;</td>
						<td height="25" width="25" style="text-align: center;background: url(./themes/install.images/ball<?=$stepimg[4]?>.gif);">4</td>
						<td width="4">&nbsp;</td>
						<td height="25" width="25" style="text-align: center;background: url(./themes/install.images/ball<?=$stepimg[5]?>.gif);">5</td>
						<td width="4">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br><Br>
	<table width="95%" align="center" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="100%">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr valign="center">
						<td height="25" width="35" style="text-align: center;background: url(./themes/install.images/body_tl.png);"><b><?=$step?></b></td>
						<td height="25" style="font-size: 16px;background: url(./themes/install.images/body_tm.png);">&nbsp;&nbsp;<b><?=$head?></b></td>
						<td height="25" style="background: url(./themes/install.images/body_tr.png);" width="25">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%" style="padding: 10px;border: 1px solid black;background: #f1f2f6;"><?=$body?></td>
		</tr>
		<tr>
			<td width="100%">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td width="75"><a href="http://x7chat.com/support.php" target="_blank"><img src="./themes/install.images/body_bl.png" border="0"></a></td>
						<td style="background: #f1f2f6;border-bottom: 1px solid black;">&nbsp;</td>
						<?=$buttons?>
						<td width="75" style="background: url(./themes/install.images/body_br.png);cursor: hand;cursor: pointer;text-align: center;" onClick="document.location='<?=$pri_url?>';"><b><?=$pri_text?></b></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
<?PHP
	echo "<Br><div align=\"center\">Powered By <a href=\"http://www.x7chat.com/\" target=\"_blank\">X7 Chat</a> $INSTALL_X7CHATVERSION &copy; 2004 By The <a href=\"http://www.x7chat.com/\" target=\"_blank\">X7 Group</a></div>";
?>