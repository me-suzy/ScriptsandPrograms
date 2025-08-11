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

<?
function printct($width,$height,$head,$body,$cs1,$cs2,$cs3){
global $CS, $XUSER, $PERMISSIONS;
$height1 = $height - 10;
$widthl = $width - 2;
$widthh = $width - 2;
?>
<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
	<tr valign="center">
		<td colspan="3" height="50" style="background: url(./images/top.top.gif);border-left: 1px solid <?=$CS[3]?>; border-right: 1px solid <?=$CS[3]?>;">
			<table height="42" width="100%" border="0" cellspacing="0" cellpadding="0">
				<Tr valign="top">
					<td height="42" width="195"><img src="./images/chatlogo.gif" width="195" height="42"></td>
					<td height="42">&nbsp;</td>
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
				<a href="http://x7chat.com/help"><img src="./images/user_help.gif" alt="Help" height="40" width="85" border="0"></a>';
			}else{
			echo '<a href="./index.php?listrooms=true"><img src="./images/user_leave.gif" alt="Leave Room" height="40" width="85" border="0"></a>
				<a href="./index.php?croom1=newroom"><img src="./images/user_newroom.gif" alt="Create Room" height="40" width="85" border="0"></a>
				<a href="./index.php?viewprofile='.$XUSER['NAME'].'"><img src="./images/user_profile.gif" alt="Edit Profile" height="40" width="85" border="0"></a>
				<a href="./index.php?settings=1"><img src="./images/user_settings.gif" alt="Edit Setting" height="40" width="85" border="0"></a>
				<a href="./index.php?changestat=away"><img src="./images/user_away.gif" alt="Away" height="40" width="85" border="0"></a>
				<a href="./index.php?dologout=true"><img src="./images/user_logout.gif" alt="Logout" height="40" width="85" border="0"></a>';
			}
			if($temp != 0){
			echo '<a href="./admin.php"><img src="./images/user_admin.gif" alt="Admin Panel" height="40" width="85" border="0"></a>';
			
			}
		?>
		</div>
		</td>
		<td width="40" height="50" style="background: url(./images/top.right.gif);">
		&nbsp;
		</td>
	</tr>
</table>
<?

print("<div align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"$width\" style=\"border: 1px solid $CS[3]\">\n
<tr align=\"top\">
<td width=\"$widthl\" style=\"border-bottom: 1px solid $CS[3]\" bgcolor=\"$cs1\" height=\"10\">$head</td>
</tr>
<tr align=\"top\">
<td width=\"$widthl\" bgcolor=\"$cs2\">$body</td>
</tr>
</table>
</div>
");
}

function printc($width,$height,$body,$cs2,$cs3){
global $CS;
$height1 = $height;
$widthl = $width - 2;
$widthh = $width - 2;
print("<div align=\"center\">
<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" width=\"$width\" style=\"border: 1px solid $CS[3]\">\n
<tr align=\"top\">
<td width=\"$widthl\" bgcolor=\"$cs2\" height=\"$height\">$body</td>
</tr>
</table>
</div>

");
}


?> 
