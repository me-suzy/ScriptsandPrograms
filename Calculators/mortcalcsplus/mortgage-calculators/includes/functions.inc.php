<?php
// Mortgage Calculators Plus
// ------------------------------------------------------------------------
// Copyright (c) 2005, MortgageCalculatorsPlus.com
// ------------------------------------------------------------------------
// This file is part of "Mortgage Calculators Plus" software
// ------------------------------------------------------------------------

//====================================
function get_request_var($varname = ''){
	global $smarty;
	if($varname){
		$var = isset($_POST[$varname]) ? $_POST[$varname] : $_GET[$varname];
	}
	else{
		$var = count($_POST) ? $_POST : $_GET;
	}
	
	/* assign variable to Smarty */
	if(isset($smarty)){
		if(get_magic_quotes_gpc()){
			$smarty->assign($varname, array_stripslashes($var));
		}
		else{
			$smarty->assign($varname, $var);
		}
	}

	/* adding slashes if magic quotes feature is turned off */
	if(!get_magic_quotes_gpc()) $var = array_addslashes($var);

	return $var;
}

//====================================
function array_addslashes($var){
	if(is_array($var)){
		return array_map("array_addslashes", $var);
	}
	else{
		return addslashes($var);
	}
}
	
//====================================
function array_stripslashes($var){
	if(is_array($var)){
		return array_map("array_stripslashes", $var);
	}
	else{
		return stripslashes($var);
	}
}
?>