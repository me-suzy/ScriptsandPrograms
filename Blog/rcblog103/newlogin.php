<?php

	// RCBlog - newlogin.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(true);

	if(isset($_GET['action'])){
		if($_GET['action']=='change'){
			if(rcb_login($_POST['olduser'], $_POST['oldpass'])){
				if(strlen($_POST['newuser'])>0){
					if(strlen($_POST['newpass'])>0){
						if($_POST['newpass']==$_POST['newpass2']){
							if(rcb_setlogin($_POST['newuser'], $_POST['newpass'])){
								rcb_login($_POST['newuser'], $_POST['newpass']);
								rcb_redirect("newlogin.php?msg=success");
							}
							rcb_redirect("newlogin.php?msg=nowrite");
						}
						rcb_redirect("newlogin.php?msg=matchpass");
					}
					rcb_redirect("newlogin.php?msg=nopass");
				}
				rcb_redirect("newlogin.php?msg=nouser");
			}
			rcb_redirect("newlogin.php?msg=badlogin");
		}
	}

	rcb_printheader();
	rcb_printbodystart('forms[0].olduser');

	rcb_printcontentstart();

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">Change Login</div>\n";
	echo "<div class=\"text\">\n";
	
	$msg = '';
	if(isset($_GET['msg'])) $msg = $_GET['msg'];

	if($msg=='success') echo "Your login information has been changed.\n";
	else{
		if($msg=='badlogin') echo "Incorrect old information.<br/><br/>\n";
		elseif($msg=='nowrite') echo "Cannot write to file.<br/><br/>\n";
		elseif($msg=='matchpass') echo "New passwords do not match.<br/><br/>\n";
		elseif($msg=='nopass') echo "You must enter a password.<br/><br/>\n";
		elseif($msg=='nouser') echo "You must enter a username.<br/><br/>\n";
	
		rcb_printformstart('newlogin', 'post', 'newlogin.php?action=change');
		rcb_printforminput('Old Username', 'olduser', 'text');
		rcb_printforminput('Old Password', 'oldpass', 'password');
		rcb_printforminput('New Username', 'newuser', 'text');
		rcb_printforminput('New Password', 'newpass', 'password');
		rcb_printforminput('New Password (again)', 'newpass2', 'password');

		rcb_printformbutton('Change', 'login', 'submit');
		rcb_printformbutton('Reset', 'reset', 'reset');
		rcb_printformend();
	}
	echo "</div>\n</div>\n";

	rcb_printcontentend();

	rcb_printnav($loggedin);

	rcb_printbodyend();

?>
