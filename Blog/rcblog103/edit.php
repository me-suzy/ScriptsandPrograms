<?php

	// RCBlog - edit.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(true);
	
	$msg = '';
	if(isset($_GET['msg'])) $msg = $_GET['msg'];
	
	$preview = false;

	if(!isset($_GET['post'])){
		rcb_redirect('index.php');
	}

	if(!preg_match('/s?[0-9]+/', $_GET['post'])){
		rcb_redirect('index.php');
	}

	$file=$_GET['post'];
	if($_GET['post'][0]=='s'){
		$type='static'; $time=substr($file,1);
	}
	else{
		$type='blog'; $time=$file;
	}
	$title=''; $text='';

	if(isset($_POST['preview'])){
		$title=$_POST['title'];
		$text=$_POST['blogtext'];
		$preview=true;
	}
	elseif(isset($_POST['editit'])){
		$title=$_POST['title'];
		$text=$_POST['blogtext'];
		if(strlen($title)<1) $msg='notitle';
		elseif(strlen($text)<1) $msg='notext';
		elseif($type=='static'){
			if(rcb_updatenav($file, $title)){
				if(rcb_writefile("data/$file.txt", "$title\n$text")){
					rcb_redirect('edit.php?post=$file&msg=success');
				}
				else $msg='nowrite';
			}
			else $msg='noindex';
		}
		else{
			if(rcb_writefile("data/$file.txt", "$title\n$text")){
				rcb_redirect('edit.php?post=$file&msg=success');
			}
			else $msg='nowrite';
		}
	}
	else{
		if($post=rcb_readfile("data/$file.txt")){
			$parts = preg_split("/(\r\n|\r|\n)/", $post, 2);
			$title=$parts[0];
			$text=$parts[1];
		}
	}

	rcb_printheader();
	if($msg=='success') rcb_printbodystart();
	else rcb_printbodystart('forms[0].title');

	rcb_printcontentstart();

	if($preview){
		if($type=='static') rcb_printcustompost($title, $text);
		else rcb_printcustompost($title, $text, $time);
	}

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">";
	echo ($type=='static')?"Edit Static Post":"Edit Blog Post";
	echo "</div>\n";
	echo "<div class=\"text\">\n";

	if($msg=='success') echo "Your post has been edited.\n";
	else{
		if($msg=='notitle') echo "You must enter a title.<br/><br/>\n";
		elseif($msg=='notext') echo "You must enter some text.<br/><br/>\n";
		elseif($msg=='nowrite') echo "Could not write to file.<br/><br/>\n";
		elseif($msg=='noindex') echo "Could not write to index file.<br/><br/>\n";

		rcb_printformstart('edit', 'post', "edit.php?post=$file");

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
		rcb_printformbutton('Edit', 'editit', 'submit');
		rcb_printformend();
	}
	echo "</div>\n</div>\n";

	rcb_printcontentend();

	rcb_printnav($loggedin);

	rcb_printbodyend();

?>