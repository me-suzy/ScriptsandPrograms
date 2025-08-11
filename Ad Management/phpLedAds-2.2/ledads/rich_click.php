<?php
/*
 *****************************************************************
 *			       	phpLedAds 2.x
 *
 * This program is distributed as freeware. We are not
 * responsible for any damages that the program causes	
 * to your system. It may be used and modified free of 
 * charge, as long as the copyright notice
 * in the program that give me credit remain intact.
 * If you find any bugs in this program. Please feel free 
 * to report it to bugs@ledscripts.com.
 * If you have any troubles installing this program. Please feel
 * free to post a message on our Support Forum.
 * Selling this script is absolutely forbidden and illegal.
 *
 *****************************************************************
 *
 *	               COPYRIGHT NOTICE:
 *	
 *	         Copyright 2004 Jon Coulter
 *	
 *	      Author:  Jon Coulter
 *	      Web Site: http://www.ledscripts.com
 *	      E-Mail: support@ledscripts.com
 *	      Support: http://www.ledscripts.com/
 *
 *       This program is protected by the U.S. Copyright Law
 *****************************************************************
*/

	// imports everything we need
	require_once(dirname(__FILE__) . '/ad_class.php');
	
	_extras::fix_slashes();
	
	$pla->do_require('LedHTML');
	$html = new LedHTML;
	$key = $html->param('key');
	
	if(!is_numeric($key) || empty($key)) {
		die("Unable to find key!");
	}
	
	$pla_class->update_click( $key );
	//$pla_class->redirect( $key );
	header("Location: " . $html->param('redirect'));
	exit;
?>
