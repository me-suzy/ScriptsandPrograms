<?php

	// RCBlog - index.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(false);

	rcb_printheader();
	rcb_printbodystart();

	rcb_printcontentstart();

	if(isset($_GET['post'])){
		if(!rcb_printpost($_GET['post'], $loggedin))
		rcb_printcustompost('Error', "Post $_GET[post] not found.");
	}

	elseif(isset($_GET['y'])){
		if(isset($_GET['m'])){
			if(isset($_GET['d'])){
				if(!rcb_printarchive($loggedin, $_GET['y'], $_GET['m'], $_GET['d']))
				rcb_printcustompost('Error', "No posts for $_GET[y]-$_GET[m]-$_GET[d].");
			}
			elseif(!rcb_printarchive($loggedin, $_GET['y'], $_GET['m']))
			rcb_printcustompost('Error', "No posts for $_GET[y]-$_GET[m].");
		}
		elseif(!rcb_printarchive($loggedin, $_GET['y']))
		rcb_printcustompost('Error', "No posts for $_GET[y].");
	}

	elseif(!rcb_printarchive($loggedin)) rcb_printcustompost('Error', 'No posts.');

	rcb_printcontentend();
	
	if(isset($_GET['y'])){
		if(isset($_GET['m'])){
			if(isset($_GET['d'])) rcb_printnav($loggedin, $_GET['y'], $_GET['m'], $_GET['d']);
			else rcb_printnav($loggedin, $_GET['y'], $_GET['m']);
		}
		else rcb_printnav($loggedin, $_GET['y']);
	}
	else rcb_printnav($loggedin);

	rcb_printbodyend();
?>
