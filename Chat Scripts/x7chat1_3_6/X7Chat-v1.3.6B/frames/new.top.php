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
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>X7 Chat</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="The X7 Group">
<meta http-equiv="content-language" content="en">
<META NAME="copyright" content="2003 By The X7 Group">
<META NAME="rating" content="general">
<style type="text/css">
.seethru{
border: none;
color: <?=$CS['FONTDK']?>;
background: transparent;
}
</style>
</head>
<body bgcolor="<?=$CS['WIN_BG_1']?>" text="<?=$CS['FONTDK']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<form action="" name="showon">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
	<tr valign="center">
		<td colspan="3" height="50" style="background: url(./images/top.top.gif);border-left: 1px solid <?=$CS[3]?>; border-right: 1px solid <?=$CS[3]?>;">
			<table height="42" width="100%" border="0" cellspacing="0" cellpadding="0">
				<Tr valign="center">
					<td height="42" width="195"><img src="./images/chatlogo.gif" width="195" height="42"></td>
					<td height="42">&nbsp;&nbsp;
						<font size="2">
						<b><?=$txt[303]?>:</b> <?=$SERVER['NAME']?> &nbsp;&nbsp;
						<b><?=$txt[305]?>:</b> <input type="text" name="users" readonly="true" class="seethru" size="3"> &nbsp;&nbsp;
						<b><?=$txt[306]?>:</b> <input type="text" name="rooms" readonly="true" class="seethru" size="3">
						</font>
					</td>
					<td height="42" width="190">
						<!-- THIS TEXT MAY NOT BE REMOVED OR EDITED OR COMMENTED OUT.  IF YOU DO CHAT WILL NOT WORK -->
						<div align="center"><font size="2">Powered By <a href="http://www.x7chat.com/" target="_blank">X7 Chat</a> 1.3.6B<Br>&copy; 2004 By The <a href="http://www.x7chat.com/" target="_blank">X7 Group</a></font></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr valign="top">
		<td width="40" height="50" style="background: url(./images/top.left.gif);">
			&nbsp;
		</td>
		<td width="750" height="50" style="background: url(./images/top.middle.gif);">
		<div align="center">
		
		<?
			$temp = $PERMISSIONS['Edit_Settings']+$PERMISSIONS['Edit_Styles']+$PERMISSIONS['Edit_Permissions']+$PERMISSIONS['Edit_Users']+$PERMISSIONS['Edit_Room']+$PERMISSIONS['Server_Ban']+$PERMISSIONS['Edit_Smilies']+$PERMISSIONS['Edit_Filter']+$PERMISSIONS['Edit_Bandwidth'];
			if($XUSER['NAME'] == ""){
			echo '<a href="./register.php"><img src="./images/user_register.gif" alt="New Account" height="40" width="85" border="0"></a>
				<a href="./index.php"><img src="./images/user_login.gif" alt="Login" height="40" width="85" border="0"></a>
				<a href="./help.php"><img src="./images/user_help.gif" alt="Help" height="40" width="85" border="0"></a>';
			}else{
			echo '<a href="./index.php?listrooms=true" target="_parent"><img src="./images/user_leave.gif" alt="Leave Room" height="40" width="85" border="0"></a>
				<a href="./index.php?croom1=newroom" target="_parent"><img src="./images/user_newroom.gif" alt="Create Room" height="40" width="85" border="0"></a>
				<a href="./index.php?viewprofile='.$XUSER[NAME].'" target="_parent"><img src="./images/user_profile.gif" alt="Edit Profile" height="40" width="85" border="0"></a>
				<a href="./index.php?settings=1" target="_parent"><img src="./images/user_settings.gif" alt="Edit Setting" height="40" width="85" border="0"></a>
				<a href="./index.php?changestat=away" target="_parent"><img src="./images/user_away.gif" alt="Away" height="40" width="85" border="0"></a>
				<a href="./index.php?dologout=true" target="_parent"><img src="./images/user_logout.gif" alt="Logout" height="40" width="85" border="0"></a>';
			}
			if($temp != 0){
			echo '<a href="./admin.php" target="_parent"><img src="./images/user_admin.gif" alt="Admin Panel" height="40" width="85" border="0"></a>';
			
			}
		?>
		</div>
		</td>
		
		<td width="40" height="50" style="background: url(./images/top.right.gif);">
		&nbsp;
		</td>
	</tr>
</table>
</div>
</form>
</body>
</html>
