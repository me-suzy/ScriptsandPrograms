<?php

	// RCBlog - post.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(true);

	$title   = '';
	$text    = '';
	$preview = false;
	$msg     = '';
	$type    = '';
	
	if(isset($_GET['msg'])) $msg = $_GET['msg'];
	if(isset($_GET['type'])) $type = $_GET['type'];

	if(isset($_POST['preview'])){
		if(isset($_POST['title'])) $title=$_POST['title'];
		if(isset($_POST['blogtext'])) $text=$_POST['blogtext'];
		$preview=true;
	}
	elseif(isset($_POST['postit'])){
		if(isset($_POST['title'])) $title=$_POST['title'];
		if(isset($_POST['blogtext'])) $text=$_POST['blogtext'];
		if(strlen($title)<1) $msg='notitle';
		elseif(strlen($text)<1) $msg='notext';
		elseif($type=='static'){
			$time=time();
			if(rcb_appendfile('data/nav.txt', "$title\ts$time\n")){
				if(rcb_writefile("data/s$time.txt", "$title\n$text")){
					rcb_redirect("post.php?type=static&msg=success");
				}
				else $msg='nowrite';
			}
			else $msg='noindex';
		}
		else{
			$time=time();
			if(rcb_writefile("data/$time.txt", "$title\n$text")){
				rcb_redirect("post.php?msg=success");
			}
			else $msg='nowrite';
		}
	}

	rcb_printheader();
	if($msg=='success') rcb_printbodystart();
	else rcb_printbodystart('forms[0].title');

	rcb_printcontentstart();

	if($preview){
		if($type=='static') rcb_printcustompost($title, $text);
		else rcb_printcustompost($title, $text, time());
	}

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">";
	echo ($type=='static')?"Add Static Post":"Add Blog Post";
	echo "</div>\n";
	echo "<div class=\"text\">\n";

	if($msg=='success') echo "Your post has been added.\n";
	else{
		if($msg=='notitle') echo "You must enter a title.<br/><br/>\n";
		elseif($msg=='notext') echo "You must enter some text.<br/><br/>\n";
		elseif($msg=='nowrite') echo "Could not write to file.<br/><br/>\n";
		elseif($msg=='noindex') echo "Could not write to index file.<br/><br/>\n";

		if($type=='static') rcb_printformstart('post', 'post', 'post.php?type=static');
		else rcb_printformstart('post', 'post', 'post.php');

		rcb_printforminput('Title', 'title', 'text', 50, $title);

		echo "Text:<br/>";
		rcb_printformbutton('b', 'btnb', 'button', "rcb_addstyle(document.forms[0].blogtext, 'b');");
		rcb_printformbutton('i', 'btni', 'button', "rcb_addstyle(document.forms[0].blogtext, 'i');");
		rcb_printformbutton('u', 'btnbu', 'button', "rcb_addstyle(document.forms[0].blogtext, 'u');");
		rcb_printformbutton('code', 'btncode', 'button', "rcb_addstyle(document.forms[0].blogtext, 'code');");
		rcb_printformbutton('url', 'btnurl', 'button', "rcb_addurl(document.forms[0].blogtext);");
		rcb_printformbutton('link', 'btnlink', 'button', "rcb_addlink(document.forms[0].blogtext);");
		rcb_printformbutton('e-mail', 'btnemail', 'button', "rcb_addemail(document.forms[0].blogtext);");
		rcb_printformbutton('img', 'btnimg', 'button', "rcb_addimage(document.forms[0].blogtext);");
		echo "<br/>\n";

		rcb_printformtextarea('', 'blogtext', $text);

		rcb_printformbutton('Preview', 'preview', 'submit');
		rcb_printformbutton('Post', 'postit', 'submit');
		rcb_printformend();
	}
	echo "</div>\n</div>\n";

	rcb_printcontentend();

	rcb_printnav($loggedin);

	rcb_printbodyend();

?>