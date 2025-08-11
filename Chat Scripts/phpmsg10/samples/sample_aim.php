<HTML>
	<HEADER>
		<TITLE>PHP Messenger, AIM send message sample</TITLE>
	</HEADER>
	
	<BODY><CENTER><H1>Sample using <a href="http://www.php-messenger.com">PHP Messenger</a><br>for sending AIM messages.<br></H1>

<?php
	$my_uin=htmlspecialchars((strlen($_POST['my_uin'])>0)?$_POST['my_uin']:"", ENT_QUOTES);
	$my_pass=htmlspecialchars((strlen($_POST['my_pass'])>0)?$_POST['my_pass']:"", ENT_QUOTES);
	$to_uin=htmlspecialchars((strlen($_POST['to_uin'])>0)?$_POST['to_uin']:"", ENT_QUOTES);
	$text=htmlspecialchars((strlen($_POST['text'])>0)?$_POST['text']:"", ENT_QUOTES);
?>
		<FORM METHOD="POST">
			<TABLE>
				<TR>
					<TD>Your screenname</TD>
					<TD><input type=text name=my_uin value="<?php echo($my_uin)?>"></TD>
				</TR>
				<TR>
					<TD>Your password</TD>
					<TD><input type=password name=my_pass value="<?php echo($my_pass)?>"></TD>
				</TR>
				<TR>
					<TD>To screenname</TD>
					<TD><input type=text name=to_uin value="<?php echo($to_uin)?>"></TD>
				</TR>
				<TR>
					<TD>Text</TD>
					<TD><input type=text name=text value="<?php echo($text)?>"></TD>
				</TR>
				<TR>
					<TH colspan=2><input type=submit value="Send Message"></TH>
				</TR>
				
			</TABLE>
		</FORM>
	</CENTER>
		
<?php		
	// http://www.php-messenger.com/samples/sample_aim.php - URL of this sample

	if ($my_uin!="" && $my_pass!="" && $to_uin!="" && $text!="")
	{
		require ("php_messenger.php");  			// Include PHP MESSENGER
		$pm=new PM_AIM();              				// Create AIM object
		$pm->cfg['Debug_Mode']=0;    				// debug mode for print packets
		$pm->cfg['Show_Messages']=0; 				// print encoming/outgoing messages
		$pm->cfg['Show_Errors']=0;   				// print errors
		if ($pm->login($my_uin,$my_pass))   			// Try to login
		{
			if ($pm->Send_Message_Confirm($to_uin,$text))   // Try to send message
			{
				echo ("Message to $to_uin was sent!<br>");
			}else
			{
				echo ("<font color=red>Unable to send message!</font><br>");
			}
		}else
		{
			echo ("<font color=red>Unable to login!</font><br>");
		}
		$pm->Off_Line();
	}
		
?>		
	</BODY>	
</HTML>
