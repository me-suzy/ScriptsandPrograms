<?php
// Mortgage Calculators Plus
// ------------------------------------------------------------------------
// Copyright (c) 2005, MortgageCalculatorsPlus.com
// ------------------------------------------------------------------------
// This file is part of "Mortgage Calculators Plus" software
// ------------------------------------------------------------------------

	/* no cache */
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Pragma: no-cache");

	/* turning off NOTICES */
	error_reporting(E_ALL ^ E_NOTICE ^ E_USER_NOTICE);
	
	/* full path to calculator dir */
	$calcdir = realpath(dirname(__FILE__).'/../');

	/* including components */
	include($calcdir.'/includes/config.inc.php');
	include($calcdir.'/includes/functions.inc.php');
	include($calcdir.'/includes/smarty/Smarty.class.php');

	/* initialising Smarty engine */
	$smarty = new Smarty;
	$smarty->template_dir = $calcdir.'/templates';
	$smarty->compile_dir  = $calcdir.'/includes/smarty/templates_c';
	$smarty->assign('config', $config);
	
	/* GZIP compression */
	@ob_start("ob_gzhandler");
?>