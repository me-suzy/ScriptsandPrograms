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
	// This is the install file.  It is obviously used for setting up X7 Chat
	
	// Initial Script Setup
	error_reporting(E_ALL);
	set_magic_quotes_runtime(0);
	$button = array();
	$INSTALL_X7CHATVERSION = "2.0.0";
	
	// Check for the current step, if any
	if(!isset($_GET['step']))
		$step = 0;
	else
		$step = $_GET['step'];
		
	// See if X7 Chat is already installed
	if(!include("./config.php"))
		die("Unable to locate config.php.  Setup terminated, please upload config.php into the X7 Chat root directory.");
		
	// Follow the yellow brick road, in this case they are actual yellow brick steps
	switch($step){
		case 1:
			// Step 1, ask them for MySql Info and basic settings
			$head = "X7 Chat 2 - Basic Settings";
			
			// Get some default values
			if(!is_dir("./lib/auth"))
				die("AuthMod Library directory does not exist.  Please upload all the files and directorys that are included with X7 Chat 2.  File and Directory names are case sensitive.");
			if(!is_dir("./lib/db"))
				die("Database Library directory does not exist.  Please upload all the files and directorys that are included with X7 Chat 2.  File and Directory names are case sensitive.");
			
			// Auto-Detect integration attempt
				$integrated = false;
				$int_message = "";
				$def['db_name'] = "";
				$def['db_user'] = "";
				$def['db_pass'] = "";
				$def['db_host'] = "localhost";
				$def['type'] = "md5";
			
				// Scripts that use config.php for configuration (PhpBB2)
				if(@is_file("../config.php")){
					$data = implode("",@file("../config.php"));
					
					// Check for PhpBB, XMB, PostNuke or PhpNuke
					if(eregi("PHPBB_INSTALLED",$data)){
						// PhpBB Integration Attempt Discovered!
						include("../config.php");
						$def['db_name'] = $dbname;
						$def['db_user'] = $dbuser;
						$def['db_pass'] = $dbpasswd;
						$def['db_host'] = $dbhost;
						$def['type'] = "phpbb2";
						$integrated = true;
					// Check for XMB
					}elseif(eregi("www.xmbforum.com",$data)){
						// XMB Integration Attempt Discovered!
						include("../config.php");
						$def['db_name'] = $dbname;
						$def['db_user'] = $dbuser;
						$def['db_pass'] = $dbpw;
						$def['db_host'] = $dbhost;
						$def['type'] = "xmb";
						$integrated = true;
					// Check for postnuke
					}elseif(eregi("http://www.postnuke.com/",$data)){
						include("../config.php");
						$def['db_name'] = $pnconfig['dbname'];
						$def['db_user'] = $pnconfig['dbuname'];
						$def['db_pass'] = $pnconfig['dbpass'];
						$def['db_host'] = $pnconfig['dbhost'];
						$def['type'] = "postnuke";
						$integrated = true;
						// Test for encoded values
						if($pnconfig['encoded'] == 1){
							$def['db_user'] = base64_decode($pnconfig['dbuname']);
							$def['db_pass'] = base64_decode($pnconfig['dbpass']);
						}
					// Check for Phpnuke
					}elseif(eregi("http://phpnuke.org",$data)){
						include("../config.php");
						$def['db_name'] = $dbname;
						$def['db_user'] = $dbuname;
						$def['db_pass'] = $dbpass;
						$def['db_host'] = $dbhost;
						$def['type'] = "phpnuke";
						$integrated = true;
					}
				// Detect mcboard
				}elseif(@is_file("../global.php")){
					$data = implode("",@file("../global.php"));
					if(eregi("mercuryboard",$data)){
						include("../settings.php");
						$def['db_name'] = $set['db_name'];
						$def['db_user'] = $set['db_user'];
						$def['db_pass'] = $set['db_pass'];
						$def['db_host'] = $set['db_host'];
						$def['type'] = "mboard";
						$integrated = true;
					// Detect VB
					}elseif(eregi("VB_AREA",$data)){
						include("../includes/config.php");
						$def['db_name'] = $dbname;
						$def['db_user'] = $dbusername;
						$def['db_pass'] = $dbpassword;
						$def['db_host'] = $servername;
						$def['type'] = "vbulletin";
						$integrated = true;
					}
				// Scripts that use Settings.php
				}elseif(@is_file("../Settings.php")){
					$data = implode("",@file("../Settings.php"));
					if(eregi("http://www.simplemachines.org",$data)){
						include("../Settings.php");
						$def['db_name'] = $db_name;
						$def['db_user'] = $db_user;
						$def['db_pass'] = $db_passwd;
						$def['db_host'] = $db_server;
						$def['type'] = "smf";
						$integrated = true;
					}else{
						include("../Settings.php");
						$def['db_name'] = $db_name;
						$def['db_user'] = $db_user;
						$def['db_pass'] = $db_passwd;
						$def['db_host'] = $db_server;
						$def['type'] = "yabbse";
						$integrated = true;
					}
				// Detect scripts using mainfile.php
				}elseif(@is_file("../mainfile.php")){
					$xoopsOption['nocommon'] = 1;
					include("../mainfile.php");
					$def['db_name'] = XOOPS_DB_NAME;
					$def['db_user'] = XOOPS_DB_USER;
					$def['db_pass'] = XOOPS_DB_PASS;
					$def['db_host'] = XOOPS_DB_HOST;
					$def['type'] = "xoops";
					$integrated = true;
				// Detect Mambo
				}elseif(@is_file("../configuration.php")){
					include("../configuration.php");
					$def['db_name'] = $mosConfig_db;
					$def['db_user'] = $mosConfig_user;
					$def['db_pass'] = $mosConfig_password;
					$def['db_host'] = $mosConfig_host;
					$def['type'] = "mambo";
					$integrated = true;
				// Detect IPB
				}elseif(@is_file("../conf_global.php")){
					$data = implode("",@file("../conf_global.php"));
					if(eregi("guest_name_pre",$data)){
						include("../conf_global.php");
						$def['db_name'] = $INFO['sql_database'];
						$def['db_user'] = $INFO['sql_user'];
						$def['db_pass'] = $INFO['sql_pass'];
						$def['db_host'] = $INFO['sql_host'];
						$def['type'] = "invision1";
						$integrated = true;
					}else{
						include("../conf_global.php");
						$def['db_name'] = $INFO['sql_database'];
						$def['db_user'] = $INFO['sql_user'];
						$def['db_pass'] = $INFO['sql_pass'];
						$def['db_host'] = $INFO['sql_host'];
						$def['type'] = "invision2";
						$integrated = true;
					}
				}
				
				if($integrated){
					// Print Message
					$int_message = "<b>$def[type]</b> was detected and can be integrated with X7 Chat.  The values below have automatically been filled in for integration.  If you do not wish to integrate please select md5 for the Auth Type.  If you integrate with $def[type] you MUST use the same administrator accounts on both X7 Chat and $def[type]!<Br><Br>";
				}
			
			// End Auto-Detect Integration Attempt scripting
			
			// Get list of Database Types
			$db_types_dir = dir("./lib/db/");
			$db_types = "";
			while($file = $db_types_dir->read()){
				if($file != "." && $file != ".."){
					$file = eregi_replace("\.php$","",$file);
					if($file == "mysql")
						$db_types .= "<option value=\"$file\" selected=\"true\">$file</option>";
					else
						$db_types .= "<option value=\"$file\">$file</option>";
				}
			}
			
			// Get lsit of AuthMods
			$auth_dir = dir("./lib/auth/");
			$auth_types = "";
			while($file = $auth_dir->read()){
				if($file != "." && $file != ".."){
					$file = eregi_replace("\.php$","",$file);
					if($file == $def['type'])
						$auth_types .= "<option value=\"$file\" selected=\"true\">$file</option>";
					else
						$auth_types .= "<option value=\"$file\">$file</option>";
				}
			}
				
			// Send the body
			$body = "Please fill out all of the following information.<Br><Br>{$int_message}
			<form action=\"install.php\" name=\"install\" method=\"get\">
			<input type=\"hidden\" name=\"step\" value=\"2\">
			<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\">
				<Tr>
					<td width=\"100\">Database Name:</td>
					<td width=\"150\"><input type=\"text\" name=\"db_name\" value=\"{$def['db_name']}\"></td>
				</tr>
				<Tr>
					<td width=\"100\">Database User:</td>
					<td width=\"150\"><input type=\"text\" name=\"db_user\" value=\"{$def['db_user']}\"></td>
				</tr>
				<Tr>
					<td width=\"100\">Database Pass:</td>
					<td width=\"150\"><input type=\"text\" name=\"db_pass\" value=\"{$def['db_pass']}\"></td>
				</tr>
				<Tr>
					<td width=\"100\">Database Host:</td>
					<td width=\"150\"><input type=\"text\" name=\"db_host\" value=\"{$def['db_host']}\"></td>
				</tr>
				<Tr>
					<td width=\"100\">Database Prefix:</td>
					<td width=\"150\"><input type=\"text\" name=\"db_prefix\" value=\"x7chat2_\"></td>
				</tr>
				<Tr>
					<td width=\"100\">Use Persistant Connect*:</td>
					<td width=\"150\"><input type=\"hidden\" name=\"db_pconnect\" value=\"0\"><img src=\"./themes/install.images/unchecked.png\" onClick=\"c_img = document.install.db_pconnect;if(c_img.value == '1'){this.src = './themes/install.images/unchecked.png';c_img.value = '0';}else{this.src = './themes/install.images/checked.png';c_img.value = '1';}\"></td>
				</tr>
				<Tr>
					<td width=\"100\">Database Type:</td>
					<td width=\"150\">
						<select name=\"db_type\">
							{$db_types}
						</select>
					</td>
				</tr>
				<Tr>
					<td width=\"100\">Auth Type:</td>
					<td width=\"150\">
						<select name=\"auth_type\">
							{$auth_types}
						</select>
					</td>
				</tr>
				<Tr>
					<td width=\"100\">Cookie Path:</td>
					<td width=\"150\"><input type=\"text\" name=\"cookie_path\" value=\"/\"></td>
				</tr>
			</table><Br>
			* Not recommended.  Only available with some database types.<Br>
			<b>Note:</b> Langauge can be selected later in the General Settings page of the Settings section in the Admin panel.
			</form>
			";
			$button["Next"] = "javascript: document.install.submit();";
		break;
		
		case 2:
			// Check:
			$dbselect_error = 0;		// Database permissions
			$dbconnect_error = 0;		// Database connection
			$permission_error = 0;		// File/Directory permissions
			$directory_error = 0;		// Directory structure
			$file_error = 0;			// File structure
			
			// Make sure they didn't give us a blank value, stupid them
			if($_GET['cookie_path'] == "")
				$_GET['cookie_path'] = "/";
			
			$head = "X7 Chat 2 - System & Database Checks";
			
			// Check for files
			$body = "<b>Checking for required files ... </b>";
			$files = array("./lib/auth.php","./lib/ban.php","./lib/bandwidth.php","./lib/cleanup.php","./lib/color_picker.php","./lib/events.php","./lib/filter.php","./lib/irc.php","./lib/load.php","./lib/logs.php","./lib/message.php","./lib/online.php","./lib/output.php","./lib/private_chat.php","./lib/rooms.php","./lib/security.php","./lib/ssgen.php","./lib/status.php","./lib/theme_creator.php","./lib/uploads.php","./lib/usercontrol.php","./lib/xupdater.php","./sources/admin.php","./sources/forgotpass.php","./sources/frame.php","./sources/info_box.php","./sources/loginout.php","./sources/memberlist.php","./sources/newroom.php","./sources/privatemessage.php","./sources/profile.php","./sources/register.php","./sources/room_password.php","./sources/roomcp.php","./sources/roomlist.php","./sources/support.php","./sources/usercp.php","./sources/usr_action_box.php","./index.php","./colors.png","./lib/db/$_GET[db_type].php","./lib/auth/$_GET[auth_type].php","./lang/english.php","./themes/x7chat2/theme.data");
			$error = "";
			foreach($files as $key=>$val){
				if(!is_file($val))
					$error .= "&nbsp;&nbsp;&nbsp; <font color=\"red\">Failed to find $val</font><br>";
			}
			if($error != ""){
				$file_error = 1;
				$body .= " <font color=\"red\">FAILED</font><Br>$error<br>";
			}else{
				$body .= " <font color=\"green\">OK</font><Br><Br>";
			}
			
			// Check for directorys
			$body .= "<b>Checking for required directorys ... </b>";
			$dirs = array("./fonts","./sources","./lang","./uploads","./lib","./themes","./logs","./help","./mods","./sounds","./smilies","./lib/auth","./lib/db");
			$error = "";
			foreach($dirs as $key=>$val){
				if(!is_dir($val))
					$error .= "&nbsp;&nbsp;&nbsp; <font color=\"red\">Failed to find $val</font><br>";
			}
			if($error != ""){
				$directory_error = 1;
				$body .= " <font color=\"red\">FAILED</font><Br>$error<br>";
			}else{
				$body .= " <font color=\"green\">OK</font><Br><Br>";
			}
			
			// Check Permissions
			$body .= "<b>Checking for required file permissions ... </b>";
			if(!is_writeable("./config.php"))
				$error .= "&nbsp;&nbsp;&nbsp; <font color=\"red\">The file ./config.php is not writeable</font><Br>";
			if(!is_writeable("./logs"))
				$error .= "&nbsp;&nbsp;&nbsp; <font color=\"red\">The directory ./logs is not writeable</font><Br>";
			if(!is_writeable("./uploads"))
				$error .= "&nbsp;&nbsp;&nbsp; <font color=\"red\">The directory ./uploads is not writeable</font><Br>";
			
			if($error != ""){
				$permission_error = 1;
				$body .= " <font color=\"red\">FAILED</font><Br>$error<br>";
			}else{
				$body .= " <font color=\"green\">OK</font><br><Br>";
			}
				
			// Check database connection
			$body .= "<b>Checking connection to database ... </b>";
			include("./lib/db/$_GET[db_type].php");
			$db = new x7chat_db($_GET['db_host'],$_GET['db_user'],$_GET['db_pass'],$_GET['db_name'],0);

			if($db->error == 2){
				$body .= " <font color=\"red\">FAILED</font><Br><br>";
				$dbconnect_error = 1;
			}else{
				$body .= " <font color=\"green\">OK</font><br><Br>";
			}
			
			// Check database permissions
			$body .= "<b>Checking for database permissions ... </b>";
			if($db->error == 3 && $db->error != 2){
				$body .= " <font color=\"red\">FAILED</font><Br><br>";
				$dbselect_error = 1;
			}elseif($db->error == 0){
				$body .= " <font color=\"green\">OK</font><br><Br>";
			}else{
				$body .= " Test not completed<br><Br>";
			}
		
			
			// Check for errors and explain them
			$error = "";
			
			if($file_error)
				$error .= "<b>Required File Error: </b> One or more of the files needed by X7 Chat 2 are missing.  You can see exactly which ones by looking at the above error message.  Please upload these files into the proper directorys.<br><Br>";
				
			if($directory_error)
				$error .= "<b>Required Directory Error: </b> One or more of the directories required by X7 Chat are missing.  You can see exactly which ones by looking at the above error message.  Please upload these directories to their proper location.<br><Br>";
				
			if($permission_error)
				$error .= "<b>Permissions Error: </b> Please CHMOD 777 the file 'config.php' and the directories 'logs' and 'uploads'.  For help with how to CHMOD please visit our support page by clicking the Help button at the bottom.<br><Br>";
			
			if($dbconnect_error)
				$error .= "<B>Database Connection Error: </b> The Username, Password, or Host that you gave us to connect to the database is incorrect.  Please double check these values.<br><Br>";
				
			if($dbselect_error)
				$error .= "<B>Database Permissions Error: </b> The database name you entered is incorrect or the database Username that you entered does not have permission to access this database.  For information on how to give a Username permission to access a database please visit our support page by clicking on the Help Link at the bottom of this page.<br><Br>";
			
			if($error != ""){
				$body .= "<Br><Br><b>Results</b><Br>An error has occured.  Please correct it and press Reload at bottom of the page.  A more detailed explanation of the error follows:<Br><Br><div style=\"padding-left: 15px;\">$error</div>";
				$button["Reload"] = "javascript: location.reload();";
				$button["Back"] = "javascript: history.back();";
			}else{
				$body .= "<br><Br><b>Results</b><Br>System & Database passed all checks!  Click Next to continue setting up the database.";
				$button["Next"] = "install.php?step=3";
				
			// Attempt to write to the config file with the new configuration values
			$fh = fopen("./config.php","w");
			$date = date("g:i:s M d, Y");
			$fh = fwrite($fh,"<?PHP\n\t/* Automatically Generated By X7 Chat 2 Installer :: $date */\n\t\$X7CHAT_CONFIG['DB_USERNAME'] = \"$_GET[db_user]\";\n\t\$X7CHAT_CONFIG['DB_PASSWORD'] = \"$_GET[db_pass]\";\n\t\$X7CHAT_CONFIG['DB_HOST'] = \"$_GET[db_host]\";\n\t\$X7CHAT_CONFIG['DB_NAME'] = \"$_GET[db_name]\";\n\t\$X7CHAT_CONFIG['DB_TYPE'] = \"$_GET[db_type]\";\n\t\$prefix = \"$_GET[db_prefix]\";\n\t\$X7CHAT_CONFIG['AUTH_MODE'] = \"$_GET[auth_type]\";\n\t\$X7CHAT_CONFIG['COOKIE_PATH'] = \"$_GET[cookie_path]\";\n\t\$X7CHAT_CONFIG['USE_PCONNECT'] = $_GET[db_pconnect];\n\t\$X7CHAT_CONFIG['DISABLE_XUPDATER'] = 0;\n\t\$X7CHAT_CONFIG['INSTALLED'] = 1;\n\t\$X7CHATVERSION = \"$INSTALL_X7CHATVERSION\";\n\n\t// These can be uncommented for debugging\n\t//\$DEBUG_JAVASCRIPT = \"\";\n\n\t// MUSE Support\n\t// \$MUSE_DB['current'] = 1;\n\t// \$MUSE_DB['user_1'] = \"\";\n\t// \$MUSE_DB['pass_1'] = \"\";\n\t// \$MUSE_DB['user_2'] = \"\";\n\t// \$MUSE_DB['pass_2'] = \"\";\n\n?>");
			
			}
			
		break;
		
		case 3:
		
			$head = "X7 Chat 2 - Database Setup";
			$body = "";
			
			// Include our newly setup librarys and config
			include("./config.php");
			include("./lib/db/".strtolower($X7CHAT_CONFIG['DB_TYPE']).".php");
			$db = new x7chat_db();
			$error = 0;
			$msg = "";
			
			// This mini function is a mask for DoQuery
			function install_query($query){
				global $db, $error, $prefix, $msg;
				$rez = $db->DoQuery($query);
				eregi("({$prefix}[^ ]*) ",$query,$table);
				if($rez != 1){
					$msg .= "Creating table <b>$table[0]</b> ... <font color=\"red\">FAILED</font><Br>";
					$error = 1;
				}else{
					$msg .= "Creating table <b>$table[0]</b> ... <font color=\"green\">OK</font><Br>";
				}
			}
			
			// See if they want us to delete the old tables
			if(isset($_GET['overwrite'])){
				$msg .= "<b>Dropping old tables ... </b><br><Br>";
				$db->DoQuery("DROP TABLE {$prefix}bandwidth");
				$db->DoQuery("DROP TABLE {$prefix}banned");
				$db->DoQuery("DROP TABLE {$prefix}events");
				$db->DoQuery("DROP TABLE {$prefix}filter");
				$db->DoQuery("DROP TABLE {$prefix}messages");
				$db->DoQuery("DROP TABLE {$prefix}muted");
				$db->DoQuery("DROP TABLE {$prefix}online");
				$db->DoQuery("DROP TABLE {$prefix}permissions");
				$db->DoQuery("DROP TABLE {$prefix}rooms");
				$db->DoQuery("DROP TABLE {$prefix}settings");
				$db->DoQuery("DROP TABLE {$prefix}users");
			}
			
			// Create the new tables.  Check for errors
			install_query("CREATE TABLE {$prefix}bandwidth (id int(11) NOT NULL auto_increment,user varchar(255) NOT NULL default '',used bigint(20) NOT NULL default '0',max bigint(20) NOT NULL default '0',current int(11) NOT NULL default '0',PRIMARY KEY  (id)) TYPE=MyISAM;");
			install_query("CREATE TABLE {$prefix}banned ( id int(11) NOT NULL auto_increment, room varchar(255) NOT NULL default '', user_ip_email varchar(255) NOT NULL default '', starttime int(11) NOT NULL default '0', endtime int(11) NOT NULL default '0', reason text NOT NULL, PRIMARY KEY (id) ) TYPE=MyISAM;");
			install_query("CREATE TABLE {$prefix}events ( id int(11) NOT NULL auto_increment, timestamp int(11) NOT NULL default '0', event text NOT NULL, PRIMARY KEY (id) ) TYPE=MyISAM;");
			install_query("CREATE TABLE {$prefix}filter ( id int(11) NOT NULL auto_increment, room varchar(255) NOT NULL default '', type int(11) NOT NULL default '0', text varchar(255) NOT NULL default '', replacement varchar(255) NOT NULL default '', PRIMARY KEY (id) ) TYPE=MyISAM;");
			install_query("CREATE TABLE {$prefix}messages ( id int(11) NOT NULL auto_increment, user varchar(255) NOT NULL default '0', type int(11) NOT NULL default '0', body text NOT NULL, room varchar(255) NOT NULL default '', time int(11) NOT NULL default '0', PRIMARY KEY (id) ) TYPE=MyISAM;");
			install_query("CREATE TABLE {$prefix}muted ( id int(11) NOT NULL auto_increment, user varchar(255) NOT NULL default '', ignored_user varchar(255) NOT NULL default '', PRIMARY KEY (id) ) TYPE=MyISAM;");
			install_query("CREATE TABLE {$prefix}online ( id bigint(20) NOT NULL auto_increment, name varchar(255) NOT NULL default '', ip varchar(255) NOT NULL default '', room varchar(255) NOT NULL default '', usersonline tinytext NOT NULL, time int(11) NOT NULL default '0', invisible int(11) NOT NULL default '0', PRIMARY KEY (id) ) TYPE=MyISAM;");
			install_query("CREATE TABLE {$prefix}permissions ( id int(11) NOT NULL auto_increment, usergroup varchar(255) NOT NULL default '', make_rooms int(11) NOT NULL default '0', make_proom int(11) NOT NULL default '0', make_nexp int(11) NOT NULL default '0', make_mod int(11) NOT NULL default '0', viewip int(11) NOT NULL default '0', kick int(11) NOT NULL default '0', ban_kick_imm int(11) NOT NULL default '0', AOP_all int(11) NOT NULL default '0', AV_all int(11) NOT NULL default '0', view_hidden_emails int(11) NOT NULL default '0', use_keywords int(11) NOT NULL default '0', access_room_logs int(11) NOT NULL default '0', log_pms int(11) NOT NULL default '0', set_background int(11) NOT NULL default '0', set_logo int(11) NOT NULL default '0', make_admins int(11) NOT NULL default '0', server_msg int(11) NOT NULL default '0', can_mdeop int(11) NOT NULL default '0', can_mkick int(11) NOT NULL default '0', admin_settings int(11) NOT NULL default '0', admin_themes int(11) NOT NULL default '0', admin_filter int(11) NOT NULL default '0', admin_groups int(11) NOT NULL default '0', admin_users int(11) NOT NULL default '0', admin_ban int(11) NOT NULL default '0', admin_bandwidth int(11) NOT NULL default '0', admin_logs int(11) NOT NULL default '0', admin_events int(11) NOT NULL default '0', admin_mail int(11) NOT NULL default '0', admin_mods int(11) NOT NULL default '0', admin_smilies int(11) NOT NULL default '0', admin_rooms int(11) NOT NULL default '0', access_disabled int(11) NOT NULL default '0', b_invisible int(11) NOT NULL default '0', c_invisible int(11) NOT NULL default '0', admin_keywords int(11) NOT NULL default '0', access_pw_rooms int(11) NOT NULL default '0', PRIMARY KEY  (id)) TYPE=MyISAM;");
			install_query("CREATE TABLE {$prefix}rooms ( id int(11) NOT NULL auto_increment, name varchar(255) NOT NULL default '', type int(11) NOT NULL default '0', moderated int(11) NOT NULL default '0', topic varchar(255) NOT NULL default '', greeting varchar(255) NOT NULL default '', password varchar(255) NOT NULL default '', maxusers int(11) NOT NULL default '0', time int(11) NOT NULL default '0', ops text NOT NULL, voiced text NOT NULL, logged int(11) NOT NULL default '0', background varchar(255) NOT NULL default '', logo varchar(255) NOT NULL default '', PRIMARY KEY (id) ) TYPE=MyISAM;");
			install_query("CREATE TABLE {$prefix}settings ( id int(11) NOT NULL auto_increment, variable varchar(255) NOT NULL default '', setting text NOT NULL, PRIMARY KEY (id) ) TYPE=MyISAM;");
			install_query("CREATE TABLE {$prefix}users ( id int(11) NOT NULL auto_increment, username varchar(255) NOT NULL default '', password varchar(255) NOT NULL default '', email varchar(255) NOT NULL default '', avatar varchar(255) NOT NULL default '', name varchar(255) NOT NULL default '', location varchar(255) NOT NULL default '', hobbies varchar(255) NOT NULL default '', bio text NOT NULL, status varchar(255) NOT NULL default '', user_group text NOT NULL, time int(11) NOT NULL default '0', settings varchar(255) NOT NULL default '', hideemail int(11) NOT NULL default '0', gender int(11) NOT NULL default '0', ip varchar(255) NOT NULL default '', PRIMARY KEY (id) ) TYPE=MyISAM;");
			
			// Empty and insert default values
			$db->DoQuery("DELETE FROM {$prefix}rooms");
			$db->DoQuery("DELETE FROM {$prefix}permissions");
			$db->DoQuery("DELETE FROM {$prefix}settings");
			$db->DoQuery("DELETE FROM {$prefix}filter");
			
			$db->DoQuery("INSERT INTO {$prefix}rooms VALUES('0','General Chat','1','0','Welcome to X7 Chat 2','Welcome to General Chat %u.','','50','0','','','0','','')");
			
			$db->DoQuery("INSERT INTO {$prefix}permissions (id, usergroup, make_rooms, make_proom, make_nexp, make_mod, viewip, kick, ban_kick_imm, AOP_all, AV_all, view_hidden_emails, use_keywords, access_room_logs, log_pms, set_background, set_logo, make_admins, server_msg, can_mdeop, can_mkick, admin_settings, admin_themes, admin_filter, admin_groups, admin_users, admin_ban, admin_bandwidth, admin_logs, admin_events, admin_mail, admin_mods, admin_smilies, admin_rooms, access_disabled, b_invisible, c_invisible) VALUES (2, 'Administrator', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);");
			$db->DoQuery("INSERT INTO {$prefix}permissions (id, usergroup, make_rooms, make_proom, make_nexp, make_mod, viewip, kick, ban_kick_imm, AOP_all, AV_all, view_hidden_emails, use_keywords, access_room_logs, log_pms, set_background, set_logo, make_admins, server_msg, can_mdeop, can_mkick, admin_settings, admin_themes, admin_filter, admin_groups, admin_users, admin_ban, admin_bandwidth, admin_logs, admin_events, admin_mail, admin_mods, admin_smilies, admin_rooms, access_disabled, b_invisible, c_invisible) VALUES (3, 'Registered User', 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);");
			$db->DoQuery("INSERT INTO {$prefix}permissions (id, usergroup, make_rooms, make_proom, make_nexp, make_mod, viewip, kick, ban_kick_imm, AOP_all, AV_all, view_hidden_emails, use_keywords, access_room_logs, log_pms, set_background, set_logo, make_admins, server_msg, can_mdeop, can_mkick, admin_settings, admin_themes, admin_filter, admin_groups, admin_users, admin_ban, admin_bandwidth, admin_logs, admin_events, admin_mail, admin_mods, admin_smilies, admin_rooms, access_disabled, b_invisible, c_invisible) VALUES (6, 'Guest', 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);");
			
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','default_lang','english')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','disable_chat','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','site_name','Chat Room')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','default_skin','x7chat2')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','cookie_time','630000000')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','logout_page','')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','allow_reg','1')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','style_max_size','25')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','banner_url','./themes/x7chat2/logo.gif')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','background_image','')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','default_font','Arial')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','default_color','black')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','default_size','10 Pt')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','style_min_size','8')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','style_allowed_fonts','arial,courier,verdana,helvetica')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','system_message_color','#ff0000')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','allow_guests','1')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','online_time','30')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','disable_smiles','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','tweak_window_large_height','450')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','disable_gd','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','disable_styles','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','expire_messages','300')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','maxchars_status','19')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','date_format','g:i:s A')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','max_offline_msgs','50')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','uploads_path','installation_set')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','enable_avatar_uploads','1')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','avatar_max_size','5242880')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','uploads_url','installation_set')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','avatar_size_px','90x90')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','resize_smaller_avatars','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','disable_sounds','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','min_refresh','1000')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','max_refresh','30000')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','time_offset_hours','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','time_offset_mins','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','tweak_window_large_width','550')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','tweak_window_small_width','300')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','tweak_window_small_height','300')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','maxchars_msg','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','date_format_full','m/d/y g:i A ')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','disable_autolinking','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','logs_path','./logs')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','max_log_room','5242880')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','max_log_user','5242880')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','enable_logging','1')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','admin_email','installation_set')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','enable_roombgs','1')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','enable_roomlogo','1')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','enable_passreminder','1')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','show_events','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','events_showmonth','1')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','events_show3day','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','show_stats','1')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','events_3day_number','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','news','')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','expire_rooms','1800')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','usergroup_guest','Guest')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','log_bandwidth','0')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','usergroup_default','Registered User')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','expire_guests','600')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','date_format_date','m/d/y')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','usergroup_admin','Administrator')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','max_default_bandwidth','524288000')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','default_bandwidth_type','2')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','maxchars_username','8')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','user_agreement','')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','banner_link','')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','single_room_mode','')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','support_personel','')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','support_image_online','./themes/supportimages/support_s1_1_online.gif')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','support_image_offline','./themes/supportimages/support_s1_1_offline.gif')");
			$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','support_message','')");
			
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2','8|','<img src=\"./smilies/big_eyes.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2',';)','<img src=\"./smilies/wink.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2','=|','<img src=\"./smilies/not_impressed.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2',':D','<img src=\"./smilies/grin.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2',':(','<img src=\"./smilies/unhappy.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2',':o','<img src=\"./smilies/surprised.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2',':|','<img src=\"./smilies/straight.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2',':)','<img src=\"./smilies/happy.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2',':,(','<img src=\"./smilies/cry.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2','8)','<img src=\"./smilies/cool.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2',':roll:','<img src=\"./smilies/eye_roll.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2',':wink:','<img src=\"./smilies/ani_wink.gif\">')");
			$db->DoQuery("INSERT INTO {$prefix}filter VALUES('0','','2',':p','<img src=\"./smilies/stickout.gif\">')");
			
			if($error){
				$body = "$msg<Br><Br>An error has occured.  One or more of the tables probably already exist.  If you wish to overwrite the data in the database please click on the overwrite button at the bottom of the page.  If you do not want to overwrite the data in the database please go back and choose a different table prefix.";		// Setup failed
				$button["Overwrite"] = "install.php?step=3&overwrite=1";
				$button["Back"] = "javascript: history.go(-2);";
			}else{
				$body = "$msg<Br><Br>Setup was successful.  Press Next to setup your Admin account.";		// Setup was ok
				$button["Next"] = "install.php?step=4";
			}
		break;
		
		case 4:
			// Take a guess at their server's paths, actually this is accurate 99% of the time unless their server is wacked up
			$PATH = eregi_replace("install.php$","",$_SERVER["SCRIPT_FILENAME"])."uploads";
			$URL = "http://".eregi_replace("install.php\?step=4$","",$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"])."uploads";
		
			$head = "X7 Chat 2 - Admin Account Setup";
			$body = "
				<script language=\"javascript\" type=\"text/javascript\">
					function doSubmit(){
						a = document.admin;
						submit = true;
						// Check for password matches
						if(a.admin_password.value != a.admin_password_check.value){
							alert(\"The passwords you entered did not match!\");
							submit = false;
						}
						
						if(a.admin_password.value == \"\"){
							alert(\"You must enter a password\");
							submit = false;
						}
						
						if(a.admin_username.value.match(/\.|'|,|;| /i) || a.admin_username.value.length > 10 || a.admin_username.value == \"\"){
							alert(\"Invalid username, your username may contain letters and numbers but not spaces, commas, periods, apostrophes, quotes and semicolons.  Your username must be under 10 characters long.\");
							submit = false;
						}
						
						if(!a.admin_email.value.match(/[^@]*@[^.]*\..+/i)){
							alert(\"The email address you entered is not valid.\");
							submit = false;
						}
						
						if(submit)
							a.submit();
					}
				</script>
				Please fill out the following form.  This account will be your default Administrator account.  You may create additional administrator accounts after installation.
				<form action=\"install.php\" name=\"admin\" method=\"get\">
				<input type=\"hidden\" name=\"step\" value=\"5\">
				<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\">
					<Tr>
						<td width=\"100\">Admin Username:</td>
						<td width=\"150\"><input type=\"text\" name=\"admin_username\"></td>
					</tr>
					<Tr>
						<td width=\"100\">Admin Password:</td>
						<td width=\"150\"><input type=\"password\" name=\"admin_password\"></td>
					</tr>
					<Tr>
						<td width=\"100\">Retype Admin Password:</td>
						<td width=\"150\"><input type=\"password\" name=\"admin_password_check\"></td>
					</tr>
					<Tr>
						<td width=\"100\">Admin E-Mail Address:</td>
						<td width=\"150\"><input type=\"text\" name=\"admin_email\"></td>
					</tr>
				</table>
				<Br><br>
				The following form contains information related to the location of your chat room.  X7 Chat 2 has taken a 
				guess at the correct values.  Please check them for accuracy and click Next.
				<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\">
					<Tr>
						<td width=\"100\">Path to uploads directory:</td>
						<td width=\"150\"><input type=\"text\" name=\"up_path\" value=\"$PATH\"></td>
					</tr>
					<Tr>
						<td width=\"100\">URL to uploads directory:</td>
						<td width=\"150\"><input type=\"text\" name=\"up_url\" value=\"$URL\"></td>
					</tr>
				</table>
				</form>
			";
			$button["Next"] = "javascript: doSubmit();";
			
		break;
		
		case 5:
			// YES, the FINAL step!
			include("./config.php");
			include("./lib/db/".strtolower($X7CHAT_CONFIG['DB_TYPE']).".php");
			$db = new x7chat_db();
			include("./lib/auth/".strtolower($X7CHAT_CONFIG['AUTH_MODE']).".php");	
			$_GET['admin_password'] = auth_encrypt($_GET['admin_password']);
			
			$db->DoQuery("UPDATE {$prefix}settings SET setting='$_GET[up_path]' WHERE variable='uploads_path'");
			$db->DoQuery("UPDATE {$prefix}settings SET setting='$_GET[up_url]' WHERE variable='uploads_url'");
			$db->DoQuery("UPDATE {$prefix}settings SET setting='$_GET[admin_email]' WHERE variable='admin_email'");
			
			$ip = $_SERVER['REMOTE_ADDR'];
			$db->DoQuery("INSERT INTO {$prefix}users (id,username,password,email,status,user_group,time,settings,hideemail,ip) VALUES('0','$_GET[admin_username]','$_GET[admin_password]','$_GET[admin_email]','Available','Administrator','0','default;default;630000000;default;default;default;0;0;0;0;5000;default;default;0;0','0','$ip')");
			
			$head = "X7 Chat 2 - Installation Complete";
			$body = "
			Thank you for choosing X7 Chat, setup has been completed!<br><br>
			Technical support is provided at our website, <a href=\"http://www.x7chat.com/\" target=\"_blank\">www.x7chat.com</a>.  You will also find skins, mods, documentation and updates on our site.<Br><br>
			We welcome your comments and suggestions, feel free to stop by our <a href=\"http://forum.x7chat.com/\" target=\"_blank\">forum</a> and post any comments, feature requests, bug reports or suggestions that you have
			so that we can improve X7 Chat.<Br><br><b>Contribute to the Project</b><Br>If you enjoy X7 Chat please <a href=\"http://www.hotscripts.com/rate/28331.html\" target=_new>rate our script</a> on Hotscripts.<Br><br>
			<b>Copyright Removal Licenses</b><br>
			We offer Copyright Removal Licenses in case you wish to remove our copyright from your X7 Chat room, if you are interested please visit <a href=\"http://x7chat.com/index.php?page=services\">our services page</a> for more information.  Purchasing a Copyright Removal License is another great way to help out the X7 Chat Project.
			<br><br><font color=\"red\">WARNING!</font> You MUST deleted the file install.php now, if you do not then anybody will
			be able to get administrator access.
			<br><br>
			Ready to try it out?  <a href=\"./index.php\">Click Here</a> to enter your new chat room!";
			$button["CHAT!"] = "index.php";
			
		break;
		
		case 6:
			// Upgrade Time!
			if($X7CHATVERSION == $INSTALL_X7CHATVERSION){
				$head = "Upgrade?";
				$body = "You are already using this version.";
				$button["Back"] = "install.php";
				
			}else{
			
				if(is_writeable("./config.php")){
					$head = "Upgrade from $X7CHATVERSION to $INSTALL_X7CHATVERSION";
					$body = "This will allow you to upgrade from version $X7CHATVERSION to version $INSTALL_X7CHATVERSION.";
					$button["Continue"] = "install.php?step=7";
				}else{
					$head = "Upgrade from $X7CHATVERSION to $INSTALL_X7CHATVERSION";
					$body = "Please CHMOD 777 the config.php file.";
					$button["Continue"] = "install.php?step=6";
				}
			}
			
		break;
		
		case 7:
			// Upgrade control functions
			
				// Upgrade :: 2.0.0A1 to 2.0.0A2
				function x7upgrade_a1(){
					global $db,$error,$prefix;
					$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','banner_link','')");
					return 1;
				}
				
				// Upgrade :: 2.0.0A2 to 2.0.0A3
				function x7upgrade_a2(){
					global $db,$error,$prefix;
					$db->DoQuery("ALTER TABLE {$prefix}permissions ADD admin_keywords INT NOT NULL");
					return 1;
				}
				
				// Upgrade :: 2.0.0A3 to 2.0.0A4 (aka B1)
				function x7upgrade_a3(){
					global $db,$error,$prefix;
					$db->DoQuery("ALTER TABLE {$prefix}permissions ADD access_pw_rooms INT NOT NULL");
					$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','support_personel','')");
					$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','support_image_online','')");
					$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','support_image_offline','')");
					$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','support_message','')");
					$db->DoQuery("INSERT INTO {$prefix}settings VALUES('0','single_room_mode','')");	
					return 1;
				}
				
				// Upgrade :: 2.0.0A4 (aka B1) to 2.0.0B2
				function x7upgrade_b1(){
					// Nothing to see here, move on
				}
				
				// Upgrade :: 2.0.0B2 to 2.0.0B3
				function x7upgrade_b3(){
					// Nothing to see here, move on
				}
				
				// Upgrade :: 2.0.0B3 to 2.0.0
				function x7upgrade_2_0_0(){
					// Nothing to see here, move on
				}
				
					
			// Start the actual upgrade calling
			
			// Update the config script
			$data = file("./config.php");
			$data = implode("",$data);
			$data = eregi_replace("$X7CHATVERSION","$INSTALL_X7CHATVERSION",$data);
			$fh = fopen("./config.php","w");
			fwrite($fh,$data);
			fclose($fh);
			
			// Import the database library
			include("./lib/db/".strtolower($X7CHAT_CONFIG['DB_TYPE']).".php");
			// Create a new database connection
			$db = new x7chat_db();
			$error = "";
			
			// Alpha-1 to Alpha-3
			if($X7CHATVERSION == "2.0PA"){
				x7upgrade_a1();
				x7upgrade_a2();
				x7upgrade_a3();
				x7upgrade_b1();
				x7upgrade_b3();
				x7upgrade_2_0_0();
			// Alpha-2 to Alpha-3
			}elseif($X7CHATVERSION == "2.0-A2"){
				x7upgrade_a2();
				x7upgrade_a3();
				x7upgrade_b1();
				x7upgrade_b3();
				x7upgrade_2_0_0();
			// Alpha-3 to Alpha-4 (aka Beta-1)
			}elseif($X7CHATVERSION == "2.0-A3"){
				x7upgrade_a3();
				x7upgrade_b1();
				x7upgrade_b3();
				x7upgrade_2_0_0();
			// Alpha-4 (aka Beta-1) to Beta-2
			}elseif($X7CHATVERSION == "2.0-A4"){
				x7upgrade_b1();
				x7upgrade_b3();
				x7upgrade_2_0_0();
			}elseif($X7CHATVERSION == "2.0-B2"){
				x7upgrade_b3();
				x7upgrade_2_0_0();
			}elseif($X7CHATVERSION == "2.0-B3"){
				x7upgrade_2_0_0();
			}
			
			if($error == ""){
				$head = "Upgrade";
				$body = "Your chat room has been sucessfully upgraded.";
				$button["CHAT!"] = "index.php";
			}else{
				$head = "Error";
				$body = "$error";
				$button["Try Again"] = "install.php?step=7";
			}
			
		break;
	
		default:
			// Make sure X7 Chat isn't already installed, print greeting
			if(@$X7CHAT_CONFIG['INSTALLED'] && !isset($_GET['overwrite'])){
				$head = "X7 Chat 2";
				$body = "X7 Chat has already been installed.  Please choose whether to Upgrade or Overwrite the existing installation.
				<Br><Br><b>The existing version is $X7CHATVERSION :: This Install File is version $INSTALL_X7CHATVERSION</b>
				<Br><br><b>WARNING</b> - All data (rooms, users, settings, etc.) will be lost if your overwrite this installation!";
				$button["Overwrite"] = "install.php?overwrite=1";
				$button["Upgrade"] = "install.php?step=6";
			}else{
				$head = "X7 Chat 2";
				$body = "Welcome to X7 Chat 2.  This installation file will allow you to install X7 Chat V2 on your website.  Installation will take 5 steps, when you are ready to start press Next.<Br><Br>
				&nbsp;&nbsp;&nbsp; <b>Overview Of Steps</b><Br>
				&nbsp;&nbsp;&nbsp; <b>Step 1:</b> Enter Database & Settings information<Br>
				&nbsp;&nbsp;&nbsp; <b>Step 2:</b> System & Database checks<Br>
				&nbsp;&nbsp;&nbsp; <b>Step 3:</b> Database Table setup<Br>
				&nbsp;&nbsp;&nbsp; <b>Step 4:</b> Admin account setup & path configuration<Br>
				&nbsp;&nbsp;&nbsp; <b>Step 5:</b> Final Information<Br>
				<Br><Br>
				X7 Chat 2 does not create the required Database.  You may use an existing database or create a new one for X7 Chat to use.  You must know the following information in order to install X7 Chat, if you need assistance in obtaining this information please click the Help button at the bottom and contact us.<br><Br>
				&nbsp;&nbsp;&nbsp; <b>Information You Will Need</b><Br>
				&nbsp;&nbsp;&nbsp; <b>*</b> Database Username<Br>
				&nbsp;&nbsp;&nbsp; <b>*</b> Database Password<Br>
				&nbsp;&nbsp;&nbsp; <b>*</b> Database Name<Br>
				&nbsp;&nbsp;&nbsp; <b>*</b> Database Host (The script can usually guess this for you)<Br><Br>
				";
				$button['Next'] = "install.php?step=1";
			}
		break;
	}

	// Output all HTML
	// By the time this is reached $step, $body and $head should be set
	// Also, for each element of the array $button, add a button to the bottem
	// The key of this array is the button name and the value is the URL
	
	// Get the step images
	for($i = 1;$i <= 6;$i++){
		if($step == $i){
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
