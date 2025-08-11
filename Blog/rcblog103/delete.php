<?php

	// RCBlog - delete.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(true);
	
	if(isset($_GET['msg'])) $msg = $_GET['msg'];
	else $msg = '';

	if($msg=='success'){
		rcb_printheader();
		rcb_printbodystart();
		rcb_printcontentstart();
		rcb_printcustompost("Delete Post", "Your post has been deleted");
		rcb_printcontentend();
		rcb_printnav($loggedin);
		rcb_printbodyend();
		exit;
	}

	if(!isset($_GET['post']) || isset($_POST['nodelete'])){
		rcb_redirect('index.php');
	}

	if(!preg_match('/^s?[0-9]+$/', $_GET['post'])){
		rcb_redirect('index.php');
	}

	elseif(file_exists("data/$_GET[post].txt")){
		if(isset($_POST['yesdelete'])){
			if($_GET['post'][0]=='s'){
				if(rcb_removenav($_GET['post'])){
					if(rcb_rmfile("data/$_GET[post].txt")){
						rcb_redirect('delete.php?msg=success');
					}
					else $msg='nodelete';
				}
				else $msg='noindex';
			}
			elseif(rcb_rmfile("data/$_GET[post].txt")){
				rcb_redirect('delete.php?msg=success');
			}
			else $msg='nodelete';
		}
	}
	else $msg='nofile';

	rcb_printheader();
	rcb_printbodystart();
	rcb_printcontentstart();

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">Delete Post</div>\n";
	echo "<div class=\"text\">\n";

	if($msg=='nofile') echo "Post does not exist: \"$_GET[post]\"\n";
	else{
		if($msg=='nodelete') echo "Could not delete file<br/><br/>\n";
		elseif($msg=='noindex') echo "Could not modify index file<br/><br/>\n";
		rcb_printformstart('delpost', 'post', "delete.php?post=$_GET[post]");
		echo "Are you sure you want to delete this post?<br/><br/>\n";
		rcb_printformbutton('No', 'nodelete', 'submit');
		rcb_printformbutton('Yes', 'yesdelete', 'submit');
		rcb_printformend();
	}
	echo "</div>\n</div>\n";

	rcb_printpost($_GET['post'], false);

	rcb_printcontentend();
	rcb_printnav($loggedin);
	rcb_printbodyend();

?>