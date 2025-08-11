<?php

	// RCBlog - config.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(true);
	
	if(isset($_POST['savesettings'])){
		$rcb_sitetitle = $_POST['sitetitle'];
		$rcb_title = $_POST['blogtitle'];
		$rcb_footer = $_POST['footer'];
		$rcb_recent = $_POST['recentposts'];
		$rcb_dateformat = $_POST['dateformat'];
		$rcb_menuformat = $_POST['menuformat'];
		$rcb_offset = $_POST['offset'];
		$rcb_showmenu = $_POST['showmenu'];
		$rcb_description = $_POST['description'];
		$rcb_keywords = $_POST['keywords'];
		if(rcb_writeconfig()){
			rcb_redirect('config.php?msg=success');
		}
		rcb_redirect('config.php?msg=nowrite');
	}

	rcb_printheader();
	rcb_printbodystart();
	rcb_printcontentstart();
	
	$msg = '';
	if(isset($_GET['msg'])) $msg = $_GET['msg'];

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">Configuration</div>\n";
	echo "<div class=\"text\">\n";
	if($msg=='success') echo "Your settings have been saved.\n";
	else{
		if($msg=='nowrite') echo "Could not write to file<br/><br/>\n";

		rcb_printformstart('config', 'post', 'config.php');

		rcb_printforminput('Site Title', 'sitetitle', 'text', 40, $rcb_sitetitle);
		rcb_printforminput('Blog Title', 'blogtitle', 'text', 40, $rcb_title);
		rcb_printforminput('Description', 'description', 'text', 40, $rcb_description);
		rcb_printforminput('Keywords', 'keywords', 'text', 40, $rcb_keywords);
		rcb_printforminput('Footer', 'footer', 'text', 40, $rcb_footer);
		rcb_printforminput('# of Recent Posts', 'recentposts', 'text', 4, $rcb_recent);

		echo "Time format:<br/>\n";
		echo "%A - weekday name<br/>\n";
		echo "%B - month name<br/>\n";
		echo "%d - day of month (01-31)<br/>\n";
		echo "%H - hour (00-23)<br/>\n";
		echo "%I - hour (01-12)<br/>\n";
		echo "%m - month (01-12)<br/>\n";
		echo "%M - minute (00-59)<br/>\n";
		echo "%p - am/pm<br/>\n";
		echo "%S - second (00-59)<br/>\n";
		echo "%y - two-digit year<br/>\n";
		echo "%Y - four-digit year<br/>\n";
		echo "%% - a % character<br/><br/>\n";

		rcb_printforminput('Date Display Format', 'dateformat', 'text', 40, $rcb_dateformat);
		rcb_printforminput('Menu Date Format', 'menuformat', 'text', 40, $rcb_menuformat);
		rcb_printforminput('Server Offset (in hours)', 'offset', 'text', 4, $rcb_offset);
		
		echo "Display Menu when Not Logged In:<br/>\n";
		echo "<select name=\"showmenu\">\n";
		echo "<option value=\"yes\" " . ($rcb_showmenu!='no'?'selected':'') . ">Yes</option>\n";
		echo "<option value=\"no\" "  . ($rcb_showmenu=='no'?'selected':'') . ">No</option>\n";
		echo "</select><br/><br/>\n";

		rcb_printformbutton('Submit', 'savesettings', 'submit');
		rcb_printformend();
	}
	echo "</div>\n</div>\n";
	rcb_printcontentend();
	rcb_printnav($loggedin);
	rcb_printbodyend();

?>