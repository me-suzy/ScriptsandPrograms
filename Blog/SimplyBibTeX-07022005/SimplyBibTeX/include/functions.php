<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module		: keeps all important functions
// Description	: just usual stubs functions
// Author		: Hartmut Seichter
// License		: GPL
// CVS			: $Id: functions.php,v 1.3 2005/02/07 14:35:46 seichter Exp $
// ---------------------------------------------------------------------------

function get_post($name,$default)
{
	if (isset($_POST[$name]))
		return $_POST[$name];
	return $default;
};

function get_get($name,$default)
{
	if (isset($_GET[$name]))
		return $_GET[$name];
	
	return $default;		
};

/* function to get around old PHP <4.3.0 versions */
function glob_func($path,$files)
{
	$result  = array();

	if ($dir = opendir($path)) {

		while ($file = readdir($dir)) {
			if (ereg("(\.bib)$",strtolower($file)) )
					$result[] = $path .'/'. $file;
		}
		closedir($dir);
	}

	return $result;	
}

?>
