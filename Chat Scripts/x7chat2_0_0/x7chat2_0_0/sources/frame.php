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
	// Handle Frames
	// This document is set up a little differently then the other source
	// files.  Instead of being divided into functions this is just one
	// big conditional that sees what frame needs printed and then it
	// prints the correct frame.  The regular page header is ignored.
	
	// We do a 100% different page for the update frame to save bandwidth\
	// So the first thing we do is see weather this is the update frame
	if(@$_GET['frame'] == "update"){
		// This is the update frame, handle with care ;)
		// Output ONLY necessary stuff so we can conserve bandwidth
				
		// Add-Delay, why do I have the feeling this is going to become a major pain in the ass
		if(!isset($_GET['delay_added'])){
			$db->DoQuery("DELETE FROM {$prefix}online WHERE name='$x7s->username' AND room='$_GET[room]'");
			echo "<html>
			<head>
			</head>
			<!--<body onLoad=\"document.location='./index.php?act=frame&frame=update&room=$_GET[room]&delay_added=1';\">
			&nbsp;-->
			<body>
			</body>
			</html>";
			exit;
		}
		
		// Start with getting new messages from server
		include("./lib/online.php");
		include("./lib/message.php");
		
		// Get the last update time
		// Returns 2 if room is full
		$lasttime = return_last_time($_GET['room']);
				
		//Check for room limit error
		if($lasttime == 2)
			$script = "window.parent.location='index.php?act=overload'\n";
		else
			$script = "";
		
		// Supress javascript errors
		if(!isset($DEBUG_JAVASCRIPT))
			$script .= "function supresserrors(){\n\r
							return true;\n\r
						}\n\r
						window.onerror=supresserrors;\n\r";
		
		// Load some colors
		$sysmsg_color = $x7c->settings['system_message_color'];
		$default_size = $x7c->settings['sys_default_size'];
		$default_font = $x7c->settings['sys_default_font'];
			
		$change_users = $lasttime[0];
		$users2 = $lasttime[2];
		$users3 = $lasttime[3];
		$lasttime = $lasttime[1];
		$sound_play = 0;
		
		if($lasttime == "")
			$lasttime = 1;
		$time = time();
		$messages = 0;	/* Setting this to 0 means that the scrolling code isn't sent to save bandwidth	*/
		
		// Handle the user list
		if(count($change_users) > 0){
			$users = "";
			foreach($change_users as $key=>$val){
				$users .= "<a href=\"#\" style=\"cursor: pointer;cursor: hand;\" onClick=\"javascript: window.parent.frames[\'profile\'].document.location=\'./index.php?act=frame&frame=profile&room=$_GET[room]&user=$val\';window.parent.frames[\'bottom_right\'].document.getElementById(\'profilename\').innerHTML = \'$txt[90]\';window.parent.frames[\'bottom_right\'].document.getElementById(\'profilestatus\').innerHTML = \'\';window.parent.frames[\'bottom_right\'].document.getElementById(\'profileusergroup\').innerHTML = \'\';\">$val</a><br>";
			}
			foreach($users2 as $key=>$val){
				if($val != "" && $lasttime != time())
					$script .= "window.parent.frames['middle_left'].document.write('<span style=\"color: $sysmsg_color;font-size: $default_size; font-family: $default_font;\"><b>$val $txt[43]</b></span><Br>');\r\n";
				$messages = 1;
			}
			foreach($users3 as $key=>$val){
				if($val != "" && $lasttime != time())
					$script .= "window.parent.frames['middle_left'].document.write('<span style=\"color: $sysmsg_color;font-size: $default_size; font-family: $default_font;\"><b>$val $txt[44]</b></span><Br>');\r\n";
				$messages = 1;
			}
			
			$script .= "window.parent.frames['middle_right'].document.getElementById(\"onlinelist\").innerHTML='$users'\r\n";
			
			if($x7c->settings['disable_sounds'] != 1 && $sound_play != 1){
				if(eregi("MSIE","$_SERVER[HTTP_USER_AGENT]")){
					// wow, the browser you are using is a piece of shit
					// ok then, we'll send you nice code
					$script .= "window.parent.frames['bottom_left'].document.enter_snd.Play();\n";
				}else{
					// At lesat test code actually works here
					$script .= "if(window.parent.frames['bottom_left'].document.enter_snd.Play)\nwindow.parent.frames['bottom_left'].document.enter_snd.Play();\n";
				}
				// Yes, you did seem me just run a fucking browser test and I am not happy about it
				$sound_play = 1;
			}
			
		}
		
		
		if($lasttime == 1){
			// We need to put the background image if there is one there
			$image = $x7c->settings['background_image'];
			if($image != ""){
				$background = " style=\"background-attachment: fixed;background-image: url($image);\"";
			}else{
				$background = "";
			}
			$script .= "window.parent.frames['middle_left'].document.write('<html>$print->ss_mini<body$background>')\n";
			
			
			// We need to send the greeting, if there is one
			if($x7c->room_data['greeting'] != ""){
				$x7c->room_data['greeting'] = eregi_replace("'","\\'",$x7c->room_data['greeting']);
				$script .= "window.parent.frames['middle_left'].document.write('<b><font color=\"$sysmsg_color\">{$x7c->room_data['greeting']}</font></b><br>')\n";
			}
		
		}
		
		// Get messages to display
		if($lasttime > 1){
			// This is a very long query
			// It gets the new messages that are (in order):
			//		* Regular messages from users to the chat room
			//		* Messages from the System only to you
			//		* Messages from the Administrator to all chat rooms
			//		* Messages from the room operator/administrator to only this room
			//		* Offline messages that have not been read
			//		* Private messages
			$PM_COUNT = 0;
			$lt1 = $lasttime-1;
			$time1 = time()-1;
			
			// Private message Stuff
			$pm_time = time()-2*($x7c->settings['refresh_rate']/1000);
			$pms_found = 0;
			
			// Run the query
			$query = $db->DoQuery("SELECT user,type,body,time FROM {$prefix}messages WHERE 
									room='$_GET[room]' AND time>=$lt1 AND time<$time1 AND user<>'$x7s->username' AND type='1' OR 
									room='$x7s->username' AND time>$lt1 AND time<=$time1 AND type='3' OR
									type='2' AND time>=$lt1 AND time<$time1 OR
									type='4' AND time>=$lt1 AND time<$time1 AND room='$_GET[room]' OR 
									type='6' AND room='$x7s->username' AND time='0' OR 
									type='5' AND room='$x7s->username:0' AND time<'$pm_time' 
									ORDER BY time ASC");
			
			// Check for any database errors
			if($db->error == 4){
				$query = eregi_replace("'","\\'",$query);
				$query = eregi_replace("\n","",$query);
				$query = eregi_replace("\r","",$query);
				$script .= "\n\nwindow.parent.location='./index.php?act=panic&dump=$query&source=/sources/frame.php:144';\n\n";
			}
			
			while($row = $db->Do_Fetch_Row($query)){
				if(!in_array($row[0],$x7c->profile['ignored'])){
					$row[2] = eregi_replace("'","\\'",$row[2]);
					
					if($row[1] == 1){
						$row[2] = parse_message($row[2]);
						
						// See if they want a timestamp
						if($x7c->settings['disble_timestamp'] != 1)
							$timestamp = format_timestamp($row[3]);
						else
							$timestamp = "";
						
						$script .= "window.parent.frames['middle_left'].document.write('<span class=\"other_persons\"><a class=\"other_persons\" onClick=\"javascript: window.open(\'index.php?act=pm&send_to=$row[0]\',\'Pm$row[0]\',\'location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width={$x7c->settings['tweak_window_large_width']},height={$x7c->settings['tweak_window_large_height']}\');\">$row[0]</a>$timestamp:</span> $row[2]<br>');\r\n";
					}elseif($row[1] == 2 || $row[1] == 3 || $row[1] == 4){
						$row[2] = parse_message($row[2],1);
						//$script .= "alert('$row[1] is what got u and $row[0] is who duunit');\r\n";
						$script .= "window.parent.frames['middle_left'].document.write('$row[2]<br>');\r\n";
					}elseif($row[1] == 6){
						$PM_COUNT++;
					}elseif($row[1] == 5){
						$script .= "window.open('index.php?act=pm&send_to=$row[0]','Pm$row[0]','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width={$x7c->settings['tweak_window_large_width']},height={$x7c->settings['tweak_window_large_height']}');\r\n";
						$txt[511] = eregi_replace("<a>","<a style=\"cursor: hand;cursor: pointer;\" onClick=\"window.open(\\'index.php?act=pm&send_to=$row[0]\\',\\'Pm$row[0]\\',\\'location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width={$x7c->settings['tweak_window_large_width']},height={$x7c->settings['tweak_window_large_height']}\\');\">",$txt[511]);	
						$script .= "window.parent.frames['middle_left'].document.write('<span style=\"color: $sysmsg_color;font-size: $default_size; font-family: $default_font;\"><b>$txt[511]</b></span><Br>')\r\n";
					}
					
					$messages++;
				}
			}
		}

		
		if($messages != 0){
			/*$script .= '
			if(typeof(scrollBy) != "undefined"){
				window.parent.frames[\'middle_left\'].window.scrollBy(0, 65000);
			}else{
				window.parent.frames[\'middle_left\'].window.scroll(0, 65000);
			}'."\r\n";
			*/
			
			// Smooth Scrolling
			$rate = ($x7c->settings['refresh_rate']*3)-1;
			$script .= "
			current = 0;\r\n
			function scroll_screen(){\r\n
				window.parent.frames['middle_left'].window.scrollBy(0, 25);\r\n
				if(current < $rate){\r\n
					this_timeout = setTimeout('scroll_screen()','250');
					current++;
				}else{
					window.parent.frames['middle_left'].window.scrollBy(0, 65000);\r\n
				}\r\n
			}\r\n
			scroll_screen();\r\n";
		
			if($x7c->settings['disable_sounds'] != 1 && $sound_play != 1)
				if(eregi("MSIE","$_SERVER[HTTP_USER_AGENT]")){
					// wow, the browser you are using is a piece of shit
					// ok then, we'll send you nice code
					$script .= "window.parent.frames['bottom_left'].document.msg_snd.Play();\n";
				}else{
					// At lesat test code actually works here
					$script .= "if(window.parent.frames['bottom_left'].document.msg_snd.Play)\nwindow.parent.frames['bottom_left'].document.msg_snd.Play();\n";
				}
				// Yes, you did seem me just run a fucking browser test and I am not happy about it
		}
					
		// See if they are banned
		$bans = $x7p->bans_on_you;

		foreach($bans as $key=>$row){
		
			// If a row returned and they don't have immunity then thrown them out the door and lock up
			if($row != "" && $x7c->permissions['ban_kick_imm'] != 1){
				if($row[1] == "*"){
					// They are banned from the server
					$txt[117] = eregi_replace("_r",$row[5],$txt[117]);
					$script = "alert('$txt[117]')\n
								window.parent.location='./index.php'\r\n";
				}elseif($row[1] == $x7c->room_data['id'] && $row[4] == 60){
					// They are kicked from this room
					$txt[115] = eregi_replace("_r",$row[5],$txt[115]);
					$script = "alert('$txt[115]')\n
								window.parent.location='./index.php?act=kicked'\r\n";
					$db->DoQuery("DELETE FROM {$prefix}online WHERE name='$x7s->username' AND room='$_GET[room]'");
				}elseif($row[1] == $x7c->room_data['id']){
					// They are banned from this room
					$txt[116] = eregi_replace("_r",$row[5],$txt[116]);
					$script = "alert('$txt[116]')\n
								window.parent.location='./index.php?act=kicked'\r\n";
					$db->DoQuery("DELETE FROM {$prefix}online WHERE name='$x7s->username' AND room='$_GET[room]'");
				}
			}
		}
				
		// See if they have used up all their allowed bandwidth
		if($x7c->settings['log_bandwidth'] == 1){
			if($BW_CHECK){
				$script .= "window.parent.location='./index.php'\r\n";
			}
		}
		
		// Tell them about any new PMs that they have
		if(!isset($PM_COUNT))
			$PM_COUNT = "-";
		//$script .= "window.parent.frames['topf'].document.pm_form.numpms.value = '$PM_COUNT';\r\n";
		$script .= "window.parent.frames['topf'].document.getElementById('numpms').innerHTML = '$PM_COUNT';\r\n";
		
		// Debug
		//$script .= "window.parent.frames['middle_left'].document.write('$temp44<Br>');";
		
		// Output as little as possible here to save monthly bandwidth total
		$refreshplus5 = ($x7c->settings['refresh_rate']/1000)+5;
		echo "<html><head><meta http-equiv=\"refresh\" content=\"{$refreshplus5}\"><script language=\"javascript\" type=\"text/javascript\">$script\r\n</script></head><body onLoad=\"javascript: setTimeout('location.reload()','{$x7c->settings['refresh_rate']}');\">&nbsp;</body>";
		
	}else{
		// Ok it is not the update frame so continue with normal headers
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';
		$site_name = $x7c->settings['site_name'];
		echo "<html><head><title>$site_name -- $_GET[room]</title>$print->style_sheet</head>";
	
		// Make sure the frame variable is set
		if(!isset($_GET['frame']) || $_GET['frame'] == "")
			$_GET['frame'] = "frameset";
		
		// See what frame they want
		if($_GET['frame'] == "frameset"){
			?>
				<frameset rows="0,0,0,22%,78%" frameborder="0" border="0">
					<frame src="index.php?act=frame&frame=send&room=<?=$x7c->room_name?>" name="send" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
					<frame src="index.php?act=frame&frame=update&room=<?=$x7c->room_name?>" name="update" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
					<frame src="index.php?act=frame&frame=profile" name="profile" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
					<frame src="index.php?act=frame&frame=top&room=<?=$x7c->room_name?>" name="topf" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
					<frameset cols="75%,25%" frameborder="0" border="0">
						<frameset rows="53%,25%" frameborder="0" border="0">
							<frame src="index.php?act=frame&frame=left_middle&room=<?=$x7c->room_name?>" name="middle_left" frameborder="0" scrolling="yes" marginwidth="0" marginheight="0" noresize="true">
							<frame src="index.php?act=frame&frame=left_bottom&room=<?=$x7c->room_name?>" name="bottom_left" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
						</frameset>
						<frameset rows="44%,34%" frameborder="0" border="0">
							<frame src="index.php?act=frame&frame=right_middle&room=<?=$x7c->room_name?>" name="middle_right" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
							<frame src="index.php?act=frame&frame=right_bottom&room=<?=$x7c->room_name?>" name="bottom_right" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
						</frameset>
					</frameset>
				</frameset>
				<NOFRAMES>
					Sorry, you need frames to use this Chat Room.
				</NOFRAMES>
			<?PHP
			
		}elseif($_GET['frame'] == "top"){
			?>
			
			<table border="0" cellspacing="0" cellpadding="0" width="525" align="center">
				<tr valign="top">
					<td colspan="3" height="30" width="225">
						<?PHP if($x7c->settings['banner_link'] != "") echo "<a href=\"{$x7c->settings['banner_link']}\" target=\"_blank\">"; ?><img src="<?PHP echo $x7c->settings['banner_url']; ?>" align="middle" border="0"><?PHP if($x7c->settings['banner_link'] != "") echo "</a>"; ?> 
						&nbsp; &nbsp;                     
					</td>
					<td colspan="4" class="infobar">
						<table height="30" border="0" cellspacing="0" cellpadding="0" class="infobar">
							<tr valign="top">
								<td width="160">
									<form name="pm_form">
									<b><?=$x7s->username?></b><Br>
									<?=$_GET['room']?><Br>
									<a style="cursor: hand;cursor: pointer;" onClick="window.open('index.php?act=usercp&cp_page=msgcenter','MsgCenter','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_large_width']?>,height=<?=$x7c->settings['tweak_window_large_height']?>');"><?=$txt[514]?>: <div class="infobar" style="background: transparent;border: 0px;cursor: hand;cursor: pointer;display: inline;" name="numpms" id="numpms"></div></a> 
									</form>
								</td>
								<td width="140" rowspan="4" style="text-align: right">
									<form name="inis_form">
									<?PHP
										//**************************************************************//
										//	This is my copyright.  I ask you very kindly not to	//
										//	remove it.  I spent 280+ hours of my own		//
										//	free time to make this software.  I am not getting school	//
										//	or work credit, nor am I going to get much money, if any,	//
										//	from it.  So if you don't want to pay for it the least you 	//
										//	can do is give me one line of credit.						//
										//**************************************************************//
										//
										print("<!----><div align=\"center\" style=\"font-size: 9px;\">Powered By <a href=\"http://www.x7chat.com/\" target=\"_blank\">X7 Chat</a> $X7CHATVERSION &copy; 2004 By The <a href=\"http://www.x7chat.com/\" target=\"_blank\">X7 Group</a></div>");
										//
										//**************************************************************//
										//	Should you decide that you want to steal my work anyway, I 	//
										//	must inform you that removal of this copyright without 		//
										//	permission voids your right to use this software and you	// 
										//	be required to cease all use of it immediatly.				//
										//**************************************************************//
									
										// Invisibility Button
										/* Test and see if they are allowed to be invisible, if they are then check if they currently care invisible or not and give them a button		. */
										if($x7c->permissions['b_invisible'] == 1){
											echo "
											<script language=\"javascript\" type=\"text/javascript\">
												function changeMsg(object){
													if(object.value == \"$txt[523]\"){
														object.value = \"$txt[524]\";
													}else{
														object.value = \"$txt[523]\";
													}
												}
											</script>
											";
											if($x7c->settings['invisible'] == 1)
												echo "<input type=\"button\" readonly=\"true\" onClick=\"javascript: window.open('./index.php?act=sm_window&page=invis&room=$_GET[room]','Invis','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width={$x7c->settings['tweak_window_small_width']},height={$x7c->settings['tweak_window_small_height']}');changeMsg(this);\" name=\"invis_tog\" value=\"$txt[524]\" class=\"button\">";
											else
												echo "<input type=\"button\" readonly=\"true\" onClick=\"javascript: window.open('./index.php?act=sm_window&page=invis&room=$_GET[room]','Invis','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width={$x7c->settings['tweak_window_small_width']},height={$x7c->settings['tweak_window_small_height']}');changeMsg(this);\" name=\"invis_tog\" value=\"$txt[523]\" class=\"button\">";
										}
									?>
									</form>
								</td>
							</tr>
						</table>
					</td>
				</tr>
					<td colspan="7">
						<table border="0" align="center" cellspacing="0" cellpadding="0">
							<tr>
								<?PHP if($x7c->settings['single_room_mode'] == "") echo "<td class=\"menubar\" onMouseOver=\"javascript: this.className='menubar_hover'\" onMouseOut=\"javascript: this.className='menubar'\" height=\"30\" width=\"75\" onClick=\"javascript: window.open('index.php','RoomList','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width={$x7c->settings['tweak_window_large_width']},height={$x7c->settings['tweak_window_large_height']}');\">$txt[29]</td>";?>
										
								<td class="menubar" onMouseOver="javascript: this.className='menubar_hover'" onMouseOut="javascript: this.className='menubar'" height="30" width="75" onClick="javascript: window.open('index.php?act=usercp','UserCP','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_large_width']?>,height=<?=$x7c->settings['tweak_window_large_height']?>');"><?=$txt[35];?></td>
								<td class="menubar" onMouseOver="javascript: this.className='menubar_hover'" onMouseOut="javascript: this.className='menubar'" height="30" width="75" onClick="javascript: window.open('index.php?act=usercp&cp_page=status','Status','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_large_width']?>,height=<?=$x7c->settings['tweak_window_large_height']?>');"><?=$txt[40];?></td>
								<td class="menubar" onMouseOver="javascript: this.className='menubar_hover'" onMouseOut="javascript: this.className='menubar'" height="30" width="75" onClick="javscript: window.open('./help/','Help');"><?=$txt[34];?></td>
								<td class="menubar" onMouseOver="javascript: this.className='menubar_hover'" onMouseOut="javascript: this.className='menubar'" height="30" width="75"  onClick="javascript: window.open('index.php?act=logout');window.parent.close();window.parent.location='./index.php?act=logout'"><?=$txt[16];?></td>
								<?PHP if($x7c->permissions['room_operator'] == 1){ echo "<td class=\"menubar\" onMouseOver=\"javascript: this.className='menubar_hover'\" onMouseOut=\"javascript: this.className='menubar'\" height=\"30\" width=\"75\" onClick=\"javascript: window.open('index.php?act=roomcp&room=$_GET[room]','RoomCP','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width={$x7c->settings['tweak_window_large_width']},height={$x7c->settings['tweak_window_large_height']}');\">$txt[41]</td>"; } ?>
								<?PHP if($x7c->permissions['admin_access'] == 1){ echo "<td class=\"menubar\" onMouseOver=\"javascript: this.className='menubar_hover'\" onMouseOut=\"javascript: this.className='menubar'\" height=\"30\" width=\"75\" onClick=\"javascript: window.open('index.php?act=admincp','AdminCP','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width={$x7c->settings['tweak_window_large_width']},height={$x7c->settings['tweak_window_large_height']}');\">".$txt[37].'</td>'; } ?>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			
			<?PHP
			
		}elseif($_GET['frame'] == "right_middle"){
			?>
			<body onLoad="window.parent.frames['update'].location='./index.php?act=frame&frame=update&room=<?=$_GET['room']?>&delay_added=1'">
			<div align="center" width="100%" height="50%">
			<div id="onlinelist" name="onlinelist" align="center" class="online_list">
			<?=$txt[90]?>
			</div>
			</div>
			</form>
			
			<?PHP
			
		}elseif($_GET['frame'] == "right_bottom"){
			// Print style sheet info
			echo $print->ss_uc;
		
			?>
			
		<form name="profileform">
			<table align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="100" height="25" class="uc_header">
						<table border="0" width="100" height="25" cellspacing="0" cellpadding="0" name="mytable">
							<tr>
								<td width="50" height="25" id="pro" onClick="document.getElementById('pro').className='uc_header_selected';document.getElementById('act').className='uc_header_text';document.getElementById('profile_tab').style.visibility='visible';document.getElementById('action_tab').style.visibility='hidden';" class="uc_header_selected"><?=$txt[85]?></td>
								<td width="50" height="25" id="act" onClick="document.getElementById('act').className='uc_header_selected';document.getElementById('pro').className='uc_header_text';document.getElementById('action_tab').style.visibility='visible';document.getElementById('profile_tab').style.visibility='hidden';" class="uc_header_text"><?=$txt[86]?></td>
							</tr>
						</table>
					</td>
				</tr>
				</table>
				<table border="0" cellspacing="0" cellpadding="0" width="100" align="center">
					<tr>
						<td class="uc_item_box">
							<table id="action_tab" style="visibility: hidden;" border="0" cellspacing="0" cellpadding="0" width="100" align="center">
								</tr>
									<td><div class="uc_item_blank" OnMouseOver="javascript: this.className='uc_item_over'" id="act_label_1" name="act_label_1" onMouseOut="this.className='uc_item'"  onClick="javascript: window.open('./index.php?act=usr_action&action='+document.profileform.action_1.value+'&user='+document.getElementById('profilename').innerHTML+'&room=<?=$_GET['room']?>','UsrAction','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_small_width']?>,height=<?=$x7c->settings['tweak_window_small_height']?>');"><?=$txt[91]?></div></td>
								</tr>
								</tr>
									<td><div class="uc_item_blank" OnMouseOver="javascript: if(this.innerHTML != ''){this.className='uc_item_over';}" id="act_label_2" name="act_label_2" onMouseOut="javascript: if(this.value != ''){this.className='uc_item';}"  onClick="javascript: window.open('./index.php?act=usr_action&action='+document.profileform.action_2.value+'&user='+document.getElementById('profilename').innerHTML+'&room=<?=$_GET['room']?>','UsrAction','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_small_width']?>,height=<?=$x7c->settings['tweak_window_small_height']?>');"><?=$txt[98]?></div></td>
								</tr>
								</tr>
									<td><div class="uc_item_blank" OnMouseOver="javascript: if(this.innerHTML != ''){this.className='uc_item_over';}" id="act_label_3" name="act_label_3" onMouseOut="javascript: if(this.value != ''){this.className='uc_item';}"  onClick="javascript: window.open('./index.php?act=usr_action&action='+document.profileform.action_3.value+'&user='+document.getElementById('profilename').innerHTML+'&room=<?=$_GET['room']?>','UsrAction','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_small_width']?>,height=<?=$x7c->settings['tweak_window_small_height']?>');"><?=$txt[97]?></div></td>
								</tr>
								</tr>
									<td><div class="uc_item_blank" OnMouseOver="javascript: if(this.innerHTML != ''){this.className='uc_item_over';}" id="act_label_4" name="act_label_4" onMouseOut="javascript: if(this.value != ''){this.className='uc_item';}"  onClick="javascript: window.open('./index.php?act=usr_action&action='+document.profileform.action_4.value+'&user='+document.getElementById('profilename').innerHTML+'&room=<?=$_GET['room']?>','UsrAction','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_small_width']?>,height=<?=$x7c->settings['tweak_window_small_height']?>');"><?=$txt[94]?></div></td>
								</tr>
								</tr>
									<td><div class="uc_item_blank" OnMouseOver="javascript: if(this.innerHTML != ''){this.className='uc_item_over';}" id="act_label_5" name="act_label_5" onMouseOut="javascript: if(this.value != ''){this.className='uc_item';}"  onClick="javascript: window.open('./index.php?act=usr_action&action='+document.profileform.action_5.value+'&user='+document.getElementById('profilename').innerHTML+'&room=<?=$_GET['room']?>','UsrAction','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_small_width']?>,height=<?=$x7c->settings['tweak_window_small_height']?>');"><?=$txt[99]?></div></td>
								</tr>
								<input type="hidden" name="action_1" value="">
								<input type="hidden" name="action_2" value="">
								<input type="hidden" name="action_3" value="">
								<input type="hidden" name="action_4" value="">
								<input type="hidden" name="action_5" value="">
							</table>
							<Br><Br>
						</td>
					</tr>
				</table>
				<table id="profile_tab" style="visibility: visible;position: relative;top: -105px;" border="0" cellspacing="0" cellpadding="0" width="100" align="center">
					<tr>
						<td>
							<div id="profilename" name="profilename" class="infobox" style="font-weight: bold;width: 98px;text-align: center;"><?=$txt[103]?></div>
							<div id="profileusergroup" name="profileusergroup" class="infobox" style="width: 98px;text-align: center;">&nbsp;</div>
							<div id="profilestatus" name="profilestatus" class="infobox" style="font-style: italic;width: 98px;text-align: center;">&nbsp;</div>
						</td>
					</tr>
					</tr>
						<td class="uc_item" OnMouseOver="javascript: this.className='uc_item_over'" onMouseOut="this.className='uc_item'" onClick="javascript: window.open('./index.php?act=view_profile&user='+document.getElementById('profilename').innerHTML,'Profile','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_large_width']?>,height=<?=$x7c->settings['tweak_window_large_height']?>');"><?=$txt[87]?></td>
					</tr>
					</tr>
						<td class="uc_item" OnMouseOver="javascript: this.className='uc_item_over'" onMouseOut="this.className='uc_item'" onClick="javascript: window.open('./index.php?act=pm&send_to='+document.getElementById('profilename').innerHTML,'Pm'+document.getElementById('profilename').innerHTML,'location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_large_width']?>,height=<?=$x7c->settings['tweak_window_large_height']?>');"><?=$txt[88]?></td>
					</tr>
					</tr>
						<td class="uc_item" OnMouseOver="javascript: this.className='uc_item_over'" onMouseOut="this.className='uc_item'" onClick="javascript: window.open('./index.php?act=usercp&cp_page=msgcenter&to='+document.getElementById('profilename').innerHTML,'Mail','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_large_width']?>,height=<?=$x7c->settings['tweak_window_large_height']?>');"><?=$txt[89]?></td>
					</tr>
				</table>
				</form>
			<?PHP
			
		}elseif($_GET['frame'] == "left_middle"){
			echo "$txt[598]";
			
		}elseif($_GET['frame'] == "send"){
			
			// Include the message library
			include("./lib/message.php");	
			
			// Make sure the message isn't null
			if(@$_GET['msg'] != "" && !eregi("^/",@$_GET['msg'])){
				
				// Save the style settings they used for next time
				$x7c->edit_user_settings("default_font",$_GET['curfont']);
				$x7c->edit_user_settings("default_size",$_GET['cursize']);
				$x7c->edit_user_settings("default_color",$_GET['curcolor']);
			
				// Get the styles
				$starttags = "";
				$endtags = "";
				$color = $_GET['curcolor'];
				$size = eregi_replace(" Pt","pt",$_GET['cursize']);
				$font = $_GET['curfont'];
				
				// Make sure incoming values are safe
				$_GET['msg'] = eregi_replace("<","&lt;",$_GET['msg']);
				$color = eregi_replace("<","&lt;",$color);
				$size = eregi_replace("<","&lt;",$size);
				$font = eregi_replace("<","&lt;",$font);
				
				$starttags .= "[color=$color][size=$size][font=$font]";
				
				// Add the styles
				if($_GET['bold'] == 1){
					$starttags .= "[b]";
					$endtags .= "[/b]";
				}
				if($_GET['italic'] == 1){
					$starttags .= "[i]";
					$endtags .= "[/i]";
				}
				if($_GET['under'] == 1){
					$starttags .= "[u]";
					$endtags .= "[/u]";
				}
				
				$endtags .= "[/color][/size][/font]";
				
				$parsed_msg = $starttags.$_GET['msg'].$endtags;

				// Make sure the user has a voice
				if($x7c->permissions['room_voice'] == 1){
					send_message($parsed_msg,$x7c->room_name);

				}else{
					// The user doesn't have a voice, alert them
					alert_user($x7s->username,$txt[42]);
				}
			
			}elseif(eregi("^/",@$_GET['msg'])){
				// User has done a command
				include("./lib/irc.php");
				parse_irc_command(@$_GET['msg']);
			}
			
		}elseif($_GET['frame'] == "left_bottom"){
			// Echo the styles
			echo $print->ss_chatinput;
			?>
				<script langauge="javascript" type="text/javascript">
					SelectorMenu = new Array();
					SelectorMenu['fontselector'] = 0;
					SelectorMenu['sizeselector'] = 0;
					fontTimeout = "";
					sizeTimeout = "";

					function doSelect(object){
						object.className = 'selected';
					}
					function doDeSelect(object){
						object.className = '';
					}

					function ClickedSelector(menu){
						popUpAddr = document.getElementById(menu).style
						if(SelectorMenu[menu] == 0){
							popUpAddr.visibility='visible';
							SelectorMenu[menu] = 1;
						}else{
							popUpAddr.visibility='hidden';
							SelectorMenu[menu] = 0;
						}
					}

					function closeMenu(menu){
						popUpAddr = document.getElementById(menu).style
						popUpAddr.visibility='hidden';
						SelectorMenu[menu] = 0;
					}

					function doClickFont(font){
						ClickedSelector('fontselector');
						document.chatIn.curfont.value=font;
						document.getElementById('curfontd').innerHTML=font;
					}

					function DoClickSize(in_font){
						ClickedSelector('sizeselector');
						
						in_font = in_font.replace(/[a-z]*$/i,"");
						
						if(in_font < <?=$x7c->settings['style_min_size']?>){
							in_font = "<?=$x7c->settings['style_min_size']?>";
						}
						
						<?PHP
						$max_size = $x7c->settings['style_max_size'];
						if($max_size != 0){
							echo "if(in_font > $max_size){\n
								in_font = \"$max_size\";\n
							}\n";
						}
						?>
						
						document.chatIn.cursize.value=in_font+" Pt";
						document.getElementById('cursized').innerHTML=in_font+" Pt";
					}

					function styleOut(object,name){
						ref = "itemh = document.chatIn."+name;
						eval(ref);
						if(itemh.value == 0){
							object.className='boldtxt';
						}
					}

					function styleClicked(object,name){
						ref = "itemh = document.chatIn."+name;
						eval(ref);
						if(itemh.value == 0){
							object.className='boldtxtdown';
							itemh.value = 1;
						}else{
							object.className='boldtxt';
							itemh.value = 0;
						}
					}

					function styleOver(object,name){
						ref = "itemh = document.chatIn."+name;
						eval(ref);
						if(itemh.value == 0){
							object.className='boldtxtover';
						}
					}
					
					function msgSent(){
						message = document.chatIn.msgi.value;
						message = message.replace(/\+/gi,"%2B");
						document.chatIn.msg.value=message;
						cache.unshift(message);
						message = message.replace(/%2B/gi,"+");
						if(message != ""){
							document.chatIn.msgi.value=''
							document.chatIn.msgi.focus();

						
							// Parse/Add styles
							color = document.chatIn.curcolor.value;
							size = document.chatIn.cursize.value;
							size = size.replace(" Pt","pt");
							font = document.chatIn.curfont.value;
							starttags = "<span style=\"font-family:"+font+"; color:"+color+"; font-size:"+size+"\">";
							endtags = "</span>";
							
							if(document.chatIn.bold.value == 1){
								starttags = starttags+"<b>";
								endtags = endtags+"</b>";	
							}
							
							if(document.chatIn.italic.value == 1){
								starttags = starttags+"<i>";
								endtags = endtags+"</i>";	
							}
							
							if(document.chatIn.under.value == 1){
								starttags = starttags+"<u>";
								endtags = endtags+"</u>";	
							}
							
							// Inline styles
							// replace < tags
							message = message.replace(/</gi,"&lt;");
							
							// Match Size Tags
							while(message.match(/\[size=[^\]]*\][^\]]*\[\/size\]/i)){
								temp = message.match(/\[size=[^\]]*\]/i);
								temps = ""+temp;	// Convert to string
								temps = temps.replace(/\[size=/i,"");
								temps = temps.replace("]","");
								message = message.replace(/\[size=[^\]]*\]/i,"<span style=\"font-size: "+temps+"\">");
								message = message.replace(/\[\/size\]/i,"</span>");
							}
							
							// Match Color Tags
							while(message.match(/\[color=[^\]]*\][^\]]*\[\/color\]/i)){
								temp = message.match(/\[color=[^\]]*\]/i);
								temps = ""+temp;	// Convert to string
								temps = temps.replace(/\[color=/i,"");
								temps = temps.replace("]","");
								message = message.replace(/\[color=[^\]]*\]/i,"<span style=\"color: "+temps+"\">");
								message = message.replace(/\[\/color\]/i,"</span>");
							}
							
							// Match font Tags
							while(message.match(/\[font=[^\]]*\][^\]]*\[\/font\]/i)){
								temp = message.match(/\[font=[^\]]*\]/i);
								temps = ""+temp;	// Convert to string
								temps = temps.replace(/\[font=/i,"");
								temps = temps.replace("]","");
								message = message.replace(/\[font=[^\]]*\]/i,"<span style=\"font-family: "+temps+"\">");
								message = message.replace(/\[\/font\]/i,"</span>");
							}
							
							// Bold Italic and Unerline
							while(message.match(/\[b\][^\]]*\[\/b\]/i)){
								message = message.replace(/\[b\]/i,"<b>");
								message = message.replace(/\[\/b\]/i,"</b>");
							}
							
							while(message.match(/\[i\][^\]]*\[\/i\]/i)){
								message = message.replace(/\[i\]/i,"<i>");
								message = message.replace(/\[\/i\]/i,"</i>");
							}
							
							while(message.match(/\[u\][^\]]*\[\/u\]/i)){
								message = message.replace(/\[u\]/i,"<u>");
								message = message.replace(/\[\/u\]/i,"</u>");
							}
							
							<?
							// Do Keyword parsing, Smilie parsing and filter parsing
							include("./lib/filter.php");
							$msg_filter = new filters($_GET['room']);
							echo $msg_filter->filter_javascript();
							?>
							
							// Add styles to message
							message = starttags+message+endtags;
							
							timestamp = '';
							// Do timestamp
							<?
								if($x7c->settings['disble_timestamp'] != 1){
									?>
											d = new Date();

											hours = ""+d.getHours();
											mins = ""+d.getMinutes();
											secs = ""+d.getSeconds();

											<?
											// The following is a bunch of javascript that emulates the PHP's date() function to a small extent
											//  PHP date |	JAVASCRIPT variable
												$dc['a'] = "if(hours > 12)\njva = 'pm';\nelse\njva = 'am';\n\n";
												$dc['A'] = "if(hours > 12)\njvA = 'PM';\nelse\njvA = 'AM';\n\n";
												$dc['g'] = "if(hours > 12)\njvg = hours-12;\nelse\njvg = hours;\n\n";
												$dc['G'] = "jvG = hours;";
												$dc['h'] = "if(hours > 12)\njvh = ''+(hours-12);\nelse\njvh = ''+hours;\nif(jvh.length == 1)\njvh = '0'+jvh;\n\n";
												$dc['H'] = "jvH = hours;\nif(jvH.length == 1)\njvH = '0'+jvH;\n\n";
												$dc['i'] = "jvi = ''+mins;\nif(jvi.length == 1)\njvi = '0'+jvi;\n\n";
												$dc['s'] = "jvs = ''+secs;\nif(jvs.length == 1)\njvs = '0'+jvs;\n\n";
												$dc['U'] = "jvU = d.getTime()/1000;\n\n";

												// The dateformat (Using PHP syntax only a,A,g,G,h,H,i,s and U are supported)
												$df = $x7c->settings['date_format'];

												// THis will be printed, only the needed javascript from above will be added
												$script = "";

												// replace the PHP symbols in $df with the javascript counterpart
												foreach($dc as $phps=>$js){
													$olddf = $df;

													// Preserve any special characters that are back slashed
													$df = ereg_replace("\\\\$phps","o_2R\n08_f",$df);

													// DO the switch
													$df = ereg_replace("$phps","\"+jv{$phps}+\"",$df);

													// Restore those characters who were preserved
													$df = ereg_replace("o_2R\n08_f","$phps",$df);

													// If there was a change then we need this javascript printed
													if($olddf != $df)
														$script .= $js;
												}
											?>
											<?=$script?>
											timestamp = "[<?=$df?>]";
									<?
								}
							?>
							
							// Put it into screen
							window.parent.frames['middle_left'].document.write('<span class="you"><?=$x7s->username?>'+timestamp+':</span> '+message+'<Br>');

							// Scroll the screen
							window.parent.frames['middle_left'].window.scrollBy(0, 65000);
						}
					}
					
					// This function reads key presses
					document.onkeydown = kp;
					consec = -1;
					function kp(evt){
						if(evt)
							thisKey = evt.which
						else
							thisKey = window.event.keyCode

						// Up arrow key pressed
						if(thisKey == 38 || thisKey == 40){
							if(thisKey == 38)
								consec = consec+1;
							if(thisKey == 40)
								consec = consec-1;
							arrow();
						}else{
							consec = -1;
						}
						
					}
					
					// This is code for handing the up arrow
					cache = new Array();
					function arrow(){

						if(consec > cache.length-1)
							consec = cache.length-1;
						if(consec < -1)
							consec = -1;
						
						if(consec != -1)	
							document.chatIn.msgi.value = cache[consec];
						else
							document.chatIn.msgi.value = "";
					}

				</script>
				<form name="chatIn" method="get" action="index.php" target="send" onSubmit="msgSent();">
				<input type="hidden" name="act" value="frame">
				<input type="hidden" name="frame" value="send">
				<input type="hidden" name="room" value="<?=$_GET['room']?>">
				<table border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td height="10" colspan="11" width="10"><img src="<?=$print->image_path?>spacer.gif"></td>
					</tr>
					<tr valign="top">
						<td width="10">&nbsp;</td>
						<td width="95">
							<!-- Begin Select Area for Font -->
								<table border="0" cellspacing="0" cellpadding="0" class="nonSelected" onMouseOver="javascript: clearTimeout(fontTimeout);" onMouseOut="javascript: fontTimeout = setTimeout('closeMenu(\'fontselector\');',750);">
									<tr valign="middle">
										<td height="17" width="60" class="selectbar" onClick="javascript: ClickedSelector('fontselector');" onMouseOver="javascript: document.font_selector.src='<?=$print->image_path?>selectarrow_over.gif'" onMouseOut="javascript: document.font_selector.src='<?=$print->image_path?>selectarrow.gif'">&nbsp;<input type="hidden" name="curfont" value="<?=$x7c->settings['default_font']?>" class="curfont"><div id="curfontd" name="curfontd" style="display: inline;text-align: left;width: 65px;" width="65px"><?=$x7c->settings['default_font']?></div></td>
										<td height="17" class="arrow_box" onClick="javascript: ClickedSelector('fontselector');" width="17"><img name="font_selector" src="<?=$print->image_path?>selectarrow.gif" onMouseOver="javascript: this.src='<?=$print->image_path?>selectarrow_over.gif'" onMouseOut="javascript: this.src='<?=$print->image_path?>selectarrow.gif'"></td>
									</tr>
								</table>
								<div id="fontselector" style="visibility: hidden;z-Index: 3;position: relative;top: 0px;left:0px;">
									<table border="0" cellspacing="0" cellpadding="0" class="nonSelected" onMouseOver="javascript: clearTimeout(fontTimeout);" onMouseOut="javascript: fontTimeout = setTimeout('closeMenu(\'fontselector\');',750);">
										<tr>
											<td height="15" width="81" onClick="javascript: doClickFont('<?=$txt[55]?>');" onMouseOver="javascript: doSelect(this);" onMouseOut="javascript: doDeSelect(this);">&nbsp;<?=$txt[55]?> &nbsp;</td>
										</tr>
										<tr>
											<td height="15" width="81" onClick="javascript: doClickFont('<?=$x7c->settings['default_font']?>');" onMouseOver="javascript: doSelect(this);" onMouseOut="javascript: doDeSelect(this)">&nbsp;<?=$x7c->settings['default_font']?></td>
										</tr>
										<tr>
											<td height="15" width="81" onClick="javascript: window.open('./index.php?act=sm_window&page=fonts','Fonts','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_small_width']?>,height=<?=$x7c->settings['tweak_window_small_height']?>');" onMouseOver="javascript: doSelect(this);" onMouseOut="javascript: doDeSelect(this)">&nbsp;<?=$txt[56]?></td>
										</tr>
									</table>
								</div>
							<!-- End Select Area for Font -->
						</td>

						<td width="75">
							<!-- Begin Select Area for Size -->
								<table border="0" cellspacing="0" cellpadding="0" class="nonSelected"   onMouseOver="javascript: clearTimeout(sizeTimeout);" onMouseOut="javascript: sizeTimeout = setTimeout('closeMenu(\'sizeselector\');',750);">
									<tr valign="middle">
										<td height="17" width="40" class="selectbar" onClick="javascript: ClickedSelector('sizeselector');" onMouseOver="javascript: document.size_selector.src='<?=$print->image_path?>selectarrow_over.gif'" onMouseOut="javascript: document.size_selector.src='<?=$print->image_path?>selectarrow.gif'">&nbsp;<input type="hidden" name="cursize" value="<?=$x7c->settings['default_size']?>" class="cursize"><div name="cursized" id="cursized" style="display: inline;" width="40px"><?=$x7c->settings['default_size']?></div></td>
										<td height="17" class="arrow_box" onClick="javascript: ClickedSelector('sizeselector');" width="17"><img name="size_selector" src="<?=$print->image_path?>selectarrow.gif" onMouseOver="javascript: this.src='<?=$print->image_path?>selectarrow_over.gif'" onMouseOut="javascript: this.src='<?=$print->image_path?>selectarrow.gif'"></td>
									</tr>
								</table>

								<div id="sizeselector" style="visibility: hidden;z-Index: 3;position: relative;top: 0px;left:0px;">
									<table border="0" cellspacing="0" cellpadding="0" class="nonSelected"   onMouseOver="javascript: clearTimeout(sizeTimeout);" onMouseOut="javascript: sizeTimeout = setTimeout('closeMenu(\'sizeselector\');',750);">
										<tr>
											<td height="15" width="61" onClick="javascript: DoClickSize('10 Pt');" onMouseOver="javascript: doSelect(this)" onMouseOut="javascript: doDeSelect(this);">&nbsp;10 Pt</td>
										</tr>
										<tr>
											<td height="15" width="61" onClick="javascript: DoClickSize('12 Pt');" onMouseOver="javascript: doSelect(this)" onMouseOut="javascript: doDeSelect(this);">&nbsp;12 Pt</td>
										</tr>
										<tr>
											<td height="15" width="61" onClick="javascript: DoClickSize('14 Pt');" onMouseOver="javascript: doSelect(this)" onMouseOut="javascript: doDeSelect(this)">&nbsp;14 Pt</td>
										</tr>
										<tr>
											<td height="15" width="61" onClick="javascript: fontsize = prompt('<?=$txt[58]?>','');DoClickSize(fontsize);closeMenu('sizeselector');" onMouseOver="javascript: doSelect(this)" onMouseOut="javascript: doDeSelect(this)">&nbsp;<?=$txt[56]?></td>
										</tr>
									</table>
								</div>
							<!-- End Select Area for Size -->
						</td>

						<td width="92">
							<!-- Begin Select Area for Color -->
								<table border="0" cellspacing="0" cellpadding="0" class="nonSelected">
									<tr valign="middle">
										<td height="17" width="55" class="selectbar" onClick="javascript: window.open('./index.php?act=sm_window&page=colors&extra=1','Colors','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_small_width']?>,height=<?=$x7c->settings['tweak_window_small_height']?>');" onMouseOver="javascript: document.color_selector.src='<?=$print->image_path?>selectarrow_over.gif'" onMouseOut="javascript: document.color_selector.src='<?=$print->image_path?>selectarrow.gif'">&nbsp;<input type="hidden" name="curcolor" value="<?=$x7c->settings['default_color']?>" class="curcolor"><div id="curcolord" name="curcolord" style="display: inline;color: <?=$x7c->settings['default_color']?>"><?=$x7c->settings['default_color']?></div></td>
										<td height="17" class="arrow_box" onClick="javascript: window.open('./index.php?act=sm_window&page=colors&extra=1','Colors','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_small_width']?>,height=<?=$x7c->settings['tweak_window_small_height']?>');" width="17"><img name="color_selector" src="<?=$print->image_path?>selectarrow.gif" onMouseOver="javascript: this.src='<?=$print->image_path?>selectarrow_over.gif'" onMouseOut="javascript: this.src='<?=$print->image_path?>selectarrow.gif'"></td>
									</tr>
								</table>

							<!-- End Select Area for Color -->
						</td>

						<td width="20">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="20" class="boldtxt" height="19" onClick="javascript: styleClicked(this,'bold')" onMouseOver="javascript: styleOver(this,'bold');" onMouseOut="javascript: styleOut(this,'bold');">
										<input type="hidden" name="bold" value="0"><b>B</b>
									</td>
								</tr>
							</table>
						</td>

						<td width="8">&nbsp;</td>

						<td width="20">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="20" class="boldtxt" height="19" onClick="javascript: styleClicked(this,'italic')" onMouseOver="javascript: styleOver(this,'italic');" onMouseOut="javascript: styleOut(this,'italic');">
										<input type="hidden" name="italic" value="0"><i>I</i>
									</td>
								</tr>
							</table>
						</td>

						<td width="8">&nbsp;</td>

						<td width="20">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="20" class="boldtxt" height="19" onClick="javascript: styleClicked(this,'under')" onMouseOver="javascript: styleOver(this,'under');" onMouseOut="javascript: styleOut(this,'under');">
										<input type="hidden" name="under" value="0"><u>U</u>
									</td>
								</tr>
							</table>
						</td>

						<td width="10">&nbsp;</td>

						<td width="21" height="17"><img src="<?=$print->image_path?>blanksmile.gif" class="smileybutton" onClick="javascript: window.open('./index.php?act=sm_window&page=smile','Smile','location=no,menubar=no,resizable=no,status=no,toolbar=no,scrollbars=yes,width=<?=$x7c->settings['tweak_window_small_width']?>,height=<?=$x7c->settings['tweak_window_small_height']?>');" onMouseOver="javascript: this.className='smileybuttonOver'" onMouseOut="javascript: this.className='smileybutton'"></td>

					</tr>
					<tr>
						<td width="10">&nbsp;</td>
						<td colspan="10">
							<div style="position: relative; top: -50px;z-index: 2;">
								<table border="0" cellspacing="0" cellpadding="0">
									<tr valign="middle">
										<td width="315" height="25" class="msginput_bg">
											<div align="center">
												<input type="text" name="msgi" class="msginput" autocomplete="off">
												<input type="hidden" name="msg" value="">
											</div>
										</td>
										<td width="5">&nbsp;</td>
										<td><input type="submit" class="send_button" style="cursor: pointer; cursor: hand;background: url(<?=$print->image_path?>send.gif);border: none;height: 25px;width: 55px;text-align: center;font-weight: bold;" onMouseOut="this.style.background='url(<?=$print->image_path?>send.gif)'" onMouseOver="this.style.background='url(<?=$print->image_path?>send_over.gif)'" value="<?=$txt[181]?>"></td>
									</tr>
								</table><Br>
							</div>
						</td>
					</tr>
				</table> 
				</form>
				<!-- Throw in the sounds -->
				<script language="javascript" type="text/javascript">
					//document.write('');
					function execi(){
						document.getElementById("sounds").innerHTML = '<EMBED SRC="./sounds/enter.mid" AUTOSTART="FALSE" LOOP="FALSE" NAME="enter_snd" HIDDEN="true"></EMBED><EMBED SRC="./sounds/msg.mid" AUTOSTART="FALSE" LOOP="FALSE" NAME="msg_snd" HIDDEN="true"></EMBED>';
					}
					setTimeout('execi()','7500');
				</script>
				<div name="sounds" id="sounds"></div>
			<?PHP
			
		}elseif($_GET['frame'] == "profile"){
		
			if(!isset($_GET['user']) || !isset($_GET['room'])){
				echo "<html>&nbsp;</html>";
			}else{
			
				// Include the needed user control library
				include("./lib/usercontrol.php");
				
				// Get profile info on this user
				$user_info = new user_control($_GET['user']);
				$ui = $user_info->generate_profile_tab();
				$status = $ui['status'];
				$ug = $ui['group'];
				
				// Get action info on this user
				// This information is in the pattern of (by indexes)
				// 0: label
				// 1: action
				// 2: label
				// 3: action
				// ect. up to 9 (last action)
				$user_action = $user_info->generate_action_tab();
				
				while(count($user_action) < 10){
					$user_action[count($user_action)] = "";
				}
				
				// Convert to javascript and send to user
				echo "<script language=\"javascript\" type=\"text/javascript\">
				with(window.parent.frames['bottom_right'].document){\n
					getElementById('profilename').innerHTML = '$_GET[user]';\n
					getElementById('profilestatus').innerHTML = '$status';\n
					getElementById('profileusergroup').innerHTML = '$ug';\n

					getElementById('act_label_1').innerHTML = '$user_action[0]';\n
					getElementById('act_label_2').innerHTML = '$user_action[2]';\n
					getElementById('act_label_3').innerHTML = '$user_action[4]';\n
					getElementById('act_label_4').innerHTML = '$user_action[6]';\n
					getElementById('act_label_5').innerHTML = '$user_action[8]';\n

					profileform.action_1.value = '$user_action[1]';\n
					profileform.action_2.value = '$user_action[3]';\n
					profileform.action_3.value = '$user_action[5]';\n
					profileform.action_4.value = '$user_action[7]';\n
					profileform.action_5.value = '$user_action[9]';\n
				}\n
				</script>";
			}
			
		}else{
			// User specified an invalid frame name
			echo "Error: Unknown Frame $_GET[frame]";
		}
		
		// Close the page
		echo "</body></html>";
		
	}
?> 
