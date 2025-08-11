<?php

	// RCBlog - notes.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>
	
	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(true);
	
	if(isset($_GET['msg'])) $msg=$_GET['msg'];
	else $msg = '';

	if(isset($_POST['editit'])){
		$text = $_POST['text'];
		if(($gz = gzcompress($text))!==false){
			if(rcb_writefile("data/notes.txt", $gz)){
				rcb_redirect("notes.php?msg=success");
			}
			else $msg = 'nowrite';
		}
		else $msg = 'noencode';
	}
	elseif(($gz = rcb_readfile("data/notes.txt"))!==false){
		if(($text = gzuncompress($gz))===false){
			$msg='nodecode';
			$text='';
		}
	}
	else $text='';
	
	rcb_printheader();
	rcb_printbodystart();
	rcb_printcontentstart();
	
	if($msg=='success') rcb_printcustompost("Success", "Your notes have been successfully edited.");
	elseif($msg=='nowrite') rcb_printcustompost("Error", "Could not write to file.");
	elseif($msg=='noencode') rcb_printcustompost("Error", "Could not encode file.");
	elseif($msg=='nodecode') rcb_printcustompost("Error", "Could not decode file.");
	
	rcb_printcustompost("Notes", $text);

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">Edit Notes</div>";
	echo "<div class=\"text\">\n";

	rcb_printformstart('notes', 'post', "notes.php");

	rcb_printformbutton('b', 'btnb', 'button', "rcb_addstyle(document.forms[0].text, 'b');");
	rcb_printformbutton('i', 'btni', 'button', "rcb_addstyle(document.forms[0].text, 'i');");
	rcb_printformbutton('u', 'btnbu', 'button', "rcb_addstyle(document.forms[0].text, 'u');");
	rcb_printformbutton('code', 'btncode', 'button', "rcb_addstyle(document.forms[0].text, 'code');");
	rcb_printformbutton('url', 'btnurl', 'button', "rcb_addurl(document.forms[0].text);");
	rcb_printformbutton('link', 'btnlink', 'button', "rcb_addlink(document.forms[0].text);");
	rcb_printformbutton('e-mail', 'btnemail', 'button', "rcb_addemail(document.forms[0].text);");
	rcb_printformbutton('img', 'btnimg', 'button', "rcb_addimage(document.forms[0].text);");
	echo "<br/>\n";

	rcb_printformtextarea('', 'text', $text);

	rcb_printformbutton('Edit', 'editit', 'submit');
	rcb_printformend();
	echo "</div>\n</div>\n";

	rcb_printcontentend();
	rcb_printnav($loggedin);
	rcb_printbodyend();

?>
