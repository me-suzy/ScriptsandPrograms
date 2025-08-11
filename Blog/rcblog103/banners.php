<?php

	// RCBlog - banners.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(true);
	
	if(isset($_GET['msg'])) $msg = $_GET['msg'];
	else $msg = '';
	
	if(isset($_POST['doit'])){
		if(rcb_writefile("data/banners.txt", $_POST['bannertext'])){
			rcb_redirect('banners.php?&msg=success');
		}
		else $msg = "nowrite";
	}
	
	if(($text=rcb_readlock('data/banners.txt'))===FALSE){
		$msg = "noread";
	}

	rcb_printheader();
	rcb_printbodystart();

	rcb_printcontentstart();

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">";
	echo "Edit Banners";
	echo "</div>\n";
	echo "<div class=\"text\">\n";

	if($msg=='success') echo "Your banners have been edited.\n";
	else{
		if($msg=='nowrite') echo "Could not write to file.<br/><br/>\n";
		elseif($msg=='noread') echo "Could not read from file.<br/><br/>\n";
		rcb_printformstart('edit', 'post', "banners.php");
		echo "Text:<br/>";
		rcb_printformtextarea('', 'bannertext', $text);
		rcb_printformbutton('Edit', 'doit', 'submit');
		rcb_printformend();
	}
	echo "</div>\n</div>\n";

	rcb_printcontentend();

	rcb_printnav($loggedin);

	rcb_printbodyend();

?>