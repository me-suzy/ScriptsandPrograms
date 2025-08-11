<?php

	// RCBlog - login.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');

	if(isset($_GET['action'])){
		if($_GET['action']=='login'){
			if(rcb_login($_POST['username'], $_POST['password'])){
				rcb_redirect("login.php?msg=success");
			}
			rcb_redirect("login.php?msg=badlogin");
		}
		
		if($_GET['action']=='logout'){
			rcb_logout();
			rcb_redirect("login.php?msg=logout");
		}
	}
	
	$msg = '';
	if(isset($_GET['msg'])) $msg = $_GET['msg'];
	
	$loggedin = rcb_loggedin(false);

	rcb_printheader();
	if($msg!='success' && $msg!='logout')
		rcb_printbodystart('forms[0].username');
	else
		rcb_printbodystart();

	rcb_printcontentstart();

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">Login</div>\n";
	echo "<div class=\"text\">\n";

	if($msg=='success') echo "You have successfully logged in.\n";
	elseif($msg=='logout') echo "You have successfully logged out.\n";
	else{
		if($msg=='badlogin') echo "Bad username or password.<br/><br/>\n";
		elseif($msg=='mustlogin') echo "You must login.<br/><br/>\n";
	
		rcb_printformstart('login', 'post', 'login.php?action=login');
		rcb_printforminput('Username', 'username', 'text');
		rcb_printforminput('Password', 'password', 'password');
		rcb_printformbutton('Login', 'login', 'submit');
		rcb_printformbutton('Reset', 'reset', 'reset');
		rcb_printformend();
	}
	echo "</div>\n</div>\n";

	rcb_printcontentend();

	rcb_printnav($loggedin);

	rcb_printbodyend();
	


?>